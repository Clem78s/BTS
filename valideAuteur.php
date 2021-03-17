<?php include "header.php";
include "base.php";
$action = $_GET['action'];
$num= $_POST['num'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$numNationalite = $_POST['libelle'];
if ($action == "Ajouter") {
    $req = $monPdo->prepare(
        "insert into auteur(nom,prenom,numNationalite) values (:nom , :prenom, :libelle)");
    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':libelle', $numNationalite, PDO::PARAM_INT);
} else {
    $req = $monPdo->prepare("update auteur set nom = :nom,prenom =:prenom,numNationalite=:libelle where num =:num");
    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':libelle', $numNationalite);
    $req->bindParam(':num', $num);
}
$nb = $req->execute();
$message = $action == "Modifier" ? "modifié" : "ajouté";

echo '<main role="main">';

echo '<div class="container mt-5">';

if ($nb == 1) {
    $_SESSION['message']=["success" => "L'auteur (l'autrice) a été ajouté(e)"];
} else {
    $_SESSION['message']=["success" => "L'auteur (l'autrice) n\'a pas a été ajouté(e)"];

}

    header('location: listeAuteur.php');
    exit();

include "java.php";

?>