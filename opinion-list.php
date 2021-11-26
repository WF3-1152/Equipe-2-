<?php

require 'inc/config.php';

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    die;
}

try {
    $sql = 'SELECT * FROM opinions;';
    $query = $conn->prepare($sql);
    $query->execute();
    $opinions = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $sql . '<br>' . $e->getMessage();
}

try {
    $sql = 'SELECT * FROM manga;';
    $query = $conn->prepare($sql);
    $query->execute();
    $mangas = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $sql . '<br>' . $e->getMessage();
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
    <script src="https://kit.fontawesome.com/a714e14483.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/opinion-list.css">

    <title>Avis</title>
</head>

<body>

    <?php include_once 'inc/header.php'; ?>
    <main class="container flex-shrink-0">

        <div class="px-4 py-5 my-5 text-center border rounded heroes">
            <h1 class="text-white display-5 fw-bold">Avis</h1>
        </div>

        <div class="container d-flex flex-wrap justify-content-evenly">

            <?php foreach ($opinions as $opinion) : ?>
                <div class="card col-3" style="width: 18rem;">
                    <img src="assets/cover/<?php foreach ($mangas as $manga) : {
                                                    if ($manga['title'] == $opinion['manga']) {
                                                        echo $manga['cover'];
                                                    }
                                                }
                                            endforeach; ?>" class="card-img-top" alt="couverture du manga">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $opinion['manga']; ?></h5>
                        <p class="card-text"><?php echo $opinion['opinion']; ?></p>
                        <p class="text-secondary">Commentaire écrit par : <?php echo $opinion['user']; ?></p>
                        <span>Note attribuée : <?=$opinion['mark'];?>/5<i style="color:orange;" class="fas fa-star"></i></span>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>        

        <div class="px-4 py-5 my-5 border rounded banner"></div>

    </main>

    <?php include_once 'inc/footer.php'; ?>

</body>

</html>