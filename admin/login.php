<?php
require_once '../setting.php';
require_once BASE_PATH . 'admin/classes/Installer.php';

Installer::initSetup();

$db = new Database('admins');
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email_or_user = trim($_POST['user-email']);
  $password = trim($_POST['password']);

  if (!empty($email_or_user) && !empty($password)) {

    $usersFound = $db->where(['username' => $email_or_user]);

    if (empty($usersFound)) {
      $usersFound = $db->where(['email' => $email_or_user]);
    }

    $user = !empty($usersFound) ? $usersFound[0] : null;

    if ($user && password_verify($password, $user['password'])) {

      $_SESSION['admin_logged_in'] = true;
      $_SESSION['admin_id'] = $user['id'];
      $_SESSION['admin_role'] = $user['role'];
      $_SESSION['admin_username'] = $user['username'];

      header("Location: index.php");
      exit;
    } else {
      $error = "Invalid Username/Email or Password!";
    }
  } else {
    $error = "Please fill in all fields.";
  }
}
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
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="assets/images/logos/vk-logo.png" class="w-15" alt="">
                </a>

                <!-- Error Message Display -->
                <?php if (!empty($error)): ?>
                  <div class="alert alert-danger text-center" role="alert">
                    <?php echo $error; ?>
                  </div>
                <?php endif; ?>

                <form action="" method="post">
                  <div class="mb-3">
                    <!-- FIX: '<label自动>' tag ko standard '<label>' kar diya hai -->
                    <label for="exampleInputEmail1" class="form-label">Username or Email</label>
                    <input name="user-email" type="text" class="form-control" id="exampleInputEmail1"
                      aria-describedby="emailHelp" required>
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" required>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remember this Device
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4">Sign In</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">New to SeoDash?</p>
                    <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Create an account</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include "includes/script.php"; ?>
</body>

</html>