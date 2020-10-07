<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter</title>
    <?php
    require 'functions.php';

    ?>
</head>

<body>
    <h2>Newsletter</h2>
    <p>Abonnez-vous à notre newsletter</p>
    <form action="newsletter.php" method="post">
        <input type="email" name="email" id="email" placeholder="votrenom@network.com">
        <input type="submit" value="S'abonner">
    </form>
    <?php newsletter($_POST['email']); ?>
</body>

</html>