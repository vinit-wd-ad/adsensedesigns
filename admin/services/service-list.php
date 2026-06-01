<?php
require "../../setting.php";

$obj = new Database('services');
$services = $obj->fetchAll();

function getParentName($parentId)
{
  if (empty($parentId) || $parentId == 0) {
    return '<span class="text-muted small">None (Main Parent)</span>';
  }
  global $obj;
  $parent = $obj->find($parentId);
  return $parent ? htmlspecialchars($parent['name']) : '<span class="text-muted small">None</span>';
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
        <?php if (isset($_GET['success'])): ?>
          <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="ti ti-circle-check fs-5 me-2"></i> <?= htmlspecialchars($_GET['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5 class="card-title fw-semibold mb-0">Services List</h5>
              <a href="<?= BASE_URL ?>admin/services/service-new.php" class="btn btn-primary">Add Service</a>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                  <tr>
                    <th style="width: 60px;">#</th>
                    <th style="width: 100px;">Media</th>
                    <th class="text-start">Service Name</th>
                    <th>Parent Service</th>
                    <th style="width: 80px;">Priority</th>
                    <th style="width: 110px;">Status</th>
                    <th style="width: 260px;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($services)): ?>
                    <?php foreach ($services as $svc) { ?>
                      <tr>
                        <td><?= $svc['id'] ?></td>
                        <td>
                          <?php if (!empty($svc['image']) && file_exists(BASE_PATH . "uploads/services/" . $svc['image'])): ?>
                            <img src="<?= BASE_URL ?>uploads/services/<?= $svc['image'] ?>" class="rounded border" style="width: 50px; height: 40px; object-fit: cover;">
                          <?php elseif (!empty($svc['icon'])): ?>
                            <span class="badge bg-light text-primary border py-2 px-3"><i class="<?= htmlspecialchars($svc['icon']) ?>"></i></span>
                          <?php else: ?>
                            <span class="text-muted small">No Media</span>
                          <?php endif; ?>
                        </td>
                        <td class="text-start">
                          <div class="fw-bold text-dark"><?= htmlspecialchars($svc['name']) ?></div>
                          <small class="text-muted">/<?= htmlspecialchars($svc['slug']) ?></small>
                        </td>
                        <td><?= getParentName($svc['parent_id']) ?></td>
                        <td><span class="badge bg-secondary font-monospace"><?= intval($svc['priority']) ?></span></td>
                        <td><span class="badge <?= $svc['status'] == 'active' ? 'bg-success' : 'bg-warning' ?>"><?= ucfirst($svc['status']) ?></span></td>
                        <td>
                          <a href="<?= BASE_URL ?>admin/services/service-seo.php?service_id=<?= $svc['id'] ?>"
                            class="btn btn-sm btn-secondary text-white">
                            <i class="ti ti-search"></i> SEO
                          </a>
                          <a href="<?= BASE_URL ?>admin/services/section-list.php?service_id=<?= $svc['id'] ?>"
                            class="btn btn-sm btn-warning" title="Manage Sections">
                            <i class="ti ti-layout-grid"></i> Sections
                          </a>

                          <a href="<?= BASE_URL ?>admin/services/service-new.php?eid=<?= $svc['id'] ?>"
                            class="btn btn-sm btn-info">
                            <i class="ti ti-edit"></i> Edit
                          </a>

                          <a href="<?= BASE_URL ?>admin/classes/process_service.php?action=delete&id=<?= $svc['id'] ?>"
                            class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                            <i class="ti ti-trash"></i> Delete
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="7" class="text-center p-4 text-muted bg-light">No service records found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include BASE_PATH . "admin/includes/script.php" ?>
</body>

</html>