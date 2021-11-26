<?php
include_once 'inc/config.php';

session_start();
?>

<?php


$errors = [];

if (!empty($_POST)) {

    $safe = array_map('trim', array_map('strip_tags', $_POST));
    if (!filter_var($safe['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Adresse e-mail invalide";
    }

    if (count($errors) === 0) {
        try {            
            $sql = 'SELECT password FROM users WHERE email = :param_email;';
            $query = $conn->prepare($sql);            
            $query->bindValue(':param_email', $safe['email'], PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetch(PDO::FETCH_ASSOC);            
        } catch (PDOException $e) {
            echo $sql.'<br>'.$e->getMessage();
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
    <title>Manga Mise - Mot de passe oublié</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include_once 'inc/header.php'; ?>

    <div class="px-4 py-5 my-5 text-center border rounded heroes">
                <h1 class="text-white display-5 fw-bold">Mot de passe oublié</h1>
            </div>

    <main class="flex-shrink-0">
        <div class="mt-5 container text-center">
            
        </div>


        
        <div class="container">
            <form method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Votre e-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="votre.email@gmail.com">
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-danger">Réinitialiser le mot de passe</button>
                </div>
            </form>
        </div>   
        <?php if(isset($_POST['email']) && $_POST['email'] != "") {?>
        <div class="container d-flex jsutify-content-center">
            <?='<span class="text-center">Votre mot de passe est : '.$results['password'].'</span>';?>
        </div>
        <?php } ?>
    </main>
    <div class="px-4 py-5 my-5 border rounded banner"></div>
</body>
<?php include_once 'inc/footer.php'; ?>

</html>