<?php require_once 'inc/config.php';

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    die;
}

$errors = [];

if (!empty($_POST)) {




    $safe = array_map('trim', array_map('strip_tags', $_POST));


    if (strlen($safe['title']) < 5 || strlen($safe['title']) > 60) {
        $errors[] = 'Votre titre doit compoter entre 5 et 60 caractères';
    }

    if (strlen($safe['author']) < 5 || strlen($safe['author']) > 60) {
        $errors[] = 'Votre titre doit compoter entre 5 et 50 caractères';
    }

    if (strlen($safe['description']) < 50 || strlen($safe['description']) > 6000) {
        $errors[] = 'Votre description doit compoter entre 50 et 6000 caractères';
    }

    if (!empty($safe['publish_date'])) {
        $my_publish_date = explode('-', $safe['publish_date']);

        if (!checkdate($my_publish_date[1], $my_publish_date[2], $my_publish_date[0])) {
            $errors[] = 'Votre date de publication est invalide';
        } elseif ($safe['publish_date'] > date('Y-m-d')) { // J'empêche la publication supérieur à aujourd'hui
            $errors[] = 'Votre date de publication ne peut être passée dans le futur';
        }
    } else {
        $errors[] = 'Vous devez saisir une date de publication';
    }

    $uploaddir = 'assets/cover/';
    $uploadfile = $uploaddir . basename($_FILES['cover']['name']);
    move_uploaded_file($_FILES['cover']['tmp_name'], $uploadfile);




    if (!isset($safe['category'])) { // J'ajoute cette condition puisque la premiere <option> des catégories est "disabled" donc illisible en php
        $errors[] = 'Vous devez sélectionner une catégorie';
    } elseif (!in_array($safe['category'], array_keys($categories))) {
        $errors[] = 'Vous avez essayé de modifier la catégorie et c\'est pas très sympa et pas très gentil';
    }
    if (!is_numeric($safe['stock'])) {
        $errors[] = 'Votre stock est invalide';
    }
    if ($safe['price'] <= 0) {
        $errors[] = 'le prix doit être supérieur à zéro';
    }
    if (count($errors) === 0) {
        // ici, lorsque je n'ai pas d'erreur que je vais enregistrer mon article


        // Je traite ma checkbox "à la une " 
        if (isset($safe['promote']) && $safe['promote'] === 'on') {
            $is_promote = 0;
        } else {
            $is_promote = 1;
        }

        try {
            $sql = 'INSERT INTO manga (title, author, description, publish_date, cover, price,promote, category, stock) 
                VALUES(:param_title, :param_author, :param_description, :param_publish_date, :param_cover, :param_price, :param_promote, :param_category, :param_stock)';

            // la variable $bdd se trouve dans le fichier config.php et est ma connexion à ma de données
            // $bdd->prepare() me permet de préparer ma requete SQL
            $query = $conn->prepare($sql);

            // Les bindValues permettent d'associer les :param_* aux valeurs du formulaire
            $query->bindValue(':param_title', $safe['title'], PDO::PARAM_STR);
            $query->bindValue(':param_author', $safe['author'], PDO::PARAM_STR);
            $query->bindValue(':param_description', $safe['description'], PDO::PARAM_STR);
            $query->bindValue(':param_promote', $is_promote, PDO::PARAM_BOOL);
            $query->bindValue(':param_publish_date', $safe['publish_date']);
            $query->bindValue(':param_category', $safe['category'], PDO::PARAM_STR);
            $query->bindValue(':param_cover', $_FILES['cover']['name'], PDO::PARAM_STR);
            $query->bindValue(':param_price', $safe['price']);
            $query->bindValue(':param_stock', $safe['stock'], PDO::PARAM_INT);

            $query->execute(); // J'execute ma requete            
        } catch (PDOException $e) {
            echo $sql . '<br>' . $e->getMessage();
        }


        $isFormValid = true;
    } else {
        $isFormValid = false;
    }
}

?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add-product.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <?php require_once 'inc/header.php'; ?>
    <div class="container">
        <?php
        if (isset($isFormValid) && $isFormValid == true) {
            echo '<div class="alert alert-success">Votre article a bien été mis à jour</div>';
        } elseif (isset($isFormValid) && $isFormValid == false) {
            echo '<div class="alert alert-danger">' . implode('<br>', $errors) . '</div>';
        } ?>

    </div>

    <div class="heroes border rounded my-5">
                <h1 class="text-center text-white p-5">Ajouter un nouvel article</h1>
            </div>

    <div class="container">
        <div class="row justify-content-center">
            

            <form method="post" enctype="multipart/form-data" class="d-flex justify-content-around">
                <div class="col-4">

                    <!-- titre -->

                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>

                    <!-- auteur -->

                    <div class="mb-3">
                        <label for="author" class="form-label">Auteur</label>
                        <input type="text" class="form-control" id="author" name="author">
                    </div>

                    <!-- description -->

                    <div class="mb-3">
                        <label for="description" class="form-label">Résumé</label>
                        <textarea class="form-control" id="description" rows="10" name="description"></textarea>
                    </div>
                </div>

                <div class="col-4">

                    <!-- date publication -->

                    <div class="mb-3">
                        <label for="publish_date" class="form-label">Date de publication</label>
                        <input type="date" class="form-control" id="publish_date" name="publish_date">
                    </div>

                    <!-- cover -->

                    <div class="mb-3">
                        <label for="cover" class="form-label">Couverture</label>
                        <input type="file" class="form-control" id="cover" name="cover">
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="mb-3">
                            <label for="price" class="form-label">Prix</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                        <div class="mb-3 align-self-center">
                            <input class="form-check-input" type="checkbox" value="" id="promote" name="promote" checked>
                            <label class="form-check-label" for="promote">Coup de coeur</label>
                        </div>
                    </div>

                    <!-- categorie -->

                    <div class="mb-3">
                        <label for="category" class="form-label">Catégorie</label>
                        <select id="category" name="category" class="form-control text-center">
                            <option value="0" selected disabled>-- Choisir --</option>
                            <?php foreach ($categories as $kCat => $vCat) : ?>
                                <option value="<?= $kCat; ?>"><?= mb_strtoupper(mb_substr($vCat, 0, 1)) . mb_substr($vCat, 1); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- stock -->

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="text" class="form-control" id="stock" name="stock">
                    </div>

                    <!-- bouton valider -->

                    <div class="mb-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Validez</button>
                    </div>
                </div>
            </form>

            <!-- Bannière avant footer -->

            

        </div>
    </div>
    <div class="px-4 py-5 my-5 border rounded text-center banner"></div>

    <?php include_once 'inc/footer.php'; ?>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>