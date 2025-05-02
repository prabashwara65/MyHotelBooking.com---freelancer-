<?php

session_start();
// Example: Assume user logs in somewhere and $_SESSION['username'] is set

?>
<!-- 
<pre>
<?php print_r($_SESSION); ?>
</pre> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        <i class="fas fa-hotel"></i>
        <span>My Dashboard</span>
    </div>
    <ul class="nav-links">
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Analytics</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="#">Users</a></li>
    </ul>
</div>

<!-- Main Content Area -->
<div class="main-content">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="dashboard-title">Dashboard</div>
        <div class="top-right">
        <div class="auth-buttons">
                    <?php if (isset($_SESSION['name'])): ?>
                        <span class="welcome-msg">Welcome, <?= htmlspecialchars($_SESSION['name']) ?></span>
                        <a href="/myhotelbooking.com/Auth/logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    <?php else: ?>
                        <a href="/myhotelbooking.com/Auth/login.html" class="btn">Login</a>
                        <a href="/myhotelbooking.com/Auth/register.php" class="btn">Sign Up</a>
                    <?php endif; ?>
                </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="stats-overview">
        <div class="stat-card">
            <div class="stat-title">Total Sales</div>
            <div class="stat-value">$45,600</div>
            <div class="stat-change">+15%</div>
        </div>
        <div class="stat-card">
            <div class="stat-title">New Users</div>
            <div class="stat-value">1,200</div>
            <div class="stat-change">+20%</div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Orders</div>
            <div class="stat-value">300</div>
            <div class="stat-change">-5%</div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="recent-activity">
        <div class="recent-activity-title">Recent Activity</div>
        <ul class="activity-list">
            <li>Order #1243 placed (2 hours ago)</li>
            <li>New user registration (1 day ago)</li>
            <li>Order #1242 shipped (3 days ago)</li>
        </ul>
    </div>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
