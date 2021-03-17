<?php include "header.php";
include "base.php";
$action = $_GET['action'];
$num= $_POST['num'];
$libelle= $_POST['libelle'];
//condition sur l'action Ajouter ou Modifier
if ($action == "Ajouter") {
    // requete pour inserer une nouvelle ligne
    $req = $monPdo->prepare("insert into genre(libelle) values (:libelle)");
    $req->bindParam(':libelle', $libelle);
}
else {
    // requete pour mettre à jour une ligne
    $req = $monPdo->prepare("update genre set libelle =:libelle where num =:num");
    $req->bindParam(':libelle', $libelle);
    $req->bindParam(':num', $num);
}
$nb = $req->execute();
//variable pour le message
$message = $action == "Modifier" ? "modifié" : "ajouté";


echo '<main role="main">';

echo '<div class="container mt-5">';

if ($nb == 1) {
    //message qui apparait au haut de la page listeGenre
    $_SESSION['message'] = ["success" => "Le genre a été $action"];
} else {
    //message qui apparait au haut de la page listeGenre
    $_SESSION['message'] = ["success" => "Le genre n\'a pas a été $action"];

}


header('location: listeGenres.php');
exit();

include "java.php";

?>