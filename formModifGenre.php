<?php include "header.php";
$action= $_GET['action'];
include "base.php";
if ($action == "Modifier") {
    $num = $_GET['num'];
    $req = $monPdo->prepare("select * from genre where num = :num");
    $req->setFetchMode(PDO::FETCH_OBJ);
    $req->bindParam(':num', $num);
    $req->execute();
    $leGenre = $req->fetch();
}

?>
    <main role="main">

        <div class="container mt-5">
            <h1 style="text-decoration: underline"><?php echo $action?> un genre </h1>
            <form action="valideGenre.php?action=<?php echo $action?>" method="post">
                <div class="form-group">
                    <label for='libelle'>Libellé</label>
                    <input type="text" class="form-control" id='libelle' placeholder="Saisir le libellé" name='libelle'
                           value="<?php if ($action== "Modifier"){ echo $leGenre->libelle;} ?>">
                </div>
                <input type="hidden" id="num" name="num" value="<?php echo $leGenre->num;?>">
                <div class="row">
                    <div class="col"><a href="listeGenres.php" class="btn btn-warning btn-block">Revenir à la liste des
                            genres</a>
                    </div>
                    <div class="col">
                        <button type='submit' class="btn btn-success btn-block"><?php echo $action?> le genre</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

<?php include "java.php";

?>