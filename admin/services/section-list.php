<?php
require "../../setting.php";

$obj = new Database('service_section');
$svcObj = new Database('services');

// Check if filtering by specific service
$service_id = isset($_GET['service_id']) ? intval($_GET['service_id']) : null;
$filteredService = null;

if ($service_id) {
  // Custom select/filter according to your DB structure (or custom where method)
  $sections = $obj->where(['service_id' => $service_id]);
  $filteredService = $svcObj->find($service_id);
} else {
  // Fallback: Show all sections if no service is passed
  $sections = $obj->fetchAll();
}

function getServiceName($serviceId)
{
  if (empty($serviceId)) return '<span class="text-danger">Unassigned</span>';
  global $svcObj;
  $service = $svcObj->find($serviceId);
  return $service ? htmlspecialchars($service['name']) : '<span class="text-danger">Deleted</span>';
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
              <h5 class="card-title fw-semibold mb-0">
                <?= $filteredService ? "Sections for: " . htmlspecialchars($filteredService['name']) : "All Service Sections" ?>
              </h5>

              <div>
                <a href="<?= BASE_URL ?>admin/services/service-list.php" class="btn btn-outline-secondary me-2">
                  Back to Services
                </a>
                <a href="<?= BASE_URL ?>admin/services/section-new.php<?= $service_id ? '?service_id=' . $service_id : '' ?>" class="btn btn-primary">
                  Add Section
                </a>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                  <tr>
                    <th style="width: 60px;">#</th>
                    <th style="width: 100px;">Image</th>
                    <th class="text-start">Section Title</th>
                    <th>Assigned Service</th>
                    <th style="width: 80px;">Priority</th>
                    <th style="width: 110px;">Status</th>
                    <th style="width: 180px;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($sections)): ?>
                    <?php foreach ($sections as $sec) { ?>
                      <tr>
                        <td><?= $sec['id'] ?></td>
                        <td>
                          <?php if (!empty($sec['image']) && file_exists(BASE_PATH . "uploads/sections/" . $sec['image'])): ?>
                            <img src="<?= BASE_URL ?>uploads/sections/<?= $sec['image'] ?>" class="rounded border" style="width: 50px; height: 40px; object-fit: cover;">
                          <?php else: ?>
                            <span class="text-muted small">No Image</span>
                          <?php endif; ?>
                        </td>
                        <td class="text-start">
                          <div class="fw-bold text-dark"><?= htmlspecialchars($sec['title']) ?></div>
                        </td>
                        <td class="fw-semibold text-primary"><?= getServiceName($sec['service_id']) ?></td>
                        <td><span class="badge bg-secondary font-monospace"><?= intval($sec['priority']) ?></span></td>
                        <td><span class="badge <?= $sec['status'] == 'active' ? 'bg-success' : 'bg-warning' ?>"><?= ucfirst($sec['status']) ?></span></td>
                        <td class="d-flex gap-2 flex-grow flex-w">
                          <a href="<?= BASE_URL ?>admin/services/content-list.php?section_id=<?= $sec['id'] ?>"
                            class="btn btn-sm btn-warning text-white">
                            <i class="ti ti-components"></i> Content
                          </a>
                          <a href="<?= BASE_URL ?>admin/services/section-new.php?eid=<?= $sec['id'] ?><?= $service_id ? '&service_id=' . $service_id : '' ?>"
                            class="btn btn-sm btn-info">
                            <i class="ti ti-edit"></i> Edit
                          </a>
                          <a href="<?= BASE_URL ?>admin/classes/process_section.php?action=delete&id=<?= $sec['id'] ?>"
                            class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                            <i class="ti ti-trash"></i> Delete
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="7" class="text-center p-4 text-muted bg-light">
                        No sections added for this service yet.
                      </td>
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