<?php


session_start();
include_once 'inc/config.php';

$errors = [];

function check_pw($pw)
{

    $majuscule = preg_match('@[A-Z]@', $pw);
    $minuscule = preg_match('@[a-z]@', $pw);
    $chiffre = preg_match('@[0-9]@', $pw);

    return ($majuscule && $minuscule && $chiffre);
}
// Il me semble qu'il faudrait modifier les vérification ici. Et vérifier si se qui est remplis dan le formulaire correspond juste a un utilisateur existant. car si tu te plante dans le non de l'utilisateur il n'y azucun message d'erreur qui s'affiche.(pense bête pour demain)

if (!empty($_POST)) {

    $safe = array_map('trim', array_map('strip_tags', $_POST));

    if (strlen($safe['i_login']) < 5 || strlen($safe['i_login']) > 25) {
        $errors[] = "Votre identifiant doit être compris entre 5 et 25 caractères";
    }

    if (strlen($safe['i_password']) < 5 || strlen($safe['i_password']) > 25) {
        $errors[] = "Votre mot de passe doit être compris entre 5 et 25 caractères";
    }

    if (!check_pw($safe['i_password'])) {
        $errors[] = "Le mot de passe doit contenir au minimum une majuscule, une minuscule et 1 chiffre.";
    }

    if (count($errors) === 0) {
        try {

            $sql = 'SELECT * FROM users';
            $query = $conn->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
                if (($value['login'] == $safe['i_login']) && ($value['password'] == $safe['i_password'])) {
                    $_SESSION['login'] = $value['login'];
                    $_SESSION['role'] = $value['role'];
                }
            }
        } catch (PDOException $e) {
            echo $sql . '<br>' . $e->getMessage();
        }
    } else {
        var_dump($errors);
    }
}


?>


<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Manga Mise - LOGIN</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include_once 'inc/header.php'; ?>

    <div class="my-5 title text-center heroes border rounded ">
                    <h1 class="text-white p-5 fw-bold">Se connecter</h1>
                </div>

    <main class="flex-shrink-0">
        <div class="container">
            <?php if (!isset($_SESSION['login'])) { ?>
                
                <div class="container">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="login" class="form-label">Identifiant</label>
                            <input type="text" class="form-control" id="login" name="i_login" placeholder="Mon Identifiant">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" name="i_password" id="password" placeholder="Mon Mot de Passe">
                        </div>
                        <button type="submit" class="me-3 btn btn-primary">Se connecter</button>

                    </form>
                    <button onclick="window.location.href='inscription.php';" class="mt-3 btn btn-secondary">S'inscrire</button>
                    <button onclick="window.location.href='forgot_password.php';" class="mt-3 btn btn-secondary">Mot de passe oublié</button>
                </div>

                <div class="container text-center">
                <?php
            } elseif (isset($_SESSION['login'])) {
                echo '<div class="m-5 title text-center"> <br>';
                header('Location: product-list.php');
            }
                ?>
                </div>
                
        </div>
    </main>

    <div class="px-4 py-5 my-5 text-center banner border rounded"></div>

</body>
<?php include_once 'inc/footer.php'; ?>

</html>