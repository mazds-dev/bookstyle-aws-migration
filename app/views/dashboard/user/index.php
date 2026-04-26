<!-- /views/dashboard/user/index.php -->
<div class="dashboard-header">
    <h1>Hey <?= htmlspecialchars($user['username']) ?> 👋</h1>
    <p class="subtext">Welcome back! Here's a quick look at your activity.</p>
</div>

<div class="dashboard-widgets">
    <div class="widget">
        <h2>Next Appointment</h2>
        <p>Monday, 10:30 AM</p> <!-- Pull from DB if dynamic -->
    </div>
    <div class="widget">
        <h2>Barber</h2>
        <p>Jay Styles ✂️</p>
    </div>
    <div class="widget">
        <h2>Loyalty Points</h2>
        <p>120 pts</p>
    </div>
</div>
