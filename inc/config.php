<link href="css/style.css" rel="stylesheet">

<?php

// PHP 7

if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}

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