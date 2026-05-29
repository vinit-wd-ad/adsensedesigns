<?php
require "../../setting.php";

$obj = new Database('blogs');
$catObj = new Database('blogs_categories');

$blogs = $obj->fetchAll();

function cat($catId)
{
  global $catObj;

  $cat = $catObj->find($catId);

  return $cat['name'];
}
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
              <h5 class="card-title fw-semibold mb-0">Blogs List</h5>

              <a href="<?= BASE_URL ?>admin/blogs/blog-new.php" class="btn btn-primary">
                Add Blog
              </a>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($blogs as $blog) { ?>
                    <tr>
                      <td><?= $blog['id'] ?></td>
                      <td class="text-start"><?= htmlspecialchars($blog['title']) ?></td>
                      <td><?= cat($blog['category_id']) ?> </td>
                      <td>
                        <span class="badge <?= $blog['status'] == 'published' ? 'bg-success' : 'bg-warning' ?>">
                          <?= ucfirst($blog['status']) ?>
                        </span>
                      </td>
                      <td>
                        <a href="<?= BASE_URL ?>admin/blogs/blog-new.php?eid=<?= $blog['id'] ?>"
                          class="btn btn-sm btn-info" title="Edit Metadata">
                          <i class="ti ti-edit"></i> Edit
                        </a>

                        <a href="<?= BASE_URL ?>admin/blogs/seo-edit.php?blog_id=<?= $blog['id'] ?>"
                          class="btn btn-sm btn-warning" title="Manage SEO">
                          <i class="ti ti-search"></i> SEO
                        </a>

                        <a href="<?= BASE_URL ?>admin/blogs/edit-content.php?blog_id=<?= $blog['id'] ?>"
                          class="btn btn-sm btn-primary" title="Manage Content">
                          <i class="ti ti-file-text"></i> Content
                        </a>

                        <a href="process_blog.php?did=<?= $blog['id'] ?>"
                          class="btn btn-sm btn-danger"
                          onclick="return confirm('Are you sure you want to delete this blog?')">
                          <i class="ti ti-trash"></i> Delete
                        </a>
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