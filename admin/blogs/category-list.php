<?php
require "../../setting.php";

$obj = new Database('blogs_categories');
$categories = $obj->fetchAll();
?>

<!doctype html>
<html lang="en">

<head>
  <?php include BASE_PATH . "admin/includes/head.php"; ?>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
    data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

    <!-- Sidebar Start -->
    <?php include BASE_PATH . "admin/includes/side-menu.php"; ?>
    <!-- Sidebar End -->

    <!-- Main wrapper -->
    <div class="body-wrapper">

      <!-- Header Start -->
      <?php include BASE_PATH . "admin/includes/header.php"; ?>
      <!-- Header End -->

      <div class="container-fluid">

        <!-- Admin Table Card -->
        <div class="card">
          <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5 class="card-title fw-semibold mb-0">Categories List</h5>

              <a href="<?= BASE_URL ?>admin/blogs/category-new.php" class="btn btn-primary">
                Add Category
              </a>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  foreach ($categories as $cat) {
                  ?>
                    <tr>
                      <td><?= $cat['id'] ?></td>
                      <td>
                        <?php if (!empty($cat['image'])): ?>
                          <img src="<?= BASE_URL . 'uploads/categories/' . $cat['image'] ?>" width="50" height="50" style="object-fit:cover;">
                        <?php else: ?>
                          <span>No Image</span>
                        <?php endif; ?>
                      </td>
                      <td><?= htmlspecialchars($cat['name']) ?></td>
                      <td><?= htmlspecialchars($cat['slug']) ?></td>
                      <td>
                        <a href="<?= BASE_URL ?>admin/blogs/category-new.php?eid=<?= $cat['id'] ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="process_category.php?did=<?= $cat['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>

        <!-- Footer -->
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">
            Design and Developed by
            <a href="" target="_blank"
              class="pe-1 text-primary text-decoration-underline">
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