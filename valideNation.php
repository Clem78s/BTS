<?php include "header.php";
include "base.php";
$action = $_GET['action'];
$num= $_POST['num'];
$libelle = $_POST['libelle'];
$continent = $_POST['continent'];
if ($action == "Ajouter"){
    $req = $monPdo->prepare("insert into nationalite(libelle,numContinent) values (:libelle, :continent)");
    $req->bindParam(':libelle', $libelle);
    $req->bindParam(':continent',$continent);
    }
else {
    $req = $monPdo->prepare("update nationalite set libelle =:libelle,numContinent=:continent where num =:num");
    $req->bindParam(':libelle', $libelle);
    $req->bindParam(':num', $num);
    $req->bindParam(':continent',$continent);

}
$nb = $req->execute();
$message= $action == "Modifier" ? "modifiée" : "ajoutée";

echo '<main role="main">';

echo '<div class="container mt-5">';

if ($nb == 1) {
    $_SESSION['message'] = ["success" => "La nationalité a été ajouté(e)"];

} else {
    $_SESSION['message'] = ["success" => "La nationalité n\'a pas a été ajouté(e)"];

}

    header('location: listeNations.php');
    exit();
    include "java.php";

?>