<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-sm bg-dark">

    <div class="justify-content-center container-fluid text-white">
        <!-- Links -->
        <ul class="w-100 navbar-nav justify-content-center position-relative">
            <li class="nav-item">
                <a class="nav-link myNav_items" href="product-list.php">Nos mangas à la vente</a>
            </li>
            <?php
            if ($_SESSION['role'] == 'admin') {
            ?>
                <li class="ms-5 nav-item">
                    <a class="nav-link myNav_items" href="add-product.php">Ajouter un produit</a>
                </li>
                <li class="ms-5 nav-item">
                    <a class="nav-link myNav_items" href="delete-product.php">Supprimer un produit</a>
                </li>
            <?php } ?>

            <?php if (!isset($_SESSION['login'])) { ?>
                <div class="me-3 position-absolute end-0">
                    <li class=" nav-item">
                        <a class="nav-link myNav_items" href="login.php">Se connecter</a>
                    </li>
                </div>
            <?php }
            if (isset($_SESSION['login'])) { ?>
                <div class="me-3 position-absolute end-0">
                    <li class=" nav-item">
                        <a class="nav-link myNav_items" href="logout.php">Se déconnecter</a>
                    </li>
                </div>
            <?php } ?>

        </ul>
    </div>

</nav>

<style>
    a.myNav_items {
        text-decoration: none;
        color: white;
    }

    a.myNav_items:hover {
        color: grey;
    }
</style>