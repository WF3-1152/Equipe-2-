<?php

require 'inc/config.php';

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    die;
}

try {
    $query = $conn->prepare('SELECT * FROM manga');
    $query->execute();
    $mangas = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $sql . '<br>' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manga Mise - Mon Panier</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/product-list.css">

</head>

<body class="d-flex flex-column h-100">
    <?php include_once 'inc/header.php'; ?>

    <main class="flex-shrink-0">
        <div class="heroes">
            <h1 class="text-center text-white p-5">Mon panier</h1>
        </div>

        <div class="mt-3 container">
            <?php

            $panier = $_SESSION['cart'];
            $total_price = 0;
            echo '<br>';
            foreach ($panier as $product_name => $product_quantity) {
                $product_price = 0;
                foreach ($mangas as $manga) {
                    if ($manga['title'] == $product_name) {
                        $product_price = $manga['price'];
                    }
                }
                echo '<div class="mt-2 text-center">' . $product_name . ' | Quantité : ' . $product_quantity . ' | Prix unitaire : <strong>' . $product_price . '€ </strong>' . '       Total : <strong>' . $product_quantity * $product_price . '€</strong> </div>';
                echo '<br>';
                echo '<hr>';
                echo '<br>';
                $total_price += $product_price * $product_quantity;
            }
            echo '<div class="mt-2 text-center">Prix total :<strong> ' . $total_price . '€</strong> </div>';
            ?>
            <div class="mt-4 d-flex justify-content-center">
                <button class="me-2 btn btn-success" onclick="<?php try {
                                                                    $sql = 'INSERT INTO `cart`(`total_price`, `user`) VALUES (:param_total_price, :param_user)';
                                                                    $query = $conn->prepare($sql);
                                                                    $query->bindValue(':param_total_price', $total_price, PDO::PARAM_INT);
                                                                    $query->bindValue(':param_user', $_SESSION['login'], PDO::PARAM_STR);
                                                                    $query->execute();
                                                                    $isFormValid = true;
                                                                } catch (PDOException $e) {
                                                                    $isFormValid = false;
                                                                }
                                                                
                                                                    foreach ($panier as $product_name => $product_quantity) {
                                                                        try {
                                                                        $sql = 'UPDATE manga SET stock = stock-:param_quantity WHERE title = :param_name';
                                                                        $query = $conn->prepare($sql);
                                                                        $query->bindValue(':param_name', $product_name, PDO::PARAM_STR);
                                                                        $query->bindValue(':param_quantity', $product_quantity, PDO::PARAM_INT);
                                                                        $query->execute();
                                                                        } catch (PDOException $e) {
                                                                            $isFormValid = false;
                                                                        }
                                                                    }                                                            
                                                                
                                                                ?>;alert('Votre panier a bien été enregistré !');">Valider le panier</button>

                <button onclick="<?php $_SESSION['cart'] = array(); ?>;window.location.href='product-list.php';" class="ms-2 btn btn-danger">Vider le panier</button>
            </div>
    </main>

</body>
<?php include_once 'inc/footer.php'; ?>

</html>