 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-restroom"></i>
         </div>
         <div class="sidebar-brand-text mx-3">SLA</div>
     </a>
     <!-- Divider -->
     <hr class="sidebar-divider my-0">
     <!-- Divider -->
     <hr class="sidebar-divider">
     <!-- Heading -->
     <div class="sidebar-heading">
         Interface
     </div>
     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <?php
            $check_dashboard = '';
            foreach ($test->$group() as $item) {
                if ($item == 'dashboard_tiket') {
                    $check_dashboard = 1;
                }
            }
            if ($check_dashboard == 1) {
            ?>
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                 <i class="fas fa-fw fa-cog"></i>
                 <span>Dashboard</span>
             </a>
             <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <h6 class="collapse-header">Select the Tab:</h6>
                     <a class="collapse-item" href="index.php">Data Tiket</a>
                     <a class="collapse-item" href="index-gsuite.php">Data Tiket G-Suite</a>
                 </div>
             </div>
         <?php
            }
            ?>
     </li>
     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
             <i class="fas fa-fw fa-wrench"></i>
             <span>Tiket</span>
         </a>
         <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Select the Tab:</h6>
                 <a class="collapse-item" href="tiket.php">Data Tiket</a>
                 <a class="collapse-item" href="tiketgsuite.php">Data Tiket G-suite</a>
             </div>
         </div>
     </li>

     <?php
        $check_dashboard = '';
        foreach ($test->$group() as $item) {
            if ($item == 'admin_tiket') {
                $check_dashboard = 1;
            }
        }
        if ($check_dashboard == 1) {
        ?>
         <!-- Divider -->
         <hr class="sidebar-divider">
         <!-- Heading -->
         <div class="sidebar-heading">
             Addons
         </div>

         <!-- Nav Item - Pages Collapse Menu -->
         <li class="nav-item">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                 <i class="fas fa-fw fa-folder"></i>
                 <span>Admin</span>
             </a>
             <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <h6 class="collapse-header">User Screens:</h6>
                     <a class="collapse-item" href="admin.php">Data Admin</a>
                     <a class="collapse-item" href="input-admin.php">Register</a>
                     <a class="collapse-item" href="permission-dashboard.php">User Permission</a>
                     <div class="collapse-divider"></div>

                 </div>
             </div>
         </li>
     <?php
        }
        ?>


     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->