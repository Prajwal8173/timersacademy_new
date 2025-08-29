<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Center Details</title>
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
    .inner-layout {
      display: flex;
      gap: 20px;
    }
    .inner-sidebar {
      width: 220px;
      padding: 15px 10px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      border-radius: 8px;
      background: linear-gradient(135deg, #ff4d4f 0%, #470000 100%) !important;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
      position: sticky;
      top: 90px;
      height: fit-content;
    }
    .inner-sidebar .menu-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px;
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      text-decoration: none;
      border-radius: 6px;
      font-weight: 500;
      transition: var(--transition);
    }
    .inner-sidebar .menu-item i {
      color: #ffecec;
      font-size: 16px;
      transition: color 0.25s ease;
    }
    .inner-sidebar .menu-item:hover {
      background: rgba(255, 255, 255, 0.25);
      transform: translateX(5px);
    }
    .inner-sidebar .menu-item:hover i {
      color: #fff;
    }
    .inner-sidebar .menu-item.active {
      background: #fff;
      color: #470000;
      font-weight: 600;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
    }
    .inner-sidebar .menu-item.active i {
      color: #470000;
    }
    .details-area {
      flex: 1;
      background: #fff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: var(--card-shadow);
    }
    .section-content {
      display: none;
    }
    .section-content.active {
      display: block;
    }
    h4 {
      font-weight: 600;
      font-size: 20px;
      color: #1a202c;
      margin-bottom: 15px;
    }
    .section-title {
      font-weight: 600;
      font-size: 16px;
      color: #2d3748;
      margin-bottom: 10px;
    }
    .center-card, .batch-card, .facility-card, .staff-card, .expense-card {
      background: #ffffff;
      border-radius: 12px;
      padding: 20px;
      border-left: 4px solid var(--accent-color);
      box-shadow: var(--card-shadow);
      margin-bottom: 20px;
      transition: var(--transition);
    }
    .center-card:hover, .batch-card:hover, .facility-card:hover, .staff-card:hover, .expense-card:hover {
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
    .btn-secondary {
      background: #e2e8f0;
      color: #4a5568;
      border-radius: 8px;
      padding: 10px 20px;
      font-weight: 500;
      transition: var(--transition);
    }
    .btn-secondary:hover {
      background: #cbd5e0;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    .btn-edit {
      background: linear-gradient(135deg, #ff4d4f, #470000);
      color: white;
      border: none;
      padding: 5px 12px;
      border-radius: 4px;
      font-size: 13px;
    }
    .btn-edit:hover {
      background: #300000;
      color: white;
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
    .batch-entry, .facility-entry, .staff-entry, .expense-entry {
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 15px;
      background: #f7fafc;
      position: relative;
    }
    .remove-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      padding: 5px 10px;
      font-size: 0.85rem;
      background: #e2e8f0;
      color: #4a5568;
      border-radius: 8px;
      transition: var(--transition);
    }
    .remove-btn:hover {
      background: #cbd5e0;
      transform: translateY(-2px);
    }
    @media (max-width: 768px) {
      .content-wrapper {
        margin-left: 0;
        padding: 60px 12px 12px;
      }
      .inner-layout {
        flex-direction: column;
      }
      .inner-sidebar {
        width: 100%;
        position: static;
      }
      .center-card, .batch-card, .facility-card, .staff-card, .expense-card {
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
      .inner-sidebar {
        width: 200px;
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
      <div class="inner-layout">
        <!-- Inner Sidebar -->
        <div class="inner-sidebar">
          <a href="#" class="menu-item active" onclick="showSection(event, 'centerInfo')">
            <i class="fas fa-info-circle"></i> Center Info
          </a>
          <a href="#" class="menu-item" onclick="showSection(event, 'batchDetails')">
            <i class="fas fa-users"></i> Batch Details
          </a>
          <a href="#" class="menu-item" onclick="showSection(event, 'facilityDetails')">
            <i class="fas fa-couch"></i> Facility Details
          </a>
          <a href="#" class="menu-item" onclick="showSection(event, 'staffDetails')">
            <i class="fas fa-user-tie"></i> Staff Details
          </a>
          <a href="#" class="menu-item" onclick="showSection(event, 'expenseDetails')">
            <i class="fas fa-money-bill-wave"></i> Expense Details
          </a>
        </div>
        
        <!-- Details Area -->
        <div class="details-area">
          <!-- Section: Center Info -->
          <div class="section-content active" id="centerInfo">
            <h4>Center Information</h4>
            <div id="centerInfoCard">
              <!-- Center info will be loaded here -->
            </div>
            <div class="text-right mt-4">
              <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i> Back to Centers
              </button>
            </div>
          </div>
          
          <!-- Section: Batch Details -->
          <div class="section-content" id="batchDetails">
            <h4>Batch Details</h4>
            <div id="batchCards"></div>
            <div class="text-right mt-4">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#batchModal">
                <i class="fas fa-plus"></i> Add Batch
              </button>
            </div>
          </div>
          
          <!-- Section: Facility Details -->
          <div class="section-content" id="facilityDetails">
            <h4>Facility Details</h4>
            <div id="facilityCards"></div>
            <div class="text-right mt-4">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#facilityModal">
                <i class="fas fa-plus"></i> Add Facility
              </button>
            </div>
          </div>
          
          <!-- Section: Staff Details -->
          <div class="section-content" id="staffDetails">
            <h4>Staff Details</h4>
            <div id="staffCards"></div>
            <div class="text-right mt-4">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staffModal">
                <i class="fas fa-plus"></i> Add Staff
              </button>
            </div>
          </div>
          
          <!-- Section: Expense Details -->
          <div class="section-content" id="expenseDetails">
            <h4>Expense Details</h4>
            <div id="expenseCards"></div>
            <div class="text-right mt-4">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#expenseModal">
                <i class="fas fa-plus"></i> Add Expense
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Batch Modal -->
  <div class="modal fade" id="batchModal" tabindex="-1" aria-labelledby="batchLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <button type="button" class="modal-close-btn" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
        <h3 id="batchLabel">Add Batch</h3>
        <form id="batchForm">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="batch_timing">Batch Timing <span class="text-danger">*</span></label>
              <input type="time" id="batch_timing" name="batch_timing" class="form-control" required />
            </div>
            <div class="form-group col-md-6">
              <label for="start_date">Start Date <span class="text-danger">*</span></label>
              <input type="date" id="start_date" name="start_date" class="form-control" required />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="batch_category">Category <span class="text-danger">*</span></label>
              <select id="batch_category" name="batch_category" class="form-control" required>
                <option value="">Select Category</option>
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Advanced">Advanced</option>
              </select>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="batchSubmitBtn">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Facility Modal -->
  <div class="modal fade" id="facilityModal" tabindex="-1" aria-labelledby="facilityLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <button type="button" class="modal-close-btn" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
        <h3 id="facilityLabel">Add Facility</h3>
        <form id="facilityForm">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="facility">Facility <span class="text-danger">*</span></label>
              <select id="facility" name="facility" class="form-control" required>
                <option value="">Select Facility</option>
                <option value="Locker">Locker</option>
                <option value="Shoe">Shoe</option>
                <option value="Racket">Racket</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="locker_no">Locker No</label>
              <input type="text" id="locker_no" name="locker_no" class="form-control" placeholder="Enter Locker No" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="facility_rent">Rent <span class="text-danger">*</span></label>
              <input type="number" id="facility_rent" name="facility_rent" class="form-control" required placeholder="Enter Rent Amount" />
            </div>
            <div class="form-group col-md-6">
              <label for="facility_rent_date">Rent Date <span class="text-danger">*</span></label>
              <input type="date" id="facility_rent_date" name="facility_rent_date" class="form-control" required />
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="facilitySubmitBtn">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Staff Modal -->
  <div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="staffLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <button type="button" class="modal-close-btn" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
        <h3 id="staffLabel">Add Staff</h3>
        <form id="staffForm">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="staff_category">Category <span class="text-danger">*</span></label>
              <select id="staff_category" name="staff_category" class="form-control" required>
                <option value="">Select Category</option>
                <option value="coach">Coach</option>
                <option value="co-ordinator">Co-ordinator</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="staff_name">Staff Name <span class="text-danger">*</span></label>
              <input type="text" id="staff_name" name="staff_name" class="form-control" required placeholder="Enter Staff Name" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="staff_timing">Timing <span class="text-danger">*</span></label>
              <input type="time" id="staff_timing" name="staff_timing" class="form-control" required />
            </div>
            <div class="form-group col-md-6">
              <label for="staff_salary">Salary <span class="text-danger">*</span></label>
              <input type="number" id="staff_salary" name="staff_salary" class="form-control" required placeholder="Enter Salary" />
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="staffSubmitBtn">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Expense Modal -->
  <div class="modal fade" id="expenseModal" tabindex="-1" aria-labelledby="expenseLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <button type="button" class="modal-close-btn" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
        <h3 id="expenseLabel">Add Expense</h3>
        <form id="expenseForm">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="expense_category">Category <span class="text-danger">*</span></label>
              <select id="expense_category" name="expense_category" class="form-control" required>
                <option value="">Select Category</option>
                <option value="Electricity">Electricity</option>
                <option value="Water">Water</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="expense_amount">Amount <span class="text-danger">*</span></label>
              <input type="number" id="expense_amount" name="expense_amount" class="form-control" required placeholder="Enter Amount" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="expense_date">Date <span class="text-danger">*</span></label>
              <input type="date" id="expense_date" name="expense_date" class="form-control" required />
            </div>
            <div class="form-group col-md-6">
              <label for="expense_description">Description</label>
              <input type="text" id="expense_description" name="expense_description" class="form-control" placeholder="Enter Description" />
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="expenseSubmitBtn">Submit</button>
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
      // Get center ID from URL
      const urlParams = new URLSearchParams(window.location.search);
      const centerId = urlParams.get('center_id');
      
      // Mock data for demonstration
      const mockCenterData = {
        1: {
          name: "Downtown Center",
          timing: "08:00",
          rent: 5000,
          rent_date: "2023-05-15",
          batches: [
            { id: 1, timing: "08:00", start_date: "2023-05-15", category: "Beginner" },
            { id: 2, timing: "10:00", start_date: "2023-05-16", category: "Intermediate" }
          ],
          facilities: [
            { id: 1, facility: "Locker", locker_no: "A12", rent: 200, rent_date: "2023-05-15" },
            { id: 2, facility: "Racket", rent: 100, rent_date: "2023-05-15" }
          ],
          staff: [
            { id: 1, category: "coach", name: "John Doe", timing: "08:00", salary: 3000 },
            { id: 2, category: "co-ordinator", name: "Jane Smith", timing: "09:00", salary: 2500 }
          ],
          expenses: [
            { id: 1, category: "Electricity", amount: 500, date: "2023-05-15", description: "Monthly bill" },
            { id: 2, category: "Water", amount: 200, date: "2023-05-16", description: "Water supply" }
          ]
        },
        2: {
          name: "Uptown Center",
          timing: "09:30",
          rent: 6000,
          rent_date: "2023-05-20",
          batches: [
            { id: 1, timing: "09:30", start_date: "2023-05-20", category: "Advanced" }
          ],
          facilities: [
            { id: 1, facility: "Shoe", rent: 150, rent_date: "2023-05-20" }
          ],
          staff: [
            { id: 1, category: "coach", name: "Mike Johnson", timing: "09:30", salary: 3200 }
          ],
          expenses: [
            { id: 1, category: "Maintenance", amount: 400, date: "2023-05-20", description: "Court repair" }
          ]
        },
        3: {
          name: "Westside Center",
          timing: "10:00",
          rent: 5500,
          rent_date: "2023-05-25",
          batches: [],
          facilities: [],
          staff: [],
          expenses: []
        }
      };

      // Load center information
      function loadCenterInfo() {
        if (centerId && mockCenterData[centerId]) {
          const center = mockCenterData[centerId];
          const centerInfo = `
            <div class="center-card">
              <div class="card-details">
                <p>${center.name}</p>
                <p><span>Timing:</span> ${center.timing}</p>
                <p><span>Rent:</span> $${center.rent}</p>
                <p><span>Rent Date:</span> ${center.rent_date}</p>
                <button class="btn btn-edit" data-toggle="modal" data-target="#editCenterModal">
                  <i class="fas fa-edit"></i> Edit
                </button>
              </div>
            </div>`;
          $('#centerInfoCard').html(centerInfo);
        } else {
          $('#centerInfoCard').html('<p class="text-danger">Center not found.</p>');
        }
      }

      // Load batch details
      function loadBatchDetails() {
        if (centerId && mockCenterData[centerId]) {
          const batches = mockCenterData[centerId].batches;
          $('#batchCards').empty();
          
          if (batches.length === 0) {
            $('#batchCards').html('<p class="text-muted">No batches found for this center.</p>');
            return;
          }
          
          batches.forEach(batch => {
            const batchCard = `
              <div class="batch-card">
                <div class="card-details">
                  <p>Batch ${batch.id}</p>
                  <p><span>Timing:</span> ${batch.timing}</p>
                  <p><span>Start Date:</span> ${batch.start_date}</p>
                  <p><span>Category:</span> ${batch.category}</p>
                  <button class="btn btn-edit" data-batch-id="${batch.id}">
                    <i class="fas fa-edit"></i> Edit
                  </button>
                </div>
              </div>`;
            $('#batchCards').append(batchCard);
          });
        }
      }

      // Load facility details
      function loadFacilityDetails() {
        if (centerId && mockCenterData[centerId]) {
          const facilities = mockCenterData[centerId].facilities;
          $('#facilityCards').empty();
          
          if (facilities.length === 0) {
            $('#facilityCards').html('<p class="text-muted">No facilities found for this center.</p>');
            return;
          }
          
          facilities.forEach(facility => {
            const facilityCard = `
              <div class="facility-card">
                <div class="card-details">
                  <p>${facility.facility}</p>
                  ${facility.locker_no ? `<p><span>Locker No:</span> ${facility.locker_no}</p>` : ''}
                  <p><span>Rent:</span> $${facility.rent}</p>
                  <p><span>Rent Date:</span> ${facility.rent_date}</p>
                  <button class="btn btn-edit" data-facility-id="${facility.id}">
                    <i class="fas fa-edit"></i> Edit
                  </button>
                </div>
              </div>`;
            $('#facilityCards').append(facilityCard);
          });
        }
      }

      // Load staff details
      function loadStaffDetails() {
        if (centerId && mockCenterData[centerId]) {
          const staff = mockCenterData[centerId].staff;
          $('#staffCards').empty();
          
          if (staff.length === 0) {
            $('#staffCards').html('<p class="text-muted">No staff found for this center.</p>');
            return;
          }
          
          staff.forEach(staffMember => {
            const staffCard = `
              <div class="staff-card">
                <div class="card-details">
                  <p>${staffMember.name}</p>
                  <p><span>Category:</span> ${staffMember.category}</p>
                  <p><span>Timing:</span> ${staffMember.timing}</p>
                  <p><span>Salary:</span> $${staffMember.salary}</p>
                  <button class="btn btn-edit" data-staff-id="${staffMember.id}">
                    <i class="fas fa-edit"></i> Edit
                  </button>
                </div>
              </div>`;
            $('#staffCards').append(staffCard);
          });
        }
      }

      // Load expense details
      function loadExpenseDetails() {
        if (centerId && mockCenterData[centerId]) {
          const expenses = mockCenterData[centerId].expenses;
          $('#expenseCards').empty();
          
          if (expenses.length === 0) {
            $('#expenseCards').html('<p class="text-muted">No expenses found for this center.</p>');
            return;
          }
          
          expenses.forEach(expense => {
            const expenseCard = `
              <div class="expense-card">
                <div class="card-details">
                  <p>${expense.category}</p>
                  <p><span>Amount:</span> $${expense.amount}</p>
                  <p><span>Date:</span> ${expense.date}</p>
                  ${expense.description ? `<p><span>Description:</span> ${expense.description}</p>` : ''}
                  <button class="btn btn-edit" data-expense-id="${expense.id}">
                    <i class="fas fa-edit"></i> Edit
                  </button>
                </div>
              </div>`;
            $('#expenseCards').append(expenseCard);
          });
        }
      }

      // Show section function
      window.showSection = function(event, sectionId) {
        event.preventDefault();
        $('.section-content').removeClass('active');
        $('#' + sectionId).addClass('active');
        
        $('.menu-item').removeClass('active');
        $(event.currentTarget).addClass('active');
        
        // Load data for the section if needed
        if (sectionId === 'batchDetails') {
          loadBatchDetails();
        } else if (sectionId === 'facilityDetails') {
          loadFacilityDetails();
        } else if (sectionId === 'staffDetails') {
          loadStaffDetails();
        } else if (sectionId === 'expenseDetails') {
          loadExpenseDetails();
        }
      };

      // Form submission handlers
      $('#batchSubmitBtn').click(function() {
        // For demo purposes, we'll just show a success message
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'Batch added successfully!',
          confirmButtonText: 'OK'
        }).then(() => {
          $('#batchModal').modal('hide');
          $('#batchForm').trigger('reset');
          loadBatchDetails();
        });
      });

      $('#facilitySubmitBtn').click(function() {
        // For demo purposes, we'll just show a success message
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'Facility added successfully!',
          confirmButtonText: 'OK'
        }).then(() => {
          $('#facilityModal').modal('hide');
          $('#facilityForm').trigger('reset');
          loadFacilityDetails();
        });
      });

      $('#staffSubmitBtn').click(function() {
        // For demo purposes, we'll just show a success message
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'Staff added successfully!',
          confirmButtonText: 'OK'
        }).then(() => {
          $('#staffModal').modal('hide');
          $('#staffForm').trigger('reset');
          loadStaffDetails();
        });
      });

      $('#expenseSubmitBtn').click(function() {
        // For demo purposes, we'll just show a success message
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'Expense added successfully!',
          confirmButtonText: 'OK'
        }).then(() => {
          $('#expenseModal').modal('hide');
          $('#expenseForm').trigger('reset');
          loadExpenseDetails();
        });
      });

      // Initialize
      loadCenterInfo();
    });
  </script>
</body>
</html>