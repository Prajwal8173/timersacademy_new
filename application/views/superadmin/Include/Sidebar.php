<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar with Smooth Submenu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            width: 250px;
            background-color: white;
            border-right: 1px solid #dee2e6;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            height: 100vh;
            padding-top: 10px;
            transition: width 0.3s ease-in-out;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .sidebar::-webkit-scrollbar {
            display: none;
        }

        .sidebar.minimized {
            width: 60px;
        }

        .sidebar .logo {
            text-align: center;
            padding: 32px 0;
            transition: padding 0.3s ease;
        }

        .sidebar.minimized .logo {
            padding: 15px 0;
        }

        .sidebar .logo img {
            max-width: 80%;
            height: 155px;
            transition: all 0.3s ease;
        }

        .sidebar.minimized .logo img {
            max-width: 40px;
            height: 40px;
        }

        .sidebar .nav-link {
            color: #000;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            font-size: 14px;
            text-decoration: none;
            border-radius: 30px;
            margin: 5px 10px;
            background-color: transparent;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #e9ecef;
            font-weight: 500;
        }

        .sidebar .nav-link.active {
            background-color: #e9ecef;
            font-weight: 700;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 16px;
            transition: margin 0.3s ease;
            min-width: 20px;
            text-align: center;
        }

        .sidebar.minimized .nav-link {
            justify-content: center;
            padding: 10px;
        }

        .sidebar.minimized .nav-link i {
            margin-right: 0;
        }

        .sidebar.minimized .nav-link span {
            display: none;
        }

        /* Improved submenu styling */
        .nav-item .collapse {
            transition: height 0.35s ease;
        }

        .nav-item .nav-link[data-bs-toggle="collapse"] .bi-chevron-down {
            transition: transform 0.35s ease;
        }

        .nav-item .nav-link[data-bs-toggle="collapse"][aria-expanded="true"] .bi-chevron-down {
            transform: rotate(180deg);
        }

        .nav-item .collapse .nav-link {
            padding-left: 40px;
            font-size: 13px;
            transition: all 0.2s ease;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
                transition: transform 0.3s ease-in-out;
            }

            .sidebar.active {
                transform: translateX(0);
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .sidebar.minimized {
                width: 60px;
            }
        }

        /* Content area styling */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 60px;
        }

        .toggle-btn {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1001;
            display: none;
        }

        @media (max-width: 768px) {
            .toggle-btn {
                display: block;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .main-content.expanded {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
  
    

    <!-- Sidebar Component -->
    <div class="sidebar" id="sidebar">
        <div class="logo">
    <img src="<?php echo base_url('assets/images/timeersbadmintonacademy_logo.png'); ?>" alt="Logo">
  </div>

        <nav class="nav flex-column">

           <!-- Dashboard -->
    <a class="nav-link <?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>"
       href="<?php echo base_url('superadmin/dashboard'); ?>">
      <i class="bi bi-speedometer2"></i><span>Dashboard</span>
    </a>

            <!-- Center Management -->
            
            <a class="nav-link <?php echo ($this->uri->segment(2) == 'CenterManagement2') ? 'active' : ''; ?>" 
       href="<?php echo base_url('superadmin/CenterManagement2'); ?>">
      <i class="bi bi-credit-card"></i><span>Center Management</span>
    </a>

            <!-- Admission Management (Parent with Submenu) -->
            <div class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center" 
                   data-bs-toggle="collapse" href="#admissionMenu" role="button" 
                   aria-expanded="false" aria-controls="admissionMenu">
                    <span><i class="bi bi-person-lines-fill"></i> <span>Admission Management</span></span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="admissionMenu">
                    <nav class="nav flex-column ms-3">
                         <a class="nav-link <?php echo ($this->uri->segment(2) == 'New_admission') ? 'active' : ''; ?>" 
           href="<?php echo base_url('superadmin/New_admission'); ?>">
          <i class="bi bi-plus-circle"></i><span> New Admission</span>
        </a>
                       <a class="nav-link <?php echo ($this->uri->segment(2) == 'Re_admission') ? 'active' : ''; ?>" 
           href="<?php echo base_url('superadmin/Re_admission'); ?>">
          <i class="bi bi-arrow-counterclockwise"></i><span> Re-Admission</span>
        </a>
                       <a class="nav-link <?php echo ($this->uri->segment(2) == 'Renew_admission') ? 'active' : ''; ?>" 
           href="<?php echo base_url('superadmin/Renew_admission'); ?>">
          <i class="bi bi-arrow-repeat"></i><span> Renew Admission</span>
        </a>
                        <a class="nav-link <?php echo ($this->uri->segment(2) == 'View_Re_Admission') ? 'active' : ''; ?>" 
           href="<?php echo base_url('superadmin/View_Re_Admission'); ?>">
          <i class="bi bi-eye"></i><span> View Re-Admission</span>
        </a>
                        <a class="nav-link <?php echo ($this->uri->segment(2) == 'View_Renew_Students') ? 'active' : ''; ?>" 
           href="<?php echo base_url('superadmin/View_Renew_Students'); ?>">
          <i class="bi bi-eye"></i><span> View Renew-Admission</span>
        </a>
                    </nav>
                </div>
            </div>

            <!-- Students -->
            <a class="nav-link <?php echo ($this->uri->segment(2) == 'Students') ? 'active' : ''; ?>" 
       href="<?php echo base_url('superadmin/Students'); ?>">
      <i class="bi bi-mortarboard"></i><span> Students Management</span>
    </a>

            <!-- Event List -->
            <a class="nav-link <?php echo ($this->uri->segment(2) == 'EventAndNotice') ? 'active' : ''; ?>" 
       href="<?php echo base_url('superadmin/EventAndNotice'); ?>">
      <i class="bi bi-calendar-event"></i><span>Event Management</span>
    </a>


     <a class="nav-link <?php echo ($this->uri->segment(2) == 'Finance') ? 'active' : ''; ?>" 
       href="<?php echo base_url('superadmin/Finance'); ?>">
      <i class="bi bi-cash-stack"></i><span>Finance Management</span>
    </a>

   
           <a class="nav-link <?php echo ($this->uri->segment(2) == 'Superadmin_profile') ? 'active' : ''; ?>" 
       href="<?php echo base_url('superadmin/Superadmin_profile'); ?>">
      <i class="bi bi-person-circle"></i><span>  Super Admin Profile</span>
    </a>

       


     <a class="nav-link <?php echo ($this->uri->segment(2) == 'Expenses') ? 'active' : ''; ?>" 
       href="<?php echo base_url('superadmin/Expenses'); ?>">
      <i class="bi bi-person-circle"></i><span> Expenses Management</span>
    </a>


            <!-- Logout -->
            <a class="nav-link" href="#">
                <i class="bi bi-box-arrow-right"></i><span>Logout</span>
            </a>
        </nav>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const minimizeBtn = document.getElementById('minimizeSidebar');
            const mobileToggleBtn = document.getElementById('sidebarToggle');
            const navLinks = sidebar.querySelectorAll('.nav-link');
            const collapseElements = sidebar.querySelectorAll('.collapse');
            
            // Toggle sidebar on desktop
            minimizeBtn.addEventListener('click', () => {
                sidebar.classList.toggle('minimized');
                mainContent.classList.toggle('expanded');
            });
            
            // Toggle sidebar on mobile
            mobileToggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
            
            // Save scroll position before navigation
            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    if (link.href && !link.getAttribute('data-bs-toggle')) {
                        const scrollPosition = sidebar.scrollTop;
                        sessionStorage.setItem('sidebarScrollPosition', scrollPosition);
                    }
                });
            });
            
            // Restore scroll position on page load
            const savedScrollPosition = sessionStorage.getItem('sidebarScrollPosition');
            if (savedScrollPosition !== null) {
                sidebar.scrollTop = parseInt(savedScrollPosition, 10);
            }
            
            // Improved submenu animation
            collapseElements.forEach(collapse => {
                collapse.addEventListener('show.bs.collapse', function () {
                    this.style.height = '0';
                    this.classList.add('show');
                    this.style.height = this.scrollHeight + 'px';
                });
                
                collapse.addEventListener('shown.bs.collapse', function () {
                    this.style.height = '';
                });
                
                collapse.addEventListener('hide.bs.collapse', function () {
                    this.style.height = this.scrollHeight + 'px';
                    setTimeout(() => {
                        this.style.height = '0';
                    }, 10);
                });
                
                collapse.addEventListener('hidden.bs.collapse', function () {
                    this.style.height = '';
                });
            });
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', (e) => {
                if (window.innerWidth < 769 && 
                    !sidebar.contains(e.target) && 
                    e.target !== mobileToggleBtn && 
                    !mobileToggleBtn.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            });
        });

        
    </script>
</body>
</html>