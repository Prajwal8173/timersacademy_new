<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centre Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-left: 0; /* Remove fixed margin */
            padding-top: 56px; /* Account for fixed navbar */
        }
        .sidebar {
            position: fixed;
            top: 56px; /* Below navbar */
            left: 0;
            height: calc(100% - 56px);
            width: 250px;
            z-index: 1000;
            background-color: #343a40;
            padding-top: 20px;
            transition: all 0.3s;
            overflow-y: auto;
        }
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1030;
        }
        .main-content {
            margin-left: 250px; /* Account for sidebar */
            padding: 20px;
            transition: margin-left 0.3s;
        }
        .collapsed-sidebar .main-content {
            margin-left: 0;
        }
        .header {
            background: linear-gradient(135deg, #ff4040 0%, #470000 100%);
            color: white;
            padding: 25px 0;
            margin-bottom: 30px;
        }
        .progress-container {
            margin: 30px 0;
            padding: 0 15px;
        }
        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 30px;
        }
        .section-title {
            color: #ff4040;
            border-bottom: 2px solid #ff4040;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .required-field::after {
            content: "*";
            color: red;
            margin-left: 4px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #ff4040 0%, #470000 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #e03a3a 0%, #3a0000 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .progress-bar {
            background: linear-gradient(135deg, #ff4040 0%, #470000 100%);
        }
        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-weight: bold;
            color: #6c757d;
        }
        .step-active .step-circle {
            background: linear-gradient(135deg, #ff4040 0%, #470000 100%);
            color: white;
        }
        .step-label {
            text-align: center;
            font-size: 14px;
            color: #6c757d;
        }
        .step-active .step-label {
            color: #ff4040;
            font-weight: 600;
        }
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }
        .conditional-field {
            display: none;
        }
        .add-more-btn {
            margin-top: 10px;
        }
        .staff-table, .facility-table, .batch-table {
            margin-top: 20px;
        }
        .facility-card, .batch-card {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f8f9fa;
        }
        .toggle-sidebar {
            cursor: pointer;
        }
        .modal-close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #6c757d;
            z-index: 1;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }
            .main-content {
                margin-left: 0;
            }
            .show-sidebar .sidebar {
                width: 250px;
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

    
    <!-- Main Content -->
    <div class="main-content">
        <div class="header text-center">
           
            <p class="lead">Add and manage your sports center details</p>
        </div>

        <div class="container-fluid">
            <!-- Progress Bar -->
            <div class="progress-container">
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <div class="step step-active">
                        <div class="step-circle">1</div>
                        <div class="step-label">Centre Details</div>
                    </div>
                    <div class="step">
                        <div class="step-circle">2</div>
                        <div class="step-label">Batch Details</div>
                    </div>
                    <div class="step">
                        <div class="step-circle">3</div>
                        <div class="step-label">Staff Details</div>
                    </div>
                    <div class="step">
                        <div class="step-circle">4</div>
                        <div class="step-label">Facility Details</div>
                    </div>
                </div>
            </div>

            <!-- Centre Details Form -->
            <div class="form-container form-section active" id="centre-details">
                <h3 class="section-title"><i class="fas fa-info-circle me-2"></i>Centre Details</h3>
                <form id="centreForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="centreName" class="form-label required-field">Centre Name</label>
                            <input type="text" class="form-control" id="centreName" >
                        </div>
                        <div class="col-md-6">
                            <label for="centreNumber" class="form-label">Centre Number</label>
                            <input type="text" class="form-control" id="centreNumber">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label required-field">Address</label>
                        <textarea class="form-control" id="address" rows="3" ></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="openingTime" class="form-label required-field">Opening Time</label>
                            <input type="time" class="form-control" id="openingTime" >
                        </div>
                        <div class="col-md-6">
                            <label for="closingTime" class="form-label required-field">Closing Time</label>
                            <input type="time" class="form-control" id="closingTime" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="printDate" class="form-label"> Date</label>
                            <input type="date" class="form-control" id="printDate">
                        </div>

                        
                        <div class="col-md-6">
                            <label for="printPaidDate" class="form-label"> Paid Date</label>
                            <input type="date" class="form-control" id="printPaidDate">
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label"> Password</label>
                            <input type="password" class="form-control" id="password">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary btn-next" data-next="batch-details">
                            Next: Batch Details <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Batch Details Form -->
            <div class="form-container form-section" id="batch-details">
                <h3 class="section-title"><i class="fas fa-layer-group me-2"></i>Batch Details</h3>
                <form id="batchForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="batchName" class="form-label required-field">Batch Name</label>
                            <input type="text" class="form-control" id="batchName" >
                        </div>
                        <div class="col-md-6">
                            <label for="batchLevel" class="form-label required-field">Level</label>
                            <select class="form-select" id="batchLevel" >
                                <option value="">Select Level</option>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="batchStartTime" class="form-label required-field">Start Time</label>
                            <input type="time" class="form-control" id="batchStartTime" >
                        </div>
                        <div class="col-md-6">
                            <label for="batchEndTime" class="form-label required-field">End Time</label>
                            <input type="time" class="form-control" id="batchEndTime" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="startDate" class="form-label required-field">Start Date</label>
                            <input type="date" class="form-control" id="startDate" >
                        </div>
                        <div class="col-md-6">
                            <label for="endDate" class="form-label required-field">End Date</label>
                            <input type="date" class="form-control" id="endDate" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="duration" class="form-label required-field">Duration (hours)</label>
                            <input type="number" class="form-control" id="duration" min="1" >
                        </div>
                        <div class="col-md-6">
                            <label for="category" class="form-label required-field">Category</label>
                            <select class="form-select" id="category" >
                                <option value="">Select Category</option>
                                <option value="corporate">Corporate</option>
                                <option value="individual">Individual</option>
                                <option value="group">Group</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary btn-prev" data-prev="centre-details">
                            <i class="fas fa-arrow-left me-2"></i> Back to Centre Details
                        </button>
                        <div>
                            <button type="button" class="btn btn-info" id="addAnotherBatch">
                                <i class="fas fa-plus me-2"></i> Add Another Batch
                            </button>
                            <button type="button" class="btn btn-primary btn-next" data-next="staff-details">
                                Next: Staff Details <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
                
                <div class="text-right mt-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#batchModal">
                        <i class="fas fa-plus"></i> Add Batch
                    </button>
                </div>

                <!-- Batch List Table -->
                <div class="batch-table mt-4">
                    <h5 class="mb-3">Added Batches</h5>
                    <div id="batchList">
                        <p class="text-center">No batches added yet</p>
                    </div>
                </div>
            </div>

            <!-- Staff Details Form -->
            <div class="form-container form-section" id="staff-details">
                <h3 class="section-title"><i class="fas fa-users me-2"></i>Staff Details</h3>
                <form id="staffForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="staffName" class="form-label required-field">Staff Name</label>
                            <input type="text" class="form-control" id="staffName" >
                        </div>
                        <div class="col-md-6">
                            <label for="contactNo" class="form-label required-field">Contact Number</label>
                            <input type="tel" class="form-control" id="contactNo" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="role" class="form-label required-field">Role</label>
                            <select class="form-select" id="role" >
                                <option value="">Select Role</option>
                                <option value="admin">Administrator</option>
                                <option value="manager">Manager</option>
                                <option value="coach">Coach</option>
                                <option value="support">Support Staff</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="joiningDate" class="form-label required-field">Joining Date</label>
                            <input type="date" class="form-control" id="joiningDate" >
                        </div>
                    </div>
                    
                    <!-- Conditional Coach Assignment Fields -->
                    <div id="coachAssignment" class="conditional-field">
                        <h5 class="mt-4 mb-3">Coach Batch Assignment</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="assignedBatch" class="form-label">Assign Batch</label>
                                <select class="form-select" id="assignedBatch">
                                    <option value="">Select Batch</option>
                                    <!-- Batches will be populated dynamically -->
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="coachLevel" class="form-label">Coach Level</label>
                                <select class="form-select" id="coachLevel">
                                    <option value="">Select Level</option>
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="coachCategory" class="form-label">Category Specialization</label>
                                <select class="form-select" id="coachCategory">
                                    <option value="">Select Category</option>
                                    <option value="corporate">Corporate</option>
                                    <option value="individual">Individual</option>
                                    <option value="group">Group</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="coachDuration" class="form-label">Session Duration (hours)</label>
                                <input type="number" class="form-control" id="coachDuration" min="1">
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary btn-prev" data-prev="batch-details">
                            <i class="fas fa-arrow-left me-2"></i> Back to Batch Details
                        </button>
                        <div>
                            <button type="button" class="btn btn-info" id="addAnotherStaff">
                                <i class="fas fa-plus me-2"></i> Add Another Staff
                            </button>
                            <button type="button" class="btn btn-primary btn-next" data-next="facility-details">
                                Next: Facility Details <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="text-right mt-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staffModal">
                        <i class="fas fa-plus"></i> Add Staff
                    </button>
                </div>
                
                <!-- Staff List Table -->
                <div class="staff-table mt-4">
                    <h5 class="mb-3">Added Staff Members</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Role</th>
                                    <th>Joining Date</th>
                                    <th>Assigned Batch</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="staffList">
                                <tr>
                                    <td colspan="6" class="text-center">No staff members added yet</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Facility Details Form -->
            <div class="form-container form-section" id="facility-details">
                <h3 class="section-title"><i class="fas fa-dumbbell me-2"></i>Facility Details</h3>
                <form id="facilityForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="facilityType" class="form-label required-field">Facility Type</label>
                            <select class="form-select" id="facilityType" >
                                <option value="">Select Facility Type</option>
                                <option value="sports">Sports Equipment</option>
                                <option value="classroom">Classroom</option>
                                <option value="court">Court</option>
                                <option value="pool">Swimming Pool</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="subType" class="form-label">Subtype</label>
                            <input type="text" class="form-control" id="subType">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="printDetails" class="form-label">Print Details (according to subtype)</label>
                        <textarea class="form-control" id="printDetails" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="facilityQuantity" class="form-label required-field">Quantity</label>
                        <input type="number" class="form-control" id="facilityQuantity" min="1" >
                    </div>
                    <div class="mb-3">
                        <label for="facilityCondition" class="form-label required-field">Condition</label>
                        <select class="form-select" id="facilityCondition" >
                            <option value="">Select Condition</option>
                            <option value="excellent">Excellent</option>
                            <option value="good">Good</option>
                            <option value="fair">Fair</option>
                            <option value="poor">Poor</option>
                        </select>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary btn-prev" data-prev="staff-details">
                            <i class="fas fa-arrow-left me-2"></i> Back to Staff Details
                        </button>
                        <div>
                            <button type="button" class="btn btn-info" id="addAnotherFacility">
                                <i class="fas fa-plus me-2"></i> Add Another Facility
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i> Save Centre Details
                            </button>
                        </div>
                    </div>
                </form>
                <div class="text-right mt-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#facilityModal">
                        <i class="fas fa-plus"></i> Add Facility
                    </button>
                </div> 

                <!-- Facility List -->
                <div class="facility-table mt-4">
                    <h5 class="mb-3">Added Facilities</h5>
                    <div id="facilityList">
                        <p class="text-center">No facilities added yet</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Batch Modal -->
        <div class="modal fade" id="batchModal" tabindex="-1" aria-labelledby="batchLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="batchLabel">Add Batch</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="modalBatchForm">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="batch_timing" class="form-label">Batch Timing</label>
                                    <input type="time" id="batch_timing" name="batch_timing" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="batch_category" class="form-label">Category</label>
                                    <select id="batch_category" name="batch_category" class="form-control">
                                        <option value="">Select Category</option>
                                        <option value="Beginner">Beginner</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Advanced">Advanced</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="batchSubmitBtn">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Facility Modal -->
        <div class="modal fade" id="facilityModal" tabindex="-1" aria-labelledby="facilityLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="facilityLabel">Add Facility</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="modalFacilityForm">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="facility" class="form-label">Facility</label>
                                    <select id="facility" name="facility" class="form-control">
                                        <option value="">Select Facility</option>
                                        <option value="Locker">Locker</option>
                                        <option value="Shoe">Shoe</option>
                                        <option value="Racket">Racket</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="locker_no" class="form-label">Locker No</label>
                                    <input type="text" id="locker_no" name="locker_no" class="form-control" placeholder="Enter Locker No" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="facility_rent" class="form-label">Rent</label>
                                    <input type="number" id="facility_rent" name="facility_rent" class="form-control" placeholder="Enter Rent Amount" />
                                </div>
                                <div class="col-md-6">
                                    <label for="facility_rent_date" class="form-label">Rent Date</label>
                                    <input type="date" id="facility_rent_date" name="facility_rent_date" class="form-control" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="facilitySubmitBtn">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Staff Modal -->
        <div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="staffLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staffLabel">Add Staff</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="modalStaffForm">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="staff_category" class="form-label">Category</label>
                                    <select id="staff_category" name="staff_category" class="form-control">
                                        <option value="">Select Category</option>
                                        <option value="coach">Coach</option>
                                        <option value="co-ordinator">Co-ordinator</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="staff_name" class="form-label">Staff Name</label>
                                    <input type="text" id="staff_name" name="staff_name" class="form-control" placeholder="Enter Staff Name" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="staff_timing" class="form-label">Timing</label>
                                    <input type="time" id="staff_timing" name="staff_timing" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="staff_salary" class="form-label">Salary</label>
                                    <input type="number" id="staff_salary" name="staff_salary" class="form-control" placeholder="Enter Salary" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="staffSubmitBtn">Submit</button>
                    </div>
                </div>
            </div>
        </div>

       
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize modals
            const batchModal = new bootstrap.Modal(document.getElementById('batchModal'));
            const facilityModal = new bootstrap.Modal(document.getElementById('facilityModal'));
            const staffModal = new bootstrap.Modal(document.getElementById('staffModal'));
            
            // Modal submit buttons
            document.getElementById('batchSubmitBtn').addEventListener('click', function() {
                // Add your batch submission logic here
                batchModal.hide();
                alert('Batch added successfully!');
            });
            
            document.getElementById('facilitySubmitBtn').addEventListener('click', function() {
                // Add your facility submission logic here
                facilityModal.hide();
                alert('Facility added successfully!');
            });
            
            document.getElementById('staffSubmitBtn').addEventListener('click', function() {
                // Add your staff submission logic here
                staffModal.hide();
                alert('Staff added successfully!');
            });
            
            // Rest of your existing JavaScript code...
            const progressBar = document.querySelector('.progress-bar');
            const steps = document.querySelectorAll('.step');
            const formSections = document.querySelectorAll('.form-section');
            const nextButtons = document.querySelectorAll('.btn-next');
            const prevButtons = document.querySelectorAll('.btn-prev');
            const roleSelect = document.getElementById('role');
            const coachAssignment = document.getElementById('coachAssignment');
            const addAnotherStaffBtn = document.getElementById('addAnotherStaff');
            const staffForm = document.getElementById('staffForm');
            const staffList = document.getElementById('staffList');
            const addAnotherFacilityBtn = document.getElementById('addAnotherFacility');
            const facilityForm = document.getElementById('facilityForm');
            const facilityList = document.getElementById('facilityList');
            const addAnotherBatchBtn = document.getElementById('addAnotherBatch');
            const batchForm = document.getElementById('batchForm');
            const batchList = document.getElementById('batchList');
            const assignedBatchSelect = document.getElementById('assignedBatch');
            const toggleSidebarBtn = document.querySelector('.toggle-sidebar');
            const centreForm = document.getElementById('centreForm');
            
            let currentStep = 1;
            const totalSteps = 4;
            let staffMembers = [];
            let facilities = [];
            let batches = [];
            
            // Toggle sidebar on small screens
            if (toggleSidebarBtn) {
                toggleSidebarBtn.addEventListener('click', function() {
                    document.body.classList.toggle('show-sidebar');
                });
            }
            
            // Show/hide coach assignment fields based on role selection
            if (roleSelect) {
                roleSelect.addEventListener('change', function() {
                    if (this.value === 'coach') {
                        coachAssignment.style.display = 'block';
                        updateBatchDropdown();
                    } else {
                        coachAssignment.style.display = 'none';
                    }
                });
            }
            
            // Update batch dropdown with added batches
            function updateBatchDropdown() {
                if (!assignedBatchSelect) return;
                
                assignedBatchSelect.innerHTML = '<option value="">Select Batch</option>';
                batches.forEach((batch, index) => {
                    const option = document.createElement('option');
                    option.value = index;
                    option.textContent = batch.name;
                    assignedBatchSelect.appendChild(option);
                });
            }
            
            // Add batch functionality
            if (addAnotherBatchBtn) {
                addAnotherBatchBtn.addEventListener('click', function() {
                    // Validate form
                    const batchName = document.getElementById('batchName');
                    const batchLevel = document.getElementById('batchLevel');
                    const batchStartTime = document.getElementById('batchStartTime');
                    const batchEndTime = document.getElementById('batchEndTime');
                    const startDate = document.getElementById('startDate');
                    const endDate = document.getElementById('endDate');
                    const duration = document.getElementById('duration');
                    const category = document.getElementById('category');
                    
                    let isValid = true;
                    
                    if (!batchName.value) {
                        batchName.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        batchName.classList.remove('is-invalid');
                    }
                    
                    if (!batchLevel.value) {
                        batchLevel.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        batchLevel.classList.remove('is-invalid');
                    }
                    
                    if (!batchStartTime.value) {
                        batchStartTime.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        batchStartTime.classList.remove('is-invalid');
                    }
                    
                    if (!batchEndTime.value) {
                        batchEndTime.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        batchEndTime.classList.remove('is-invalid');
                    }
                    
                    if (!startDate.value) {
                        startDate.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        startDate.classList.remove('is-invalid');
                    }
                    
                    if (!endDate.value) {
                        endDate.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        endDate.classList.remove('is-invalid');
                    }
                    
                    if (!duration.value) {
                        duration.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        duration.classList.remove('is-invalid');
                    }
                    
                    if (!category.value) {
                        category.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        category.classList.remove('is-invalid');
                    }
                    
                    if (!isValid) {
                        alert('Please fill all required fields before adding batch.');
                        return;
                    }
                    
                    // Collect batch data
                    const batchData = {
                        name: batchName.value,
                        level: batchLevel.value,
                        startTime: batchStartTime.value,
                        endTime: batchEndTime.value,
                        startDate: startDate.value,
                        endDate: endDate.value,
                        duration: duration.value,
                        category: category.value
                    };
                    
                    // Add to batch list
                    batches.push(batchData);
                    updateBatchList();
                    updateBatchDropdown();
                    
                    // Reset form
                    batchForm.reset();
                });
            }
            
            // Add staff member functionality
            if (addAnotherStaffBtn) {
                addAnotherStaffBtn.addEventListener('click', function() {
                    // Validate form
                    const staffName = document.getElementById('staffName');
                    const contactNo = document.getElementById('contactNo');
                    const role = document.getElementById('role');
                    const joiningDate = document.getElementById('joiningDate');
                    
                    let isValid = true;
                    
                    if (!staffName.value) {
                        staffName.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        staffName.classList.remove('is-invalid');
                    }
                    
                    if (!contactNo.value) {
                        contactNo.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        contactNo.classList.remove('is-invalid');
                    }
                    
                    if (!role.value) {
                        role.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        role.classList.remove('is-invalid');
                    }
                    
                    if (!joiningDate.value) {
                        joiningDate.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        joiningDate.classList.remove('is-invalid');
                    }
                    
                    if (!isValid) {
                        alert('Please fill all required fields before adding staff.');
                        return;
                    }
                    
                    // Collect staff data
                    const staffData = {
                        name: staffName.value,
                        contact: contactNo.value,
                        role: role.value,
                        joiningDate: joiningDate.value,
                        assignedBatch: role.value === 'coach' ? document.getElementById('assignedBatch').value : 'N/A',
                        level: role.value === 'coach' ? document.getElementById('coachLevel').value : 'N/A',
                        category: role.value === 'coach' ? document.getElementById('coachCategory').value : 'N/A',
                        duration: role.value === 'coach' ? document.getElementById('coachDuration').value : 'N/A'
                    };
                    
                    // Add to staff list
                    staffMembers.push(staffData);
                    updateStaffList();
                    
                    // Reset form
                    staffForm.reset();
                    if (coachAssignment) coachAssignment.style.display = 'none';
                });
            }
            
            // Add facility functionality
            if (addAnotherFacilityBtn) {
                addAnotherFacilityBtn.addEventListener('click', function() {
                    // Validate form
                    const facilityType = document.getElementById('facilityType');
                    const facilityQuantity = document.getElementById('facilityQuantity');
                    const facilityCondition = document.getElementById('facilityCondition');
                    
                    let isValid = true;
                    
                    if (!facilityType.value) {
                        facilityType.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        facilityType.classList.remove('is-invalid');
                    }
                    
                    if (!facilityQuantity.value) {
                        facilityQuantity.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        facilityQuantity.classList.remove('is-invalid');
                    }
                    
                    if (!facilityCondition.value) {
                        facilityCondition.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        facilityCondition.classList.remove('is-invalid');
                    }
                    
                    if (!isValid) {
                        alert('Please fill all required fields before adding facility.');
                        return;
                    }
                    
                    // Collect facility data
                    const facilityData = {
                        type: facilityType.value,
                        subType: document.getElementById('subType').value,
                        printDetails: document.getElementById('printDetails').value,
                        quantity: facilityQuantity.value,
                        condition: facilityCondition.value
                    };
                    
                    // Add to facility list
                    facilities.push(facilityData);
                    updateFacilityList();
                    
                    // Reset form
                    facilityForm.reset();
                });
            }
            
            // Update batch list
            function updateBatchList() {
                if (!batchList) return;
                
                if (batches.length === 0) {
                    batchList.innerHTML = '<p class="text-center">No batches added yet</p>';
                    return;
                }
                
                batchList.innerHTML = '';
                batches.forEach((batch, index) => {
                    const card = document.createElement('div');
                    card.className = 'batch-card';
                    card.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6>${batch.name} (${batch.level})</h6>
                                <p class="mb-1">Time: ${batch.startTime} - ${batch.endTime}</p>
                                <p class="mb-1">Dates: ${batch.startDate} to ${batch.endDate}</p>
                                <p class="mb-0">Duration: ${batch.duration} hours | Category: ${batch.category}</p>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-outline-primary me-1 edit-batch" data-index="${index}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger delete-batch" data-index="${index}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    `;
                    batchList.appendChild(card);
                });
                
                // Add event listeners for edit and delete buttons
                document.querySelectorAll('.edit-batch').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = this.getAttribute('data-index');
                        editBatch(index);
                    });
                });
                
                document.querySelectorAll('.delete-batch').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = this.getAttribute('data-index');
                        deleteBatch(index);
                    });
                });
            }
            
            // Update staff list table
            function updateStaffList() {
                if (!staffList) return;
                
                if (staffMembers.length === 0) {
                    staffList.innerHTML = '<tr><td colspan="6" class="text-center">No staff members added yet</td></tr>';
                    return;
                }
                
                staffList.innerHTML = '';
                staffMembers.forEach((staff, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${staff.name}</td>
                        <td>${staff.contact}</td>
                        <td>${staff.role.charAt(0).toUpperCase() + staff.role.slice(1)}</td>
                        <td>${staff.joiningDate}</td>
                        <td>${staff.assignedBatch}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-1 edit-staff" data-index="${index}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger delete-staff" data-index="${index}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    staffList.appendChild(row);
                });
                
                // Add event listeners for edit and delete buttons
                document.querySelectorAll('.edit-staff').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = this.getAttribute('data-index');
                        editStaff(index);
                    });
                });
                
                document.querySelectorAll('.delete-staff').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = this.getAttribute('data-index');
                        deleteStaff(index);
                    });
                });
            }
            
            // Update facility list
            function updateFacilityList() {
                if (!facilityList) return;
                
                if (facilities.length === 0) {
                    facilityList.innerHTML = '<p class="text-center">No facilities added yet</p>';
                    return;
                }
                
                facilityList.innerHTML = '';
                facilities.forEach((facility, index) => {
                    const card = document.createElement('div');
                    card.className = 'facility-card';
                    card.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6>${facility.type.charAt(0).toUpperCase() + facility.type.slice(1)}${facility.subType ? ' - ' + facility.subType : ''}</h6>
                                <p class="mb-1">Quantity: ${facility.quantity} | Condition: ${facility.condition}</p>
                                ${facility.printDetails ? `<p class="mb-0">Details: ${facility.printDetails}</p>` : ''}
                            </div>
                            <div>
                                <button class="btn btn-sm btn-outline-primary me-1 edit-facility" data-index="${index}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger delete-facility" data-index="${index}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    `;
                    facilityList.appendChild(card);
                });
                
                // Add event listeners for edit and delete buttons
                document.querySelectorAll('.edit-facility').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = this.getAttribute('data-index');
                        editFacility(index);
                    });
                });
                
                document.querySelectorAll('.delete-facility').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = this.getAttribute('data-index');
                        deleteFacility(index);
                    });
                });
            }
            
            // Edit batch function
            function editBatch(index) {
                const batch = batches[index];
                
                // Populate form fields
                document.getElementById('batchName').value = batch.name;
                document.getElementById('batchLevel').value = batch.level;
                document.getElementById('batchStartTime').value = batch.startTime;
                document.getElementById('batchEndTime').value = batch.endTime;
                document.getElementById('startDate').value = batch.startDate;
                document.getElementById('endDate').value = batch.endDate;
                document.getElementById('duration').value = batch.duration;
                document.getElementById('category').value = batch.category;
                
                // Remove the batch from the list
                batches.splice(index, 1);
                updateBatchList();
                updateBatchDropdown();
            }
            
            // Delete batch function
            function deleteBatch(index) {
                if (confirm('Are you sure you want to delete this batch?')) {
                    batches.splice(index, 1);
                    updateBatchList();
                    updateBatchDropdown();
                }
            }
            
            // Edit staff function
            function editStaff(index) {
                const staff = staffMembers[index];
                
                // Populate form fields
                document.getElementById('staffName').value = staff.name;
                document.getElementById('contactNo').value = staff.contact;
                document.getElementById('role').value = staff.role;
                document.getElementById('joiningDate').value = staff.joiningDate;
                
                if (staff.role === 'coach') {
                    document.getElementById('assignedBatch').value = staff.assignedBatch;
                    document.getElementById('coachLevel').value = staff.level;
                    document.getElementById('coachCategory').value = staff.category;
                    document.getElementById('coachDuration').value = staff.duration;
                    if (coachAssignment) coachAssignment.style.display = 'block';
                }
                
                // Remove the staff from the list
                staffMembers.splice(index, 1);
                updateStaffList();
            }
            
            // Delete staff function
            function deleteStaff(index) {
                if (confirm('Are you sure you want to delete this staff member?')) {
                    staffMembers.splice(index, 1);
                    updateStaffList();
                }
            }
            
            // Edit facility function
            function editFacility(index) {
                const facility = facilities[index];
                
                // Populate form fields
                document.getElementById('facilityType').value = facility.type;
                document.getElementById('subType').value = facility.subType;
                document.getElementById('printDetails').value = facility.printDetails;
                document.getElementById('facilityQuantity').value = facility.quantity;
                document.getElementById('facilityCondition').value = facility.condition;
                
                // Remove the facility from the list
                facilities.splice(index, 1);
                updateFacilityList();
            }
            
            // Delete facility function
            function deleteFacility(index) {
                if (confirm('Are you sure you want to delete this facility?')) {
                    facilities.splice(index, 1);
                    updateFacilityList();
                }
            }
            
            // Update progress bar and steps
            function updateProgress() {
                const progressPercentage = (currentStep / totalSteps) * 100;
                if (progressBar) progressBar.style.width = progressPercentage + '%';
                
                steps.forEach((step, index) => {
                    if (index < currentStep) {
                        step.classList.add('step-active');
                    } else {
                        step.classList.remove('step-active');
                    }
                });
            }
            
            // Next button functionality
            nextButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const nextSectionId = this.getAttribute('data-next');
                    
                    // Validate current form before proceeding
                    const currentSection = document.querySelector('.form-section.active');
                    const requiredFields = currentSection.querySelectorAll('[required]');
                    let isValid = true;
                    
                    requiredFields.forEach(field => {
                        if (!field.value) {
                            field.classList.add('is-invalid');
                            isValid = false;
                        } else {
                            field.classList.remove('is-invalid');
                        }
                    });
                    
                    if (!isValid) {
                        alert('Please fill all required fields before proceeding.');
                        return;
                    }
                    
                    // Update progress
                    currentStep++;
                    updateProgress();
                    
                    // Switch to next section
                    formSections.forEach(section => {
                        section.classList.remove('active');
                    });
                    document.getElementById(nextSectionId).classList.add('active');
                });
            });
            
            // Previous button functionality
            prevButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const prevSectionId = this.getAttribute('data-prev');
                    
                    // Update progress
                    currentStep--;
                    updateProgress();
                    
                    // Switch to previous section
                    formSections.forEach(section => {
                        section.classList.remove('active');
                    });
                    document.getElementById(prevSectionId).classList.add('active');
                });
            });
            
            // Form submission
            if (facilityForm) {
                facilityForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Validate form
                    const requiredFields = this.querySelectorAll('[required]');
                    let isValid = true;
                    
                    requiredFields.forEach(field => {
                        if (!field.value) {
                            field.classList.add('is-invalid');
                            isValid = false;
                        } else {
                            field.classList.remove('is-invalid');
                        }
                    });
                    
                    if (!isValid) {
                        alert('Please fill all required fields before submitting.');
                        return;
                    }
                    
                    // Collect all data
                    const centreData = {
                        name: document.getElementById('centreName').value,
                        number: document.getElementById('centreNumber').value,
                        address: document.getElementById('address').value,
                        openingTime: document.getElementById('openingTime').value,
                        closingTime: document.getElementById('closingTime').value,
                        printDate: document.getElementById('printDate').value,
                        printPaidDate: document.getElementById('printPaidDate').value,
                        batches: batches,
                        staff: staffMembers,
                        facilities: facilities
                    };
                    
                    // Here you would typically send the data to the server
                    console.log('Centre Data:', centreData);
                    alert('Centre details saved successfully!');
                    
                    // Reset the form and data
                    centreForm.reset();
                    batchForm.reset();
                    staffForm.reset();
                    facilityForm.reset();
                    
                    batches = [];
                    staffMembers = [];
                    facilities = [];
                    
                    updateBatchList();
                    updateStaffList();
                    updateFacilityList();
                    
                    // Reset to first step
                    currentStep = 1;
                    updateProgress();
                    
                    formSections.forEach(section => {
                        section.classList.remove('active');
                    });
                    document.getElementById('centre-details').classList.add('active');
                });
            }
            
            // Initialize the progress
            updateProgress();
        });
    </script>
</body>
</html>