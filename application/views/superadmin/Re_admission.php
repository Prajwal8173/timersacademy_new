<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Re-Admission</title>

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
        <div class="card-header text-white d-flex align-items-center justify-content-between">
          <h4 class="mb-0"><i class="fas fa-user-slash"></i> Re-Admission (Deactivated Students)</h4>

          <!-- Quick search -->
          <form class="form-inline" onsubmit="return false;">
            <input id="tableSearch" class="form-control form-control-sm" type="text" placeholder="Search name / batch / level"/>
          </form>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0" id="studentsTable">
              <thead style="background: linear-gradient(135deg, #007bff 0%, #001f54 100%); color: #fff;">
                <tr>
                  <th style="width: 60px;">ID</th>
                  <th>Name</th>
                  <th>Level</th>
                  <th>Batch</th>
                  <th>Facility</th>
                  <th>Fees</th>
                  <th>Status</th>
                  <th style="min-width: 200px;">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Example static rows: only Deactive -->
                <tr data-id="2" data-name="Priya Patil" data-level="Intermediate" data-batch="Evening" data-facility="New" data-fees="8000" data-status="Deactive">
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
  <a href="<?php echo base_url('superadmin/view_re_admission'); ?>" 
     class="btn btn-sm btn-success">
    <i class="fas fa-redo"></i> Re-Admit
  </a>
</td>
                  </td>
                </tr>

                <tr data-id="3" data-name="Amit Kumar" data-level="Beginner" data-batch="Morning" data-facility="Existing" data-fees="6000" data-status="Deactive">
                  <td>3</td>
                  <td>Amit Kumar</td>
                  <td>Beginner</td>
                  <td>Morning</td>
                  <td>Existing</td>
                  <td>₹6000</td>
                  <td class="status-cell">
                    <span class="badge badge-danger">Deactive</span>
                  </td>
                <td class="text-nowrap">
  <a href="<?php echo base_url('superadmin/view_re_admission'); ?>" 
     class="btn btn-sm btn-success">
    <i class="fas fa-redo"></i> Re-Admit
  </a>
</td>


                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="card-footer text-muted small">
          * Only deactivated students are shown here. Use Re-Admit to renew admission.
        </div>
      </div>
    </div>
  </div>

  <!-- Re-Admission Modal
  <div class="modal fade" id="renewModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="<?= site_url('superadmin/re_admission_submit') ?>" method="POST">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title"><i class="fas fa-redo"></i> Re-Admission</h5>
            <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="renewStudentId" name="student_id">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Student</label>
                  <input type="text" id="renewStudentName" class="form-control" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Previous Level</label>
                  <input type="text" id="renewCurrentLevel" class="form-control" readonly>
                </div>
              </div>
            </div>

            <hr/>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>New Level</label>
                  <select name="level" id="renewLevel" class="form-control" required>
                    <option>Beginner</option>
                    <option>Intermediate</option>
                    <option>Advanced</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Batch</label>
                  <select name="batch_id" id="renewBatch" class="form-control" required>
                    <option>Morning</option>
                    <option>Evening</option>
                    <option>Weekend</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Duration</label>
                  <select name="duration" class="form-control" required>
                    <option value="3">3 Months</option>
                    <option value="6">6 Months</option>
                    <option value="12">1 Year</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Facility</label>
                  <select name="facility_type" id="renewFacility" class="form-control" required>
                    <option value="continue">Continue Existing</option>
                    <option value="new">New Facility</option>
                  </select>
                </div>
              </div>
            </div>

            <hr/>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Fees Amount (₹)</label>
                  <input type="number" name="fees_amount" id="renewFeesAmount" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Payment Mode</label>
                  <select name="payment_mode" class="form-control" required>
                    <option>Cash</option>
                    <option>UPI</option>
                    <option>Bank Transfer</option>
                    <option>Card</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Receipt No.</label>
                  <input type="text" name="receipt_no" class="form-control" readonly value="RCPT<?= time(); ?>">
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Confirm Re-Admission</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
 -->
  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Client-side search
    $('#tableSearch').on('input', function () {
      const q = $(this).val().toLowerCase();
      $('#studentsTable tbody tr').each(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(q) > -1);
      });
    });

    // Fill modal with selected student info
    $('.btn-open-renew').on('click', function () {
      const $row = $(this).closest('tr');
      $('#renewStudentId').val($row.data('id'));
      $('#renewStudentName').val($row.data('name'));
      $('#renewCurrentLevel').val($row.data('level'));
      $('#renewLevel').val($row.data('level'));
      $('#renewBatch').val($row.data('batch'));
      $('#renewFacility').val($row.data('facility') === 'Existing' ? 'continue' : 'new');
      $('#renewFeesAmount').val($row.data('fees'));
    });
  </script>
  <<script>
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
</body>
</html>
