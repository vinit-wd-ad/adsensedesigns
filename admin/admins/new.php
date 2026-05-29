<?php
require "../../setting.php";

$current_user_role = $_SESSION['admin_role'];
$current_user_id   = $_SESSION['admin_id'];

$obj = new Database('admins');
$isEdit = false;

if (isset($_GET['eid'])) {
    $isEdit = true;
    $eid = $_GET['eid'];

    if ($current_user_role !== 'Super Admin' && $eid != $current_user_id) {
        header("Location: " . BASE_URL . "admin/admins/admin-list.php");
        exit;
    }

    $admin = $obj->find($eid);

    if (!$admin) {
        header("Location: " . BASE_URL . "admin/admins/admin-list.php");
        exit;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php include BASE_PATH . "admin/includes/head.php"; ?>
</head>

<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical"
        data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <?php include BASE_PATH . "admin/includes/side-menu.php"; ?>

        <div class="body-wrapper">

            <?php include BASE_PATH . "admin/includes/header.php"; ?>

            <div class="container-fluid">

                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-semibold mb-0">
                                <?= $isEdit ? 'Edit Admin Profile' : 'Add New Admin' ?>
                            </h5>
                            <a href="<?= BASE_URL ?>admin/admins/admin-list.php" class="btn btn-primary">
                                Admins List
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/newAdmin.php" method="POST" class="mt-3">
                            <?php if ($isEdit) { ?>
                                <input type="hidden" name="id" value="<?= $admin['id'] ?>" />
                            <?php } ?>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="full_name" class="form-control" placeholder="Enter full name" value="<?= $isEdit ? htmlspecialchars($admin['name']) : '' ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">UserName</label>
                                    <input type="text" name="username" class="form-control" placeholder="Enter username" value="<?= $isEdit ? htmlspecialchars($admin['username']) : '' ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email" value="<?= $isEdit ? htmlspecialchars($admin['email']) : '' ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Admin Role</label>

                                    <?php if ($current_user_role === 'Super Admin'): ?>
                                        <select name="role" class="form-select" required>
                                            <option value="">Select Role</option>
                                            <option <?= ($isEdit && $admin['role'] == 'Super Admin') ? 'selected' : '' ?> value="Super Admin">Super Admin</option>
                                            <option <?= ($isEdit && $admin['role'] == 'Admin') ? 'selected' : '' ?> value="Admin">Admin</option>
                                            <option <?= ($isEdit && $admin['role'] == 'Moderator') ? 'selected' : '' ?> value="Moderator">Moderator</option>
                                        </select>
                                    <?php else: ?>
                                        <select class="form-select" disabled>
                                            <option selected><?= $isEdit ? htmlspecialchars($admin['role']) : 'Admin' ?></option>
                                        </select>
                                        <input type="hidden" name="role" value="<?= $isEdit ? htmlspecialchars($admin['role']) : 'Admin' ?>">
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Status</label>

                                    <?php if ($current_user_role === 'Super Admin'): ?>
                                        <select name="status" class="form-select" required>
                                            <option <?= ($isEdit && $admin['status'] == 'Active') ? 'selected' : '' ?> value="Active">Active</option>
                                            <option <?= ($isEdit && $admin['status'] == 'Pending') ? 'selected' : '' ?> value="Pending">Pending</option>
                                            <option <?= ($isEdit && $admin['status'] == 'Blocked') ? 'selected' : '' ?> value="Blocked">Blocked</option>
                                        </select>
                                    <?php else: ?>
                                        <select class="form-select" disabled>
                                            <option selected><?= $isEdit ? htmlspecialchars($admin['status']) : 'Active' ?></option>
                                        </select>
                                        <input type="hidden" name="status" value="<?= $isEdit ? htmlspecialchars($admin['status']) : 'Active' ?>">
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password <?= $isEdit ? '<small class="text-muted">(Leave blank to keep current)</small>' : '' ?></label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter password" <?= $isEdit ? '' : 'required' ?>>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password" <?= $isEdit ? '' : 'required' ?>>
                                </div>

                            </div>

                            <?php if (isset($_GET['error'])): ?>
                                <div class="alert alert-danger p-2 mb-3 fs-3">
                                    <?= htmlspecialchars($_GET['error']) ?>
                                </div>
                            <?php endif; ?>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <?= $isEdit ? 'Update Profile' : 'Add Admin' ?>
                                </button>
                                <a href="<?= BASE_URL ?>admin/admins/admin-list.php" class="btn btn-light-danger text-danger">
                                    Cancel
                                </a>
                            </div>

                        </form>

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