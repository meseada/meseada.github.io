<?php 

$kullanici = 'root'; 
$sifre = '';
	try {
	    $db = new PDO('mysql:host=localhost;dbname=meseada;charset=utf8',$kullanici,$sifre);
	} catch (PDOException $e) {
	    print "Hata!: " . $e->getMessage();
	    die();
	}

?>