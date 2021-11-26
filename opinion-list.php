<?php

require 'inc/config.php';

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    die;
}


?>
<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/opinion-list.css">

    <title>Avis</title>
</head>

<body>

    <?php include_once 'inc/header.php'; ?>
    <main class="flex-shrink-0">

        <div class="px-4 py-5 my-5 text-center border rounded heroes">
            <h1 class="text-white display-5 fw-bold">Avis</h1>
        </div>

        <div class="container d-flex">

            <?php foreach ($mes_mangas as $manga) : ?>
                <div class="card col-3" style="width: 18rem;">
                    <img src="assets/cover/<?= $manga['cover']; ?>" class="card-img-top" alt="couverture du manga">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $manga['title']; ?></h5>
                        <p class="card-text"><?php echo $manga['opinion']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>

        <div class="px-4 py-5 my-5 border rounded banner"></div>

    </main>

    <?php include_once 'inc/footer.php'; ?>

</body>

</html>