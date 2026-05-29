<?php
require_once "../setting.php";
$obj = new Database('admins');
$admin = $obj->find($_SESSION['admin_id']);
?>

<!doctype html>
<html lang="en">

<head>
  <?php include "includes/head.php"; ?>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include "includes/side-menu.php"; ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <?php include "includes/header.php"; ?>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="row min-vh-75">
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                  Hi, Welcome '<?= ucwords($admin['name']) ?>' !
                </h5>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body text-center">
                <img src="assets/images/backgrounds/product-tip.png" alt="image" class="img-fluid" width="205">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4">Design and Developed by <a href="" target="_blank"
                class="pe-1 text-primary text-decoration-underline">Adsensedesigns</a></p>
          </div>
        </div>
      </div>
    </div>

    <?php include "includes/script.php" ?>
</body>

</html>