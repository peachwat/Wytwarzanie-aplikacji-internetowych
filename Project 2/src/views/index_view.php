<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>JDM</title>
    <link rel="stylesheet" href="static/css/index.css"/>
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

    <section class="content">
        <a name="JDM"></a>

        <?php if (isset($message)): ?>
            <h1 style="color: rgb(224, 130, 245);"><?php echo $message; ?></h1>
        <?php endif; ?>

        <h2 class="whatis">What is JDM?</h2>

        <p>
            <b>Japanese Domestic Market</b> or JDM for short, literally means
            “Japanese domestic market.” This term applies to Japanese-made cars.
            It's no secret that almost any Japanese-made car for the European market
            is just a “simplified” version of a car on the Japanese domestic market.
            Often, overseas they even have a different name. For example, the
            well-known Mitsubishi Lancer is a Mitsubishi Cedia, just like the Nissan
            Primera is a Nissan Camino. There are many such examples. Cars for the
            domestic market are always right-hand drive and have richer equipment.
            Therefore, JDM culture implies a purebred Japanese (according to some
            versions released before 2000).
        </p>

    </section>

    <footer>Copyright © 2023 Evelina Rylova</footer>
</body>
</html>
