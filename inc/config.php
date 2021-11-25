<?php

// Catégorie de mes articles
$categories= [
	'shonen'    => 'Shōnen',
	'Shojo' 	=> 'Shōjo',
	'Seinen'	=> 'Seinen',
	'Yaoi' 	    => 'Yaoi',
	'Yuri'  	=> 'Yuri',
	'Ecchi' 	=> 'Ecchi',
];

$identifiant = 'root';
$pw = '';

$conn = new PDO('mysql:host=localhost;dbname=manga;charset=utf8mb4', $identifiant, $pw);

?>