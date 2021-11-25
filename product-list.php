<?php

require 'inc/config.php';

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    die;
}


$query = $conn->prepare('SELECT * FROM manga ORDER BY publish_date DESC');
$query->execute(); 

$mes_mangas = $query->fetchAll(PDO::FETCH_ASSOC); 


?>


<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manga-Shôp</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/product-list.css">

</head>
<body  class="d-flex flex-column h-100">
<?php include_once 'inc/header.php'; ?>

    <main class="flex-shrink-0">
		<div class="container">
        <div class="px-4 py-5 my-5 text-center heroes">
            <h1 class="text-white display-5 fw-bold">Mangas Disponibles</h1>
        </div>

			<?php foreach($mes_mangas as $manga):?>
				<div class="grid row d-flex justify-content-between align-items-center pt-3 pb-3 border-bottom border-dark">
                    <div class="col-2">
                        <img style="width: 80px;" src="assets/cover/<?=$manga['cover'];?>" alt="">
                    </div>
					<div class="col-3">
						<h5><?php echo $manga['title'];?></h5>
                        <h6>Auteur : <?=$manga['author'];?></h6>
                        <p><strong>Catégorie : </strong><?=$categories[$manga['category']];?></p>
					</div>
					<div class="col-3">
						<p><strong>Date de sortie : </strong><?php echo date('d/m/Y', strtotime($manga['publish_date']));?></p>
					</div>
                    <div class="col-2">
                        <p><strong>Stock : </strong><?=$manga['stock'];?></p>
                    </div>
                    <div class="col-2">
                        <a class="text-white btn btn-info" target="blank" href="product-details.php?id=<?=$manga['id'];?>">Voir plus</a>
                    </div>
				</div>
			<?php endforeach;?>
		</div>
	</main>

</body>
<?php include_once 'inc/footer.php';?>
</html>