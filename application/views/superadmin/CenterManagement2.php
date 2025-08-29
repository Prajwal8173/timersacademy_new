<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Center Management UI</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
  <style>
    :root {
      --primary-color: #007bff;
      --accent-color: #ff4d4f;
      --background-color: #f8fafc;
      --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      --card-hover-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
      --button-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      --transition: all 0.3s ease;
    }
    body {
      background-color: var(--background-color) !important;
      margin: 0;
      font-family: 'Inter', sans-serif !important;
      overflow-x: hidden;
      min-height: 100vh;
    }
    .content-wrapper {
      margin-left: 250px;
      padding: 80px 20px 20px 20px;
      transition: var(--transition);
    }
    .content-wrapper.minimized {
      margin-left: 60px;
    }
    .center-card {
      background: #ffffff;
      border-radius: 12px;
      padding: 20px;
      border-left: 4px solid var(--accent-color);
      box-shadow: var(--card-shadow);
      margin-bottom: 20px;
      transition: var(--transition);
    }
    .center-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--card-hover-shadow);
    }
    .card-details p {
      margin: 8px 0;
      font-size: 0.9rem;
      color: #2d3748;
      line-height: 1.6;
    }
    .card-details p:first-child {
      font-size: 1.1rem;
      font-weight: 600;
    }
    .card-details p span {
      font-weight: 500;
      color: #1a202c;
    }
    .btn-primary {
      background: linear-gradient(135deg, #ff4040 0%, #470000 100%);
      border: none;
      border-radius: 8px;
      padding: 10px 20px;
      font-weight: 500;
      transition: var(--transition);
    }
    .btn-primary:hover {
      background: linear-gradient(135deg, #ff4040 0%, #470000 100%);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    .filter-btn {
      background: #ffffff;
      color: #1a202c;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      padding: 10px 20px;
      font-size: 15px;
      font-weight: 500;
      box-shadow: var(--button-shadow);
      transition: var(--transition);
    }
    .filter-btn:hover {
      background: linear-gradient(135deg, #f7fafc, #edf2f7);
      transform: translateY(-2px);
    }
    .modal-content {
      border-radius: 12px;
      padding: 30px;
      border: 2px solid var(--primary-color);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      animation: slideIn 0.3s ease-out;
    }
    @keyframes slideIn {
      from {
        transform: translateY(-20px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }
    .modal-content h3 {
      text-align: center;
      font-weight: 600;
      margin-bottom: 20px;
      color: #1a202c;
    }
    .modal-close-btn {
      position: absolute;
      top: 15px;
      right: 15px;
      background: none;
      border: none;
      font-size: 1.5rem;
      color: #4a5568;
      cursor: pointer;
      transition: var(--transition);
    }
    .modal-close-btn:hover {
      color: var(--accent-color);
      transform: scale(1.1);
    }
    .form-group {
      margin-bottom: 1.5rem;
    }
    .form-group label {
      font-weight: 500;
      font-size: 0.95rem;
      color: #2d3748;
      margin-bottom: 10px;
      display: block;
    }
    .form-control {
      height: 44px;
      border-radius: 8px;
      font-size: 0.95rem;
      border: 1px solid #e2e8f0;
      transition: var(--transition);
    }
    .form-control:focus {
      border-color: var(--accent-color);
      box-shadow: 0 0 8px rgba(255, 77, 79, 0.2);
    }
    .form-control::placeholder {
      color: #a0aec0;
    }
    .form-group select.form-control {
      appearance: none;
      background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path fill="%234a5568" d="M7 10l5 5 5-5z"/></svg>');
      background-repeat: no-repeat;
      background-position: right 12px center;
      background-size: 14px;
    }
    @media (max-width: 768px) {
      .content-wrapper {
        margin-left: 0;
        padding: 60px 12px 12px;
      }
      .center-card {
        padding: 15px;
        font-size: 0.85rem;
      }
    }
    @media (min-width: 769px) and (max-width: 991px) {
      .content-wrapper {
        margin-left: 200px;
        padding: 70px 18px 18px;
      }
      .content-wrapper.minimized {
        margin-left: 60px;
      }
    }
  </style>
</head>
<body>
  
<!-- Sidebar -->
<?php $this->load->view('superadmin/Include/Sidebar') ?>
<!-- Navbar -->
<?php $this->load->view('superadmin/Include/Navbar') ?>
  <div class="content-wrapper" id="contentWrapper">
    <div class="container">
      <h4>Center Management</h4>
      <div class="filter-wrapper mb-4">
        <button class="filter-btn btn" data-toggle="modal" data-target="#filterModal">
          <i class="fas fa-filter mr-2"></i> Filter
        </button>
      </div>
      <div class="row" id="centerCards">
        <!-- Centers will be loaded here -->
      </div>
      <div class="text-center mt-4">
    <a href="<?php echo base_url('superadmin/add_new_center'); ?>" class="btn btn-primary">
        <i class="fas fa-plus mr-2"></i> Add Center
    </a>
</div>

    </div>
  </div>

  <!-- New Center Modal -->
  <div class="modal fade" id="newCenterModal" tabindex="-1" aria-labelledby="newCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <button type="button" class="modal-close-btn" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
        <h3 id="newCenterLabel">Add Center Details</h3>
        <form id="centerForm">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="center_name">Center Name <span class="text-danger">*</span></label>
              <input type="text" id="center_name" name="center_name" class="form-control" required placeholder="Enter Center Name" />
            </div>
            <div class="form-group col-md-6">
              <label for="center_timing">Timing <span class="text-danger">*</span></label>
              <input type="time" id="center_timing" name="center_timing" class="form-control" required />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="center_rent">Center Rent <span class="text-danger">*</span></label>
              <input type="number" id="center_rent" name="center_rent" class="form-control" required placeholder="Enter Rent Amount" />
            </div>
            <div class="form-group col-md-6">
              <label for="center_rent_date">Rent Date <span class="text-danger">*</span></label>
              <input type="date" id="center_rent_date" name="center_rent_date" class="form-control" required />
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="centerSubmitBtn">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Filter Modal -->
  <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <button type="button" class="modal-close-btn" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
        <h3 id="filterLabel">Filter Centers</h3>
        <form id="filterForm">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="filterCenterName">Center Name</label>
              <input type="text" id="filterCenterName" name="filterCenterName" class="form-control" placeholder="Enter center name" />
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Apply Filter</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).ready(function() {
      // Load Centers
      function loadCenters() {
        // For demo purposes, we'll use mock data
        const mockCenters = [
          { id: 1, name: "Downtown Center", timing: "08:00", rent: 5000, rent_date: "2023-05-15" },
          { id: 2, name: "Uptown Center", timing: "09:30", rent: 6000, rent_date: "2023-05-20" },
          { id: 3, name: "Westside Center", timing: "10:00", rent: 5500, rent_date: "2023-05-25" }
        ];
        
        $('#centerCards').empty();
        mockCenters.forEach(center => {
          let card = `
            <div class="col-md-4">
              <div class="center-card">
                <div class="card-details">
                  <p>${center.name}</p>
                  <p><span>Timing:</span> ${center.timing}</p>
                  <p><span>Rent:</span> $${center.rent}</p>
                  <p><span>Rent Date:</span> ${center.rent_date}</p>
                  <button class="btn btn-primary view-btn" data-center-id="${center.id}">View Details</button>
                </div>
              </div>
            </div>`;
          $('#centerCards').append(card);
        });
      }

      // View Center Details - redirect to details page
      $(document).on('click', '.view-btn', function() {
        const centerId = $(this).data('center-id');
        // Redirect to the center details page with the center ID
        window.location.href = '<?php echo base_url("superadmin/view_center_details"); ?>?center_id=' + centerId;
      });

      // Center Submit
      $('#centerSubmitBtn').click(function(e) {
        e.preventDefault();
        const form = $('#centerForm')[0];
        if (!form.checkValidity()) {
          form.reportValidity();
          return;
        }
        
        const centerData = {
          name: $('#center_name').val(),
          timing: $('#center_timing').val(),
          rent: $('#center_rent').val(),
          rent_date: $('#center_rent_date').val()
        };
        
        // For demo purposes, we'll just show a success message
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'Center added successfully!',
          confirmButtonText: 'OK'
        }).then(() => {
          $('#newCenterModal').modal('hide');
          $('#centerForm').trigger('reset');
          loadCenters();
        });
      });

      // Filter Centers
      $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        let filterName = $('#filterCenterName').val().toLowerCase();
        
        $('.center-card').each(function() {
          const centerName = $(this).find('p:first').text().toLowerCase();
          if (centerName.includes(filterName)) {
            $(this).parent().show();
          } else {
            $(this).parent().hide();
          }
        });
        
        $('#filterModal').modal('hide');
      });

      // Initialize
      loadCenters();
    });
  </script>
</body>
</html>