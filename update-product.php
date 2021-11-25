<?php
// Inclut le fichier à l'intérieur de l'actuel
// je peux utiliser toutes les variables présentes dans le fichier "config.php" puisque j'ai utilisé "require"
require 'inc/config.php';

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    die;
}

$errors = [];

// Si mon formulaire est envoyé, je passe dans la condition ci-dessous
if (!empty($_POST)) {

    $safe = array_map('trim', array_map('strip_tags', $_POST)); // On nettoie pour sécuriser

    if (strlen($safe['title']) < 5 || strlen($safe['title']) > 60) {
        $errors[] = 'Votre titre doit compoter entre 5 et 60 caractères';
    }

    $uploaddir = 'assets/cover/';
    $uploadfile = $uploaddir . basename($_FILES['cover']['name']);
    move_uploaded_file($_FILES['cover']['tmp_name'], $uploadfile);


    if (strlen($safe['author']) < 2 || strlen($safe['author']) > 60) {
        $errors[] = 'Votre nom doit compoter entre 2 et 60 caractères';
    }


    // Je m'assure que la date ne soit pas vide pour effectuer des vérifications
    if (!empty($safe['publish_date'])) {
        $my_publish_date = explode('-', $safe['publish_date']);

        if (!checkdate($my_publish_date[1], $my_publish_date[2], $my_publish_date[0])) {
            $errors[] = 'Votre date de publication est invalide';
        }
    } else {
        $errors[] = 'Vous devez saisir une date de publication';
    }


    if (!isset($safe['category'])) { // J'ajoute cette condition puisque la premiere <option> des catégories est "disabled" donc illisible en php
        $errors[] = 'Vous devez sélectionner une catégorie';
    } elseif (!in_array($safe['category'], array_keys($categories))) {
        $errors[] = 'Vous avez essayé de modifier la catégorie et c\'est pas très sympa et pas très gentil';
    }


    if (strlen($safe['description']) < 50 || strlen($safe['title']) > 6000) {
        $errors[] = 'Votre contenu doit compoter entre 50 et 60000 caractères';
    }


    if (count($errors) == 0) {
        // ici, lorsque je n'ai pas d'erreur que je vais enregistrer mon manga


        // Je traite ma checkbox "à la une " 
        if (isset($safe['promote']) && $safe['promote'] === 'on') {
            $is_promote = 0;
        } else {
            $is_promote = 1;
        }


        $sql = 'UPDATE manga SET title = :param_title, category = :param_category, description = :param_description, promote = :param_promote, publish_date = :publish_date, cover = :param_cover, author = :param_author
        WHERE id = :id_param';

        // la variable $bdd se trouve dans le fichier config.php et est ma connexion à ma de données
        // $bdd->prepare() me permet de préparer ma requete SQL
        $query = $conn->prepare($sql);

        $query->bindValue(':param_title', $safe['title']);
        $query->bindValue(':param_category', $safe['category']);
        $query->bindValue(':param_description', $safe['description']);
        $query->bindValue(':param_promote', $is_promote);
        $query->bindValue(':publish_date', $safe['publish_date']);
        $query->bindValue(':id_param', $_GET['id'], PDO::PARAM_INT);
        $query->bindValue(':param_cover', $_FILES['cover']['name'], PDO::PARAM_STR);
        $query->bindValue(':param_author', $safe['author']);
        $query->execute(); // J'execute ma requete


        $formIsValid = true;
    } else {
        $formIsValid = false;
    }
}


if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {

    $query = $conn->prepare('SELECT * FROM manga WHERE id = :id_param');
    $query->bindValue(':id_param', $_GET['id'], PDO::PARAM_INT);
    $query->execute();

    $manga = $query->fetch(PDO::FETCH_ASSOC); // Je récupère une ligne de données
}
?>

<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manga Mise - Edition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="d-flex flex-column h-100">
    <?php include 'inc/header.php'; ?>

    <main class="flex-shrink-0">
        <div class="container">

            <div class="row justify-content-center">
                <?php if (!isset($manga) || empty($manga)) : ?>
                    <div class="col-6">
                        <div class="alert alert-danger mt-5">Manga introuvable ou aucun identifiant renseigné</div>
                    </div>
                <?php else : ?>
                    <div class="col-6">
                        <h1 class="text-center my-5">Editer ce manga</h1>


                        <?php

                        if (isset($formIsValid) && $formIsValid == true) {
                            echo '<div class="alert alert-success">Votre manga a bien été mis à jour</div>';
                        } elseif (isset($formIsValid) && $formIsValid == false) {
                            echo '<div class="alert alert-danger">' . implode('<br>', $errors) . '</div>';
                        }
                        ?>


                        <form method="post" enctype=”multipart/form-data”>

                            <!-- titre -->

                            <div class="mb-3">
                                <label for="title" class="form-label">Titre</label>
                                <input type="text" id="title" name="title" class="form-control" value="<?= $manga['title']; ?>">
                            </div>

                            <!-- cover -->

                            
                            <div class="mb-3">
                                <label for="cover" class="form-label">Couverture</label>
                                <input type="file" id="cover" name="cover" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="author" class="form-label">Nom de l'auteur</label>
                                <input type="text" id="author" name="author" class="form-control" value="<?= $manga['author']; ?>">
                            </div>

                            <!-- date de publication -->

                            <div class="mb-3">
                                <label for="publish_date" class="form-label">Date de publication</label>
                                <input type="date" id="publish_date" name="publish_date" class="form-control" value="<?= $manga['publish_date']; ?>">
                            </div>

                            <!-- categorie -->

                            <div class="mb-3">
                                <label for="category" class="form-label">Catégorie</label>
                                <select id="category" name="category" class="form-control">
                                    <option value="0" selected disabled>-- Choisir --</option>
                                    <?php foreach ($categories as $kCat => $vCat) : ?>
                                        <option value="<?= $kCat; ?>" <?= ($manga['category'] == $kCat) ? 'selected' : ''; ?>><?= mb_strtoupper(mb_substr($vCat, 0, 1)) . mb_substr($vCat, 1); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- contenu -->

                            <div class="mb-3">
                                <label for="description" class="form-label">Contenu</label>
                                <textarea id="description" name="description" class="form-control" rows="10"><?= $manga['description']; ?></textarea>
                            </div>

                            <!-- checkbox à la une -->

                            <div class="mb-3 form-check">
                                <input type="checkbox" name="promote" class="form-check-input" id="promote" <?= ($manga['promote'] == 1) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="promote">Manga &laquo; à la une &raquo;</label>
                            </div>


                            <button type="submit" class="mb-4 btn btn-primary">Mettre à jour</button>                            
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

<?php include_once 'inc/footer.php';?>

</html>