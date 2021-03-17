<?php include "header.php";
include "base.php";
$num = $_GET['num'];
$req = $monPdo->prepare("delete from nationalite where num = :num");
$req->bindParam(':num', $num);
$nb = $req->execute();

echo '<main role="main">';

echo '<div class="container mt-5">';

if ($nb == 1) {
    $_SESSION['message']=["success" => "La nationalité a pas été supprimé"];

} else {
    $_SESSION['message']=["success" => "La nationalité n'a pas été supprimé"];
}
header('location: listeNations.php');
exit();
?>
