<?php
include_once 'inc/config.php';
session_start();
?>


<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manga Mise - LOGOUT</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include_once 'inc/header.php'; ?>
    <main class="flex-shrink-0">

    <?php
        var_dump($_SESSION);
    ?>
        <div class="container text-center">
            <?php if (!isset($_SESSION['login'])) {
                echo 'Vous n\'étiez pas connecté';
            } elseif (isset($_SESSION['login'])) {
                unset($_SESSION['login']);
                echo '<script>resultat = confirm("Vous êtes déconnecté");
                if (resultat) {
                    window.location.href="login.php";
                }</script>';
            }
            ?>
        </div>



    </main>

</body>
<?php include_once 'inc/footer.php';?>
</html>