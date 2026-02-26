<!DOCTYPE html>
<html lang="en">
<?php include('static/shared/header.php')?>
<body style="background-color: #3d323c">
    <header class="header">
        <h1 style="color: #dba5dc">Japanese Domestics Market</h1>
    </header>
    <nav class="navbar">
        <a class="active" style="color: #ebe1eb" href="index">Main page</a>
        <a href="gallery" style="color: #ebe1eb">Gallery</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout" style="color: #ebe1eb">Log out</a>
        <?php else: ?>
            <a href="signin" style="color: #ebe1eb">Sign in</a>
            <a href="signup" style="color: #ebe1eb">Sign up</a>
        <?php endif; ?>
        
    </nav>
    <section class="content" style="display: flex; flex-direction: column; align-items: center;">
        <h2> Gallery </h2>
        <div> 
        <?php require('static/shared/imagecards.php')?>
        </div>
    </section>
</body>
</html>
