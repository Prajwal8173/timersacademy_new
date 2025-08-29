<?php
class Center_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function save_center($data) {
        $this->db->trans_start();

        // Insert center
        $center = array(
            'name' => $data['center']['name'],
            'timing' => $data['center']['timing'],
            'rent' => $data['center']['rent'],
            'rent_date' => $data['center']['rent_date'],
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('centers', $center);
        $center_id = $this->db->insert_id();

        // Insert batches
        $batch_ids = [];
        foreach ($data['batches'] as $batch) {
            $batch_data = array(
                'center_id' => $center_id,
                'timing' => $batch['timing'],
                'start_date' => $batch['start_date'],
                'category' => $batch['category'],
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert('batches', $batch_data);
            $batch_ids[$batch['timing']] = $this->db->insert_id();
        }

        // Insert facilities
        foreach ($data['facilities'] as $facility) {
            $facility_data = array(
                'center_id' => $center_id,
                'type' => $facility['type'],
                'locker_no' => $facility['locker_no'] ?: null,
                'rent' => $facility['rent'],
                'rent_date' => $facility['rent_date'],
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert('facilities', $facility_data);
        }

        // Insert staff
        foreach ($data['staff'] as $staff) {
            $staff_data = array(
                'center_id' => $center_id,
                'category' => $staff['category'],
                'name' => $staff['name'],
                'timing' => $staff['timing'],
                'join_date' => $staff['join_date'],
                'batch_id' => isset($batch_ids[$staff['batch_timing']]) ? $batch_ids[$staff['batch_timing']] : null,
                'contact' => $staff['contact'],
                'address' => $staff['address'],
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert('staff', $staff_data);
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function get_all_centers() {
        return $this->db->get('centers')->result_array();
    }

    public function get_center($id) {
        $center = $this->db->get_where('centers', ['id' => $id])->row_array();
        $batches = $this->db->get_where('batches', ['center_id' => $id])->result_array();
        $facilities = $this->db->get_where('facilities', ['center_id' => $id])->result_array();
        $staff = $this->db->get_where('staff', ['center_id' => $id])->result_array();

        // Map batch timing to staff
        foreach ($staff as &$s) {
            $batch = array_filter($batches, function($b) use ($s) { return $b['id'] == $s['batch_id']; });
            $s['batch_timing'] = !empty($batch) ? reset($batch)['timing'] : '';
        }

        return [
            'center' => $center,
            'batches' => $batches,
            'facilities' => $facilities,
            'staff' => $staff
        ];
    }

    public function filter_centers($name) {
        $this->db->like('name', $name);
        return $this->db->get('centers')->result_array();
    }



    public function update_facility($data) {
        $this->db->trans_start();
        $facility_data = array(
            'type' => $data['type'],
            'locker_no' => $data['locker_no'] ?: null,
            'rent' => $data['rent'],
            'rent_date' => $data['rent_date']
        );
        $this->db->where('id', $data['id']);
        $this->db->update('facilities', $facility_data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function update_staff($data) {
        $this->db->trans_start();
        $batch = $this->db->get_where('batches', ['timing' => $data['batch_timing']])->row_array();
        $staff_data = array(
            'category' => $data['category'],
            'name' => $data['name'],
            'timing' => $data['timing'],
            'join_date' => $data['join_date'],
            'batch_id' => $batch ? $batch['id'] : null,
            'contact' => $data['contact'],
            'address' => $data['address']
        );
        $this->db->where('id', $data['id']);
        $this->db->update('staff', $staff_data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // <-----------------------New APIs for center Managemnet----------------------->

    public function insertCenter($data){
        $this->db->insert('center_details', $data);
        return $this->db->insert_id();
    }
    public function getCenter($id)
{
    $query = $this->db->get_where('center_details', ['id' => $id]);
    return $query->row_array();
}
public function updateCenter($id, $data)
{
    $this->db->where('id', $id);
    return $this->db->update('center_details', $data);
}

public function deleteCenter($id)
{
    $this->db->where('id', $id);
    return $this->db->delete('center_details');
}

}
?>