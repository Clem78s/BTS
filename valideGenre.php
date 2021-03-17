<?php include "header.php";
include "base.php";
$action = $_GET['action'];
$num= $_POST['num'];
$libelle= $_POST['libelle'];
if ($action == "Ajouter") {
    $req = $monPdo->prepare("insert into genre(libelle) values (:libelle)");
    $req->bindParam(':libelle', $libelle);
}
else {
    $req = $monPdo->prepare("update genre set libelle =:libelle where num =:num");
    $req->bindParam(':libelle', $libelle);
    $req->bindParam(':num', $num);
}
$nb = $req->execute();
$message = $action == "Modifier" ? "modifié" : "ajouté";


echo '<main role="main">';

echo '<div class="container mt-5">';

if ($nb == 1) {
    $_SESSION['message'] = ["success" => "Le genre a été ajouté(e)"];
} else {
    $_SESSION['message'] = ["success" => "Le genre n\'a pas a été ajouté(e)"];

}


header('location: listeGenres.php');
exit();

include "java.php";

?>