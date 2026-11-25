<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$certPages = ['certified-client-add.php', 'certified-client-view.php'];
$certMenuOpen = in_array($currentPage, $certPages, true);
$dashboardActive = $currentPage === 'dashboard.php';
?>
  <header class="main-header">
    <a href="<?php echo base_url; ?>admin/dashboard.php" class="logo">
      <span class="logo-mini"><b>AB</b></span>
      <span class="logo-lg"><b>Admin</b> AB-CB</span>
    </a>
    <nav class="navbar navbar-static-top">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="admin-avatar" aria-hidden="true">AB</span>
              <span class="hidden-xs">Admin</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <div class="admin-avatar admin-avatar-lg">AB</div>
                <p>
                  Administrator
                  <small>Manage certifications &amp; client records</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url; ?>process/logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="sidebar-user">
        <div class="admin-avatar admin-avatar-lg">AB</div>
        <p class="name">Admin Profile</p>
        <span class="status"><i class="fa fa-circle"></i> Online</span>
      </div>

      <ul class="sidebar-menu">
        <li class="header">Main</li>
        <li class="<?php echo $dashboardActive ? 'active' : ''; ?>">
          <a href="<?php echo base_url; ?>admin/dashboard.php">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview <?php echo $certMenuOpen ? 'active menu-open' : ''; ?>">
          <a href="#">
            <i class="fa fa-certificate"></i>
            <span>Certified Clients</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $currentPage === 'certified-client-add.php' ? 'active' : ''; ?>">
              <a href="<?php echo base_url; ?>admin/certified-client-add.php">
                <i class="fa fa-plus-circle"></i>
                <span>Add certification</span>
              </a>
            </li>
            <li class="<?php echo $currentPage === 'certified-client-view.php' ? 'active' : ''; ?>">
              <a href="<?php echo base_url; ?>admin/certified-client-view.php">
                <i class="fa fa-list"></i>
                <span>View all</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="header">Site</li>
        <li>
          <a href="<?php echo base_url; ?>" target="_blank" rel="noopener noreferrer">
            <i class="fa fa-external-link"></i>
            <span>View public website</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>