<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Center extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Center_model');
    }

    public function index() {
        $this->load->view('center_management');
    }

    public function save() {
        $this->output->set_content_type('application/json');
        log_message('debug', 'Save method called with data: ' . json_encode($this->input->raw_input_stream));
        $data = json_decode($this->input->raw_input_stream, true);

        if (!$data) {
            $this->output->set_status_header(400);
            echo json_encode(['message' => 'Invalid input data']);
            return;
        }

        $result = $this->Center_model->save_center($data);
        if ($result) {
            log_message('debug', 'Center saved successfully');
            echo json_encode(['message' => 'Center added successfully']);
        } else {
            $this->output->set_status_header(500);
            log_message('error', 'Failed to save center');
            echo json_encode(['message' => 'Failed to add center']);
        }
    }

    public function get_all() {
        $this->output->set_content_type('application/json');
        log_message('debug', 'get_all method called');
        $centers = $this->Center_model->get_all_centers();
        echo json_encode($centers);
    }

    public function get($id) {
        $this->output->set_content_type('application/json');
        log_message('debug', 'get method called for ID: ' . $id);
        $center = $this->Center_model->get_center($id);
        if ($center) {
            echo json_encode($center);
        } else {
            $this->output->set_status_header(404);
            echo json_encode(['message' => 'Center not found']);
        }
    }

    public function filter() {
        $this->output->set_content_type('application/json');
        log_message('debug', 'filter method called with name: ' . $this->input->post('filterCenterName'));
        $name = $this->input->post('filterCenterName');
        $centers = $this->Center_model->filter_centers($name);
        echo json_encode($centers);
    }


    public function update_facility() {
        $this->output->set_content_type('application/json');
        $data = json_decode($this->input->raw_input_stream, true);
        if (!$data) {
            $this->output->set_status_header(400);
            echo json_encode(['message' => 'Invalid input data']);
            return;
        }
        $result = $this->Center_model->update_facility($data);
        if ($result) {
            echo json_encode(['message' => 'Facility updated successfully']);
        } else {
            $this->output->set_status_header(500);
            echo json_encode(['message' => 'Failed to update facility']);
        }
    }

    public function update_staff() {
        $this->output->set_content_type('application/json');
        $data = json_decode($this->input->raw_input_stream, true);
        if (!$data) {
            $this->output->set_status_header(400);
            echo json_encode(['message' => 'Invalid input data']);
            return;
        }
        $result = $this->Center_model->update_staff($data);
        if ($result) {
            echo json_encode(['message' => 'Staff updated successfully']);
        } else {
            $this->output->set_status_header(500);
            echo json_encode(['message' => 'Failed to update staff']);
        }
    }
    // <-----------------------New API for center Managemnet----------------------->

    public function addCenter()
    {
        if ($this->input->method(TRUE) !== 'POST') {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid request method, use POST"
        ]);
        return;
    }
        $input = json_decode(file_get_contents("php://input"), true);

        // Extract data
        $name = trim($input['name'] ?? '');
        $address = trim($input['address'] ?? '');
        $rent_amount = $input['rent_amount'] ?? '';
        $rent_paid_date = $input['rent_paid_date'] ?? '';
        $timing_from = $input['center_timing_from'] ?? '';
        $timing_to = $input['center_timing_to'] ?? '';
        $password = $input['password'] ?? '';

        // ✅ Validation
        if(empty($name) || empty($address) || empty($rent_amount) || empty($rent_paid_date) || empty($timing_from) || empty($timing_to) || empty($password)){
            echo json_encode(["status"=>"error","message"=>"All fields are required"]);
            return;
        }

        // ✅ Password validation
        if(!preg_match('/[0-9]/', $password) || 
           !preg_match('/[A-Z]/', $password) || 
           !preg_match('/[a-z]/', $password) || 
           !preg_match('/[^a-zA-Z0-9]/', $password) || 
           strlen($password) < 8) {
            echo json_encode(["status"=>"error","message"=>"Password must have at least 1 number, 1 uppercase, 1 lowercase, 1 special char and min 8 characters"]);
            return;
        }

        // ✅ Hash password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // ✅ Save in DB
        $data = [
            "name" => $name,
            "address" => $address,
            "rent_amount" => $rent_amount,
            "rent_paid_date" => $rent_paid_date,
            "center_timing_from" => $timing_from,
            "center_timing_to" => $timing_to,
            "password" => $hashed_password
        ];

        $insert_id = $this->Center_model->insertCenter($data);

        if($insert_id){
            echo json_encode(["status"=>"success","message"=>"Center added successfully","center_id"=>$insert_id]);
        } else {
            echo json_encode(["status"=>"error","message"=>"Failed to save center"]);
        }
    }
    public function getCenterById($id = null)
{
      if ($this->input->method(TRUE) !== 'GET') {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid request method, use GET"
        ]);
        return;
    }

    if ($id === null) {
        echo json_encode(["status" => "error", "message" => "Center ID is required"]);
        return;
    }

    $center = $this->Center_model->getCenter($id);

    if ($center) {
        // Never return hashed password for security reasons
        unset($center['password']); 

        echo json_encode([
            "status" => "success",
            "data" => $center
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Center not found"
        ]);
    }
}
public function updateCenter($id = null)
{
    if ($this->input->method(TRUE) !== 'PUT') {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid request method, use PUT"
        ]);
        return;
    }

    if ($id === null) {
        echo json_encode(["status" => "error", "message" => "Center ID is required"]);
        return;
    }

    $input = json_decode(file_get_contents("php://input"), true);

    // Validate required fields
    if (empty($input['name']) || empty($input['address'])) {
        echo json_encode(["status"=>"error","message"=>"Name and Address are required"]);
        return;
    }

    $data = [
        "name" => trim($input['name']),
        "address" => trim($input['address']),
        "rent_amount" => $input['rent_amount'] ?? null,
        "rent_paid_date" => $input['rent_paid_date'] ?? null,
        "center_timing_from" => $input['center_timing_from'] ?? null,
        "center_timing_to" => $input['center_timing_to'] ?? null
    ];

    // If password update requested → validate & hash
    if (!empty($input['password'])) {
        $password = $input['password'];
        if(!preg_match('/[0-9]/', $password) || 
           !preg_match('/[A-Z]/', $password) || 
           !preg_match('/[a-z]/', $password) || 
           !preg_match('/[^a-zA-Z0-9]/', $password) || 
           strlen($password) < 8) {
            echo json_encode(["status"=>"error","message"=>"Password must have at least 1 number, 1 uppercase, 1 lowercase, 1 special char and min 8 characters"]);
            return;
        }
        $data["password"] = password_hash($password, PASSWORD_BCRYPT);
    }

    $updated = $this->Center_model->updateCenter($id, $data);

    if ($updated) {
        echo json_encode(["status"=>"success","message"=>"Center updated successfully"]);
    } else {
        echo json_encode(["status"=>"error","message"=>"Update failed or no changes"]);
    }
}
public function deleteCenter($id = null)
{
    if ($this->input->method(TRUE) !== 'DELETE') {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid request method, use DELETE"
        ]);
        return;
    }

    if ($id === null) {
        echo json_encode(["status" => "error", "message" => "Center ID is required"]);
        return;
    }

    $deleted = $this->Center_model->deleteCenter($id);

    if ($deleted) {
        echo json_encode(["status" => "success", "message" => "Center deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Center not found or already deleted"]);
    }
}

}
?>