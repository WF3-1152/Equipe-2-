<?php

require 'inc/config.php';

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    die;
}


$query = $conn->prepare('SELECT * FROM manga');
$query->execute();

$mes_mangas = $query->fetchAll(PDO::FETCH_ASSOC);

// Importation des mangas aléatoirement
$query2 = $conn->prepare('SELECT * FROM manga WHERE promote = 1 ORDER BY RAND() LIMIT 4;');
$query2->execute();

$mes_mangas2 = $query2->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET['trilist'])) {
    if (isset($_GET['trilist']) && $_GET['trilist'] == 'prix') {
        $query = $conn->prepare('SELECT * FROM manga ORDER BY price DESC');
        $query->execute();
    }

    if (isset($_GET['trilist']) && $_GET['trilist'] == 'date') {
        $query = $conn->prepare('SELECT * FROM manga ORDER BY publish_date DESC');
        $query->execute();
    }

    if (isset($_GET['trilist']) && $_GET['trilist'] == 'stock') {
        $query = $conn->prepare('SELECT * FROM manga ORDER BY stock DESC');
        $query->execute();
    }

    $mes_mangas = $query->fetchAll(PDO::FETCH_ASSOC);
}

?>


<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manga-Shôp</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/product-list.css">

</head>

<body class="d-flex flex-column h-100">
    <?php include_once 'inc/header.php'; ?>

    <div class="px-4 py-5 my-5 text-center border rounded heroes">
        <h1 class="text-white display-5 fw-bold">Mangas Disponibles</h1>
    </div>

    <main class="flex-shrink-0 container">
        <div>

            <!--Afficher 4 mangas aléatoirement-->
            <div class="card-group mt-5 mb-5 ml-2 mr-2">
                <?php foreach ($mes_mangas2 as $manga2) : ?>
                    <div class="card" style="margin: 0px 5px;">
                        <img onclick="window.location.href='product-details.php?id=<?= $manga2['id']; ?>'" style="cursor: pointer; width:100%; padding:0 5px; height:500px;" src="assets/cover/<?= $manga2['cover']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $manga2['title']; ?></h5>
                            <p class="card-text"><small class="text-muted"><?= $manga2['publish_date']; ?></small></p>
                            <p class="card-text"><small class="text-muted"><?= $manga2['author']; ?></small></p>
                            <a class="text-white btn btn-info" target="blank" href="product-details.php?id=<?= $manga2['id']; ?>">Voir plus</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!--Liste mangas-->

            <div style="width : 150px !important; margin-right : 0px;" class="mb-4 container">
                <form method="get">
                    <select name="trilist" id="trilist">
                        <option value="0" selected disabled>--Trier--</option>
                        <option name="prix" value="prix">Par prix</option>
                        <option name="stock" value="stock">Par stock</option>
                        <option name="date" value="date">Par date</option>
                    </select>
                    <input type="submit">
                </form>
            </div>
            <?php foreach ($mes_mangas as $manga) : ?>
                <div class="grid row d-flex justify-content-between align-items-center pt-3 pb-3 border-bottom border-dark">
                    <div class="col-2">
                        <img style="width: 80px;" src="assets/cover/<?= $manga['cover']; ?>" alt="">
                    </div>
                    <div class="col-3">
                        <h5><?php echo $manga['title']; ?></h5>
                        <h6>Auteur : <?= $manga['author']; ?></h6>
                        <p><strong>Catégorie : </strong><?= $categories[$manga['category']]; ?></p>
                    </div>
                    <div class="col-3">
                        <p><strong>Date de sortie : </strong><?php echo date('d/m/Y', strtotime($manga['publish_date'])); ?></p>
                    </div>
                    <div class="col-2">
                        <p><strong>Stock : </strong><?= $manga['stock']; ?></p>
                        <p><strong>Prix : </strong><?= $manga['price']; ?>€</p>
                    </div>
                    <div class="col-2">
                        <a class="text-white btn btn-info" target="blank" href="product-details.php?id=<?= $manga['id']; ?>">Voir plus</a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </main>
    <div class="px-4 py-5 my-5 border rounded banner"></div>
</body>
<?php include_once 'inc/footer.php'; ?>

</html>