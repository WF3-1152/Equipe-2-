<?php
include_once 'inc/config.php';
?>


<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manga Mise - Mot de passe oublié</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include_once 'inc/header.php'; ?>
    <main class="flex-shrink-0">
        <div class="mt-5 container text-center">
            <h1>Mot de passe oublié</h1>
        </div>

        <div class="container">
            <form method="GET">
                <div class="mb-3">
                    <label for="email" class="form-label">Votre e-mail</label>
                    <input type="email" class="form-control" id="email" placeholder="votre.email@gmail.com">
                </div>

                <div class="d-flex justify-content-center">
                    <button onclick="alert('Lien de réinitialisation envoyé par mail');" type="submit" class="btn btn-danger">Réinitialiser le mot de passe</button>
                </div>
            </form>
        </div>


    </main>

</body>
<?php include_once 'inc/footer.php';?>

</html>