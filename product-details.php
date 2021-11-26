<?php

require 'inc/config.php';

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    die;
}




if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {

    $query = $conn->prepare('SELECT * FROM manga WHERE id = :id_param');
    $query->bindValue(':id_param', $_GET['id'], PDO::PARAM_INT);
    $query->execute();

    $manga = $query->fetch();
}



if (!empty($_POST)) {


    $errors = [];

    $safe = array_map('trim', array_map('strip_tags', $_POST));

    if (strlen($safe['opinion']) < 25 || strlen($safe['opinion']) > 100) {
        $errors[] = 'Votre commentaire doit comporter au moins 25 caractères';
    }

    $sql = 'INSERT INTO manga (opinion) VALUE (param:opinion)';

    $query->bindValue(':param_opinion', $safe['opinion'], PDO::PARAM_STR);
    $query->execute();

    $formIsValid = true;
} else {
    $formIsValid = false;
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

    <link rel="stylesheet" href="css/product-details.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

</head>

<body class="d-flex flex-column h-100">
    <?php include_once 'inc/header.php'; ?>

    <?php
    if (isset($isFormValid) && $isFormValid == true) {
        echo '<div class="alert alert-success">Votre commentaire a bien été enregistré</div>';
    } elseif (isset($isFormValid) && $isFormValid == false) {
        echo '<div class="alert alert-danger">' . implode('<br>', $errors) . '</div>';
    } ?>

    <main class="flex-shrink-0">
        <h1>Détails Manga</h1>
        <div class="container">
            <div class="card mb-3" style="max-width: 740px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="assets/cover/<?= $manga['cover']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title"><?= $manga['title']; ?></h3>
                            <p class="card-text"><small class="text-muted">Auteur : <?= $manga['author']; ?></small></p>
                            <p class="card-text"><strong>Description : </strong><?= $manga['description']; ?></p>
                            <div class="d-flex">
                                <h4><span id="background" class="me-4 badge">Stock : <span id="stock"><?= $manga['stock']; ?></span></span></h4>
                                <h4><span class=" badge border text-danger"><?= $manga['price']; ?>€</span></h4>
                            </div>
                            <div class="d-flex">
                                <?php
                                if ($_SESSION['role'] == 'admin') {
                                ?>

                                    <a href="update-product.php?id=<?= $manga['id']; ?>" class="me-4 btn btn-primary" id="modifer">Modifier</a>

                                <?php } ?>

                                <a href="product-list.php" class="btn btn-warning">Retour à la liste</a>

                            </div>

                            <br>
                            <br>
                        </div>
                    </div>
                    

                    <!-- Avis utilisateur -->

                    <div class="opinion d-flex justify-content-center">
                        <form method="post">
                            <div class="opinion">
                                <textarea name="opinion" id="opinion" cols="50" rows="10" placeholder="Écrivez votre commentaire" class="border border-success rounded m-3"></textarea>
                            </div>
                            <div class="mb-3 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Validez</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/main.js"></script>

    <!-- <script>
        let usernameinJS = '<?= $username; ?>';
    </script> -->
</body>
<?php include_once 'inc/footer.php'; ?>

</html>