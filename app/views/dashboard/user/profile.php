<?php
$pageTitle = 'User Profile';

ob_start();
?>

<h2>Profile</h2>

<div class="profile-card">
<div class="profile-actions">
    <h4>Account Actions</h4>
    <ul>
        <li><a href="/edit-profile">Edit Profile</a></li>
        <li><a href="/change-password">Change Password</a></li>
    </ul>
</div>

</div>
    <div class="profile-info">
        <h3>John Doe</h3>
        <p><strong>Email:</strong> johndoe@example.com</p>
        <p><strong>Phone:</strong> (555) 123-4567</p>
        <p><strong>Membership:</strong> Premium Member</p>
        <p><strong>Joined:</strong> January 12, 2023</p>
    </div>
</div>



<style>
    .profile-card {
        display: flex;
        gap: 2rem;
        align-items: center;
        background: #f9f9f9;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }

    .profile-avatar img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 3px solid #ddd;
        object-fit: cover;
    }

    .profile-info h3 {
        margin-top: 0;
        color: #2c3e50;
    }

    .profile-actions h4 {
        margin-bottom: 0.5rem;
    }

    .profile-actions ul {
        list-style: none;
        padding: 0;
    }

    .profile-actions li {
        margin-bottom: 0.5rem;
    }

    .profile-actions a {
        color: #007bff;
        text-decoration: none;
    }

    .profile-actions a:hover {
        text-decoration: underline;
    }

    .logout-link {
        color: #c0392b;
    }
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/userLayout.php';  // Adjust path if needed
?>
