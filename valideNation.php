<?php include "header.php";
include "base.php";
$action = $_GET['action'];
$num= $_POST['num'];
$libelle = $_POST['libelle'];
$continent = $_POST['continent'];
//condition sur l'action Ajouter ou Modifier
if ($action == "Ajouter"){
    // requete pour inserer une nouvelle ligne
    $req = $monPdo->prepare("insert into nationalite(libelle,numContinent) values (:libelle, :continent)");
    $req->bindParam(':libelle', $libelle);
    $req->bindParam(':continent',$continent);
    }
else {
    // requete pour mettre à jour une ligne
    $req = $monPdo->prepare("update nationalite set libelle =:libelle,numContinent=:continent where num =:num");
    $req->bindParam(':libelle', $libelle);
    $req->bindParam(':num', $num);
    $req->bindParam(':continent',$continent);

}
$nb = $req->execute();
//variable pour le message
$message= $action == "Modifier" ? "modifiée" : "ajoutée";

echo '<main role="main">';

echo '<div class="container mt-5">';

if ($nb == 1) {
    //message qui apparait au haut de la page listeNation
    $_SESSION['message'] = ["success" => "La nationalité a été $action"];

} else {
    //message qui apparait au haut de la page listeNation
    $_SESSION['message'] = ["success" => "La nationalité n\'a pas a été $action"];

}

    header('location: listeNations.php');
    exit();
    include "java.php";

?>