<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student List</title>

  <!-- Bootstrap & Icons -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>

  <style>
    body {
      background-color: #f4f6f8 !important;
      margin: 0;
      font-family: 'Montserrat', serif !important;
      overflow-x: hidden;
    }
    .content-wrapper {
      margin-left: 250px;
      padding: 80px 20px 20px 20px;
      transition: margin-left 0.3s ease-in-out;
    }
    .content-wrapper.minimized { margin-left: 60px; }
    @media (max-width: 768px) {
      .content-wrapper { margin-left: 0; padding: 80px 12px 20px 12px; }
    }

    .table thead th { white-space: nowrap; }
    .btn-toggle-status { min-width: 110px; }
    .form-inline .form-control { width: 240px; }

    .card-header {
      
      background: linear-gradient(135deg, #ff4040 0%, #470000 100%) !important;
    }
  </style>
</head>
<body class="bg-light">

  <!-- Sidebar -->
  <?php $this->load->view('superadmin/Include/Sidebar') ?>

  <!-- Navbar -->
  <?php $this->load->view('superadmin/Include/Navbar') ?>

  <!-- Main Content -->
  <div class="content-wrapper" id="contentWrapper">
    <div class="container-fluid mt-4">
      <div class="card shadow">
        <div class="card-header  text-white d-flex align-items-center justify-content-between">
          <h4 class="mb-0"><i class="fas fa-users"></i> Student List</h4>

          <!-- Quick search (client-side filter) -->
          <form class="form-inline" onsubmit="return false;">
            <input id="tableSearch" class="form-control form-control-sm" type="text" placeholder="Search name / batch / level"/>
          </form>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0" id="studentsTable">
              <thead style="background: linear-gradient(135deg, #ff4040 0%, #470000 100%); color: #fff;">
  <tr>
    <th style="width: 60px;">ID</th>
    <th>Name</th>
    <th>Level</th>
    <th>Batch</th>
    <th>Facility</th>
    <th>Fees</th>
    <th>Status</th>
    <th style="min-width: 260px;">Action</th>
  </tr>
</thead>

                
              <tbody>
                <!-- STATIC DEMO ROWS -->
                <tr
                  data-id="1"
                  data-name="Rahul Sharma"
                  data-level="Beginner"
                  data-batch="Morning"
                  data-facility="Existing"
                  data-fees="5000"
                  data-status="Active"
                >
                  <td>1</td>
                  <td>Rahul Sharma</td>
                  <td>Beginner</td>
                  <td>Morning</td>
                  <td>Existing</td>
                  <td>₹5000</td>
                  <td class="status-cell">
                    <span class="badge badge-success">Active</span>
                  </td>
                  <td class="text-nowrap">
                    <a href="<?= site_url('superadmin/View_Renew_Students/1') ?>" class="btn btn-sm btn-info">
                      <i class="fas fa-eye"></i> View
                    </a>

                   

                    <button type="button" class="btn btn-sm btn-secondary ml-1 btn-toggle-status btn-block-xs">
                      <i class="fas fa-toggle-on"></i> Deactivate
                    </button>
                  </td>
                </tr>

                <tr
                  data-id="2"
                  data-name="Priya Patil"
                  data-level="Intermediate"
                  data-batch="Evening"
                  data-facility="New"
                  data-fees="8000"
                  data-status="Deactive"
                >
                  <td>2</td>
                  <td>Priya Patil</td>
                  <td>Intermediate</td>
                  <td>Evening</td>
                  <td>New</td>
                  <td>₹8000</td>
                  <td class="status-cell">
                    <span class="badge badge-danger">Deactive</span>
                  </td>
                  <td class="text-nowrap">
                    <a href="<?= site_url('superadmin/View_Renew_Students/2') ?>" class="btn btn-sm btn-info">
                      <i class="fas fa-eye"></i> View
                    </a>

                   

                    <button type="button" class="btn btn-sm btn-success ml-1 btn-toggle-status btn-block-xs">
                      <i class="fas fa-toggle-off"></i> Activate
                    </button>
                  </td>
                </tr>
                <!-- /STATIC DEMO ROWS -->
              </tbody>
            </table>
          </div>
        </div>

        <div class="card-footer text-muted small">
          * This list is static for demo purposes. Integrate with DB later via a Model.
        </div>
      </div>
    </div>
  </div>

  

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Sidebar Toggle Script (if your layout uses it) -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const sidebarToggle = document.getElementById('sidebarToggle');
      const sidebar = document.getElementById('sidebar');
      const navbar = document.querySelector('.navbar');
      const contentWrapper = document.getElementById('contentWrapper');

      if (sidebarToggle) {
        sidebarToggle.addEventListener('click', () => {
          if (window.innerWidth <= 768) {
            if (sidebar) {
              sidebar.classList.toggle('active');
              if (navbar) navbar.classList.toggle('sidebar-hidden', !sidebar.classList.contains('active'));
            }
          } else {
            if (sidebar && contentWrapper) {
              const isMinimized = sidebar.classList.toggle('minimized');
              if (navbar) navbar.classList.toggle('sidebar-minimized', isMinimized);
              contentWrapper.classList.toggle('minimized', isMinimized);
            }
          }
        });
      }
    });
  </script>

  <!-- Page Logic: search, renew modal fill, status toggle -->
  <script>
    // Client-side search
    $('#tableSearch').on('input', function () {
      const q = $(this).val().toLowerCase();
      $('#studentsTable tbody tr').each(function () {
        const text = $(this).text().toLowerCase();
        $(this).toggle(text.indexOf(q) > -1);
      });
    });

    // Open Renew Modal with row data
    $('.btn-open-renew').on('click', function () {
      const $row = $(this).closest('tr');
      const id = $row.data('id');
      const name = $row.data('name');
      const level = $row.data('level');
      const batch = $row.data('batch');
      const facility = $row.data('facility');
      const fees = $row.data('fees');

      $('#renewStudentId').val(id);
      $('#renewStudentName').val(name);
      $('#renewCurrentLevel').val(level);

      // Preselect using current values
      $('#renewLevel').val(level);
      $('#renewBatch').val(batch);
      $('#renewFacility').val(facility === 'Existing' ? 'continue' : 'new');
      $('#renewFeesAmount').val(fees);
      $('#renewPaymentMode').val('Cash');
    });

    // Toggle Active/Deactive (visual only, static demo)
    $('.btn-toggle-status').on('click', function () {
      const $row = $(this).closest('tr');
      const $badge = $row.find('.status-cell .badge');
      const isActive = $badge.hasClass('badge-success');

      if (isActive) {
        $badge.removeClass('badge-success').addClass('badge-danger').text('Deactive');
        $(this).removeClass('btn-secondary').addClass('btn-success').html('<i class="fas fa-toggle-off"></i> Activate');
        $row.data('status', 'Deactive');
      } else {
        $badge.removeClass('badge-danger').addClass('badge-success').text('Active');
        $(this).removeClass('btn-success').addClass('btn-secondary').html('<i class="fas fa-toggle-on"></i> Deactivate');
        $row.data('status', 'Active');
      }
    });
  </script>
</body>
</html>
