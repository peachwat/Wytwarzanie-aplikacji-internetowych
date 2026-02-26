<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Sign in</title>
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
      <h2>Please sign in</h2>
        <form method="POST" class="survey-form" enctype="multipart/form-data">
        <div class="form-group">
          <label for="login">Login:</label>
          <input type="text" id="login" name="login" placeholder="login" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="password" required>
        </div>
        <div class="button-group">
          <button type="submit" value="login" name="signin" required>Sign in</button></br>
        </div></br>
        <?php if($model['loginError']): ?>
        <p class="error-message">Login or password is incorrect</p>
        <?php endif; ?>
        </form>
    </section>
  </div>
</body>
</html>
