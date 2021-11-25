<?php

include 'inc/config.php';
session_start();

$errors = [];

function check_pw($pw)
{
    $majuscule = preg_match('@[A-Z]@', $pw);
    $minuscule = preg_match('@[a-z]@', $pw);
    $chiffre = preg_match('@[0-9]@', $pw);

    return ($majuscule && $minuscule && $chiffre);
}

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

    if (!filter_var($safe['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Adresse e-mail invalide";
    }

    if (count($errors) === 0) {      
            
            try {
                $sql = 'SELECT COUNT(id) FROM users WHERE users.login = :param_login OR users.email = :param_email;';
                $query = $conn->prepare($sql);
                $query->bindValue(':param_login', $safe['i_login'], PDO::PARAM_STR);
                $query->bindValue(':param_email', $safe['i_email'], PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetch(PDO::FETCH_ASSOC);                
                
                // si doublon :
                if ($results["COUNT(id)"] === '0'){
                    try {
                        $sql = 'INSERT INTO users (login, password, email) VALUES (:param_login, :param_password, :param_email);';
                        $query = $conn->prepare($sql);
                        $query->bindValue(':param_login', $safe['i_login'], PDO::PARAM_STR);
                        $query->bindValue(':param_password', $safe['i_password'], PDO::PARAM_STR);
                        $query->bindValue(':param_email', $safe['i_email'], PDO::PARAM_STR);
                        $query->execute();
                        echo '<br>Votre compte a bien été créé';
                    } catch (PDOException $e) {
                        echo $sql . '<br>' . $e->getMessage();
                    }

                }  //si pas doublon :
                else  {
                    echo '<script>res=confirm("Identifiants ou Mot de passe déjà utilisé"); if(res){window.location.href="inscription.php"} else{window.location.href="login.php"};</script>';
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
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title>Manga Mise - INSCRIPTION</title>
</head>

<body  class="d-flex flex-column h-100">
    <?php include_once 'inc/header.php'; ?>

    <div class="m-5 title text-center">
        <h1>S'inscrire</h1>
    </div>

    <main class="flex-shrink-0">

        <div class="container">
            <form method="POST">

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control border" onchange="validation()" name="i_email" id="email" placeholder="myEmail@email.com">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="login">Identifiant</label>
                    <input type="text" class="form-control" id="login" name="i_login" placeholder="My Login">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="i_password" id="password" placeholder="My Password">
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirmer mot de passe</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="My Password">
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">S'inscrire</button>
                </div>

            </form>

        </div>

    </main>


    <script src="js/main.js"></script>
</body>
<?php include_once 'inc/footer.php';?>

</html>