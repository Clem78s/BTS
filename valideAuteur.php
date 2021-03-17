<?php include "header.php";
include "base.php";
$action = $_GET['action'];
$num= $_POST['num'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$numNationalite = $_POST['libelle'];
//condition sur l'action Ajouter ou Modifier
if ($action == "Ajouter") {
    // requete pour inserer une nouvelle ligne
    $req = $monPdo->prepare(
        "insert into auteur(nom,prenom,numNationalite) values (:nom , :prenom, :libelle)");
    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':libelle', $numNationalite, PDO::PARAM_INT);
} else {
    // requete pour mettre à jour une ligne
    $req = $monPdo->prepare("update auteur set nom = :nom,prenom =:prenom,numNationalite=:libelle where num =:num");
    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':libelle', $numNationalite);
    $req->bindParam(':num', $num);
}
$nb = $req->execute();
//variable pour le message
$message = $action == "Modifier" ? "modifié" : "ajouté";

echo '<main role="main">';

echo '<div class="container mt-5">';

if ($nb == 1) {
    //message qui apparait au haut de la page listeAuteur
    $_SESSION['message']=["success" => "L'auteur (l'autrice) a été $action"];
} else {
    //message qui apparait au haut de la page listeAuteur
    $_SESSION['message']=["success" => "L'auteur (l'autrice) n\'a pas a été $action"];

}

    header('location: listeAuteur.php');
    exit();

include "java.php";

?>