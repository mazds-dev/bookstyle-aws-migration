<?php
// Session start
startSessionIfNotStarted();

// Cart quantity logic
$totalItems = calculateCartTotalItems();

$pageTitle = $pageTitle ?? 'Admin Dashboard';
$extraCss = '<link rel="stylesheet" href="/assets/css/dashboard.css?ver=<?= time(); ?>">';
$extraCss .= '<link rel="stylesheet" href="/assets/css/admin.css?ver=<?= time(); ?>">';
$extraJs = '<script src="/assets/js/user-dashboard.js" defer></script>';

// Capture dashboard layout with sidebar
ob_start();
?>
<div class="dashboard-layout">
    <?php include __DIR__ . '/../partials/sidebars/adminSidebar.php'; ?>
    <main class="dashboard-content">
        <?= $content ?? '' ?>
    </main>
</div>
<?php
$content = ob_get_clean();

// Now reuse the main layout
include __DIR__ . '/mainLayout.php';
