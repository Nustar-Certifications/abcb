<?php 
require_once './system/main.php';

$total = (int) mysqli_num_rows(mysqli_query($con, "SELECT id FROM r_certification"));

$accredited = 0;
$accQ = mysqli_query($con, "SELECT COUNT(*) AS c FROM r_certification WHERE accredited = '1'");
if ($accQ && ($row = mysqli_fetch_assoc($accQ))) {
    $accredited = (int) $row['c'];
}

$today = date('Y-m-d');
$activeValid = 0;
$validQ = mysqli_query($con, "SELECT COUNT(*) AS c FROM r_certification WHERE validTill >= '$today'");
if ($validQ && ($row = mysqli_fetch_assoc($validQ))) {
    $activeValid = (int) $row['c'];
}

$recentQ = mysqli_query($con, "SELECT id, certificationNumber, companyName, validTill, accredited FROM r_certification ORDER BY id DESC LIMIT 5");
?>
<!DOCTYPE html>
<html>
<head>
    <title>AB-CB | Dashboard</title>
  <?php require_once './parts/head.php'; ?>
</head>
<body class="hold-transition skin-blue admin-modern">
<div class="wrapper">

<?php require_once './parts/nav.php'; ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Overview</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
      </ol>
    </section>

    <section class="content">
      <div class="admin-welcome">
        <h2>Welcome back, Admin</h2>
        <p>Manage certified client records, accreditation status, and certificate validity from one place.</p>
      </div>

      <div class="admin-stat-grid">
        <div class="admin-stat-card stat-blue">
          <div class="stat-value"><?php echo $total; ?></div>
          <div class="stat-label">Total certifications</div>
          <a class="stat-link" href="<?php echo base_url; ?>admin/certified-client-view.php">View all &rarr;</a>
          <div class="stat-icon"><i class="fa fa-files-o"></i></div>
        </div>
        <div class="admin-stat-card stat-emerald">
          <div class="stat-value"><?php echo $accredited; ?></div>
          <div class="stat-label">Accredited clients</div>
          <span class="stat-link text-muted">On record</span>
          <div class="stat-icon"><i class="fa fa-check-circle"></i></div>
        </div>
        <div class="admin-stat-card stat-amber">
          <div class="stat-value"><?php echo $activeValid; ?></div>
          <div class="stat-label">Valid (not expired)</div>
          <span class="stat-link text-muted">As of today</span>
          <div class="stat-icon"><i class="fa fa-calendar-check-o"></i></div>
        </div>
        <div class="admin-stat-card stat-violet">
          <div class="stat-value"><?php echo max(0, $total - $activeValid); ?></div>
          <div class="stat-label">Past validity date</div>
          <a class="stat-link" href="<?php echo base_url; ?>admin/certified-client-view.php">Review &rarr;</a>
          <div class="stat-icon"><i class="fa fa-exclamation-circle"></i></div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-5">
          <div class="admin-panel">
            <div class="admin-panel-header">
              <h3>Quick actions</h3>
            </div>
            <div class="admin-panel-body">
              <div class="admin-quick-actions">
                <a href="<?php echo base_url; ?>admin/certified-client-add.php" class="admin-btn admin-btn-primary">
                  <i class="fa fa-plus"></i> Add certification
                </a>
                <a href="<?php echo base_url; ?>admin/certified-client-view.php" class="admin-btn admin-btn-secondary">
                  <i class="fa fa-table"></i> Browse records
                </a>
                <a href="<?php echo base_url; ?>" class="admin-btn admin-btn-secondary" target="_blank" rel="noopener">
                  <i class="fa fa-globe"></i> Public site
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="admin-panel">
            <div class="admin-panel-header">
              <h3>Recently added</h3>
              <a href="<?php echo base_url; ?>admin/certified-client-view.php" class="stat-link">See full list</a>
            </div>
            <div class="admin-panel-body" style="padding-top: 0;">
              <?php if ($recentQ && mysqli_num_rows($recentQ) > 0): ?>
              <div class="table-responsive">
                <table class="table table-hover" style="margin-bottom: 0;">
                  <thead>
                    <tr>
                      <th>Certificate</th>
                      <th>Company</th>
                      <th>Valid until</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($r = mysqli_fetch_assoc($recentQ)): ?>
                    <tr>
                      <td><strong><?php echo htmlspecialchars($r['certificationNumber'], ENT_QUOTES, 'UTF-8'); ?></strong></td>
                      <td><?php
                        $cn = $r['companyName'];
                        if (strlen($cn) > 36) {
                            $cn = substr($cn, 0, 33) . '...';
                        }
                        echo htmlspecialchars($cn, ENT_QUOTES, 'UTF-8');
                      ?></td>
                      <td><?php echo htmlspecialchars($r['validTill'], ENT_QUOTES, 'UTF-8'); ?></td>
                      <td>
                        <?php if ($r['accredited'] === '1'): ?>
                          <span class="label label-success">Accredited</span>
                        <?php else: ?>
                          <span class="label label-default">Standard</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
              <?php else: ?>
              <p class="text-muted" style="margin: 16px 0;">No certifications yet. <a href="<?php echo base_url; ?>admin/certified-client-add.php">Add your first record</a>.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>
  <?php require_once './parts/footer.php'; ?>

</div>
<?php require_once './parts/footer_script.php'; ?>
</body>
</html>