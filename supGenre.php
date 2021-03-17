<?php include "header.php";
include "base.php";
$num = $_GET['num'];
$req = $monPdo->prepare("delete from genre where num = :num");
$req->bindParam(':num', $num);
$nb = $req->execute();

echo '<main role="main">';

echo '<div class="container mt-5">';

if ($nb == 1) {
    $_SESSION['message']=["success" => "Le genre a pas été supprimé"];

} else {
    $_SESSION['message']=["success" => "Le genre n'a pas été supprimé"];
}
header('location: listeGenres.php');
exit();
?>
