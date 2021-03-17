<?php session_start(); ?>
<?php include "vues/header.php";


$uc = empty($_GET['uc']) ? "acceuil" : $_GET['uc'];

switch ($uc){
    case 'acceuil' :
        include ('vues/Acceuil.php');
        break;
    case 'continents' :
        break;
}
include "vues/java.php";

?>
