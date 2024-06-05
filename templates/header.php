
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpeakeasySounds</title>
    <link rel="stylesheet" href="/MarcusMallia-PHPsynoptic/assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="/MarcusMallia-PHPsynoptic/assets/follow.js" defer></script>
    <script src="/MarcusMallia-PHPsynoptic/assets/validation.js" defer></script>
</head>
<body>
    <!-- Header section -->
    <header>
        <div class="logo">
            <h1>SpeakeasySounds</h1>
        </div>
        <!-- Navigation menu -->
        <nav>
            <ul>
                <li><a href="/MarcusMallia-PHPsynoptic/scripts/index.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="/MarcusMallia-PHPsynoptic/scripts/feed.php"><i class="fas fa-rss"></i> Feed</a></li>
                <li><a href="/MarcusMallia-PHPsynoptic/scripts/explore.php"><i class="fas fa-search"></i> Explore</a></li>
                <li><a href="/MarcusMallia-PHPsynoptic/scripts/create_post.php"><i class="fas fa-plus"></i> Create Post</a></li>
                <li><a href="/MarcusMallia-PHPsynoptic/scripts/notifications.php"><i class="fas fa-bell"></i> Notifications</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/MarcusMallia-PHPsynoptic/scripts/profile.php"><i class="fas fa-user"></i> Profile</a></li>
                    <li><a href="/MarcusMallia-PHPsynoptic/scripts/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                <?php else: ?>
                    <li><a href="/MarcusMallia-PHPsynoptic/scripts/login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                    <li><a href="/MarcusMallia-PHPsynoptic/scripts/signup.php"><i class="fas fa-user-plus"></i> Signup</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
