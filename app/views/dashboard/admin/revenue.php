<?php
// Set the page title
$pageTitle = 'Manage Products';

// If editing a product, fetch its details
$productToEdit = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $id = (int) $_POST['edit_id'];
    // This assumes $productModel is available and set before this file is included
    $productToEdit = $productModel->getProductById($id);
}

// Start capturing page content
ob_start();
?>

<div class="dashboard-header">
    <h1>💰 Revenue</h1>
    <p class="subtext">Track your earnings and financial performance.</p>
</div>

<div class="dashboard-widgets">
    <div class="widget">
        <h2>Today</h2>
        <p>€150</p>
    </div>
    <div class="widget">
        <h2>This Week</h2>
        <p>€1,030</p>
    </div>
    <div class="widget">
        <h2>This Month</h2>
        <p>€4,870</p>
    </div>
</div>

<hr class="section-divider">

<h2 class="section-title">📊 Recent Transactions</h2>

<div class="table-container">
    <table class="styled-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Client</th>
                <th>Service</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Apr 25</td>
                <td>Lucas M.</td>
                <td>Fade Cut</td>
                <td>€30</td>
            </tr>
            <tr class="alternate-row">
                <td>Apr 24</td>
                <td>Sarah J.</td>
                <td>Beard Trim</td>
                <td>€20</td>
            </tr>
            <tr>
                <td>Apr 24</td>
                <td>Tom H.</td>
                <td>Haircut + Shampoo</td>
                <td>€45</td>
            </tr>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/adminLayout.php';
?>
