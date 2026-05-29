<?php 
require "../../setting.php";

$current_user_role = $_SESSION['admin_role'];
$current_user_id   = $_SESSION['admin_id'];

$obj = new Database('admins');

// ====================================================================
// ROLE BASED FILTERING (QUERY LEVEL)
// ====================================================================
try {
    if ($current_user_role === 'Super Admin') {
        $admins = $obj->fetchAll();
    } 
    elseif ($current_user_role === 'Admin') {
        $admins = $obj->whereCustom(['role' => 'Super Admin'], "role != :role");
    } 
    elseif ($current_user_role === 'Moderator') {
        $admins = $obj->where(['id' => $current_user_id]);
    } else {
        $admins = [];
    }
} catch (Exception $e) {
    $admins = [];
}
?>

<!doctype html>
<html lang="en">

<head>
  <?php include BASE_PATH . "admin/includes/head.php"; ?>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
    data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

    <?php include BASE_PATH . "admin/includes/side-menu.php"; ?>
    <div class="body-wrapper">

      <?php include BASE_PATH . "admin/includes/header.php"; ?>
      <div class="container-fluid">

        <div class="card">
          <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5 class="card-title fw-semibold mb-0">Admins List</h5>
              
              <?php if ($current_user_role !== 'Moderator'): ?>
                <a href="<?= BASE_URL ?>admin/admins/new.php" class="btn btn-primary">
                  Add Admin
                </a>
              <?php endif; ?>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered table-hover align-middle text-center">

                <thead class="table-dark">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                <?php 
                if (!empty($admins)) {
                  foreach($admins as $admin){
                    
                    // ====================================================================
                    // PERMISSION CHECK FOR BUTTONS
                    // ====================================================================
                    $canEdit = false;
                    $canDelete = false;

                    if ($current_user_role === 'Super Admin') {
                        $canEdit = true;
                        $canDelete = true;
                    } 
                    elseif ($current_user_role === 'Admin') {
                        if ($admin['id'] == $current_user_id) {
                            $canEdit = true;
                        }
                        $canDelete = false; 
                    } 
                    elseif ($current_user_role === 'Moderator') {
                        if ($admin['id'] == $current_user_id) {
                            $canEdit = true;
                        }
                        $canDelete = false;
                    }
                ?>
                  <tr>
                    <td><?= $admin['id'] ?></td>
                    <td><?= htmlspecialchars($admin['name']) ?></td>
                    <td><?= htmlspecialchars($admin['email']) ?></td>
                    <td>
                      <span class="badge bg-secondary text-white"><?= htmlspecialchars($admin['role']) ?></span>
                    </td>
                    <td>
                      <span class="badge text-black border"><?= htmlspecialchars($admin['status']) ?></span>
                    </td>
                    <td><?= $admin['created_at'] ?></td>
                    <td>
                      <?php if ($canEdit): ?>
                        <a href="<?= BASE_URL ?>admin/admins/new.php?eid=<?= $admin['id'] ?>" class="btn btn-sm btn-info">Edit</a>
                      <?php else: ?>
                        <button class="btn btn-sm btn-secondary" disabled title="Not Allowed">Edit</button>
                      <?php endif; ?>

                      <?php if ($canDelete && $admin['id'] != $current_user_id): ?>
                        <button class="btn btn-sm btn-danger">Delete</button>
                      <?php else: ?>
                        <button class="btn btn-sm btn-secondary" disabled>Delete</button>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php 
                  }
                } else { 
                ?>
                  <tr>
                    <td colspan="7" class="text-muted text-center">No Records Found.</td>
                  </tr>
                <?php } ?>
                </tbody>

              </table>
            </div>

          </div>
        </div>

        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">
            Design and Developed by
            <a href="https://adsensedesigns.com" target="_blank" class="pe-1 text-primary text-decoration-underline">
              Adsensedesigns
            </a>
          </p>
        </div>

      </div>
    </div>
  </div>

  <?php include BASE_PATH . "admin/includes/script.php" ?>

</body>
</html>