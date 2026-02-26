<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>JDM</title>
    <link rel="stylesheet" href="static/css/contact.css" />
</head>
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
<body>
<div class="container">
    <section class="content">
       <h2> Upload photo</h2>
    <form method="post" class="survey-form" enctype="multipart/form-data">
    <div class="form-group">
        <label for="fileToUpload">Select file to upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload" required/>
    </div>
    <div class="form-group">
        <label for="watermark-input">Watermark</label>
        <input type="text" name="watermark" id="watermark-input" required/>
    </div>
    <div class="form-group">
    <?php if (isset($_SESSION['user_id'])): ?>
        <label for="author-input">Author</label>
        <input type="text" name="author" id="author-input" value="<?php echo isset($picture['author']) ? htmlspecialchars($picture['author']) : ''; ?>" required readonly/>
        <?php else: ?>
        <label for="author-input">Author</label>
        <input type="text" name="author" id="author-input" required/>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="title-input">Title</label>
        <input type="text" name="title" id="title-input" required/>
    </div>
    <div class="ururu">
    <?php if (isset($_SESSION['user_id'])): ?>
        <input type="radio" name="public" value="public" id="public">
        <label for="public">Public</label>
        <input type="radio" name="private" value="private" id="private">
        <label for="private">Private</label>
    <?php endif; ?>
    </div>
    <div class="button-group">
            <button href="index">Cancel</button>
            <button type="submit" value="Upload File" name="submit" required>Submit</button></br>
    </div></br>
    <div>
        <a href="gallery2" style="color: #553755; font-size: 20px;">Open Gallery</a>
    </div></br>
    <?php if($correctsize===false && $correctformat===false): ?>
        <p class="error-message">Sorry, choose file with correct format and size</p>
    <?php endif; ?>
    <?php if ($correctformat===false): ?>
        <p class="error-message">Sorry,format of your photo is incorrect,please shoose jpg or png file.</p>
    <?php endif; ?>
    <?php if($correctsize===false): ?>
        <p class="error-message">Sorry,the file is too big</p>
    <?php endif; ?>
    </form>
    </section>
</div>
</body>
</html>