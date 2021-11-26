<?php

// Inclut le fichier à l'intérieur de l'actuel
// je peux utiliser toutes les variables présentes dans le fichier "config.php" puisque j'ai utilisé "require"
require 'inc/config.php';

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    die;
}


if (isset($_POST['delete']) && !empty($_POST['delete']) && is_numeric($_POST['delete'])) {

    $query = $conn->prepare('DELETE FROM manga WHERE id = :id_param');
    $query->bindValue(':id_param', $_POST['delete'], PDO::PARAM_INT);
    $query->execute();
}
?>


<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manga Mise : Suppresion</title>
    <link rel="stylesheet" href="css/delete-manga.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="d-flex flex-column h-100">

    <?php include 'inc/header.php'; ?>

    <div class="border rounded heroes my-5">
        <h1 class="text-center text-white p-5 fw-bold">Suppression d'un manga</h1>
    </div>

    <main class=" container flex-shrink-0">

        <div class="mt-5 container justify-content-center">
            <form method="post">

                <div class="d-flex container">
                    <select name="delete" class="form-select">
                        <option selected disabled>-- Choisir le titre -- </option>
                        <?php
                        $query = $conn->prepare('SELECT * FROM manga ORDER BY title asc');
                        $query->execute();

                        $result = $query->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($result as $manga) {
                            echo '<option value="' . $manga['id'] . '">' . $manga['title'] . '</option>';
                        }

                        ?>
                    </select>
                    <button type="submit" class="ms-5 btn btn-danger">Supprimer</button>
                </div>



            </form>
        </div>

    </main>
    <div class="px-4 py-5 my-5 border rounded text-center banner"></div>

</body>
<?php include_once 'inc/footer.php'; ?>

</html>