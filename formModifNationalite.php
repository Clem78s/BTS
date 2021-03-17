<?php include "header.php";
$action = $_GET['action'];
include "base.php";
// requete pour modif nation
if ($action == "Modifier") {
    $num = $_GET['num'];
    $req = $monPdo->prepare("select * from nationalite where num = :num");
    $req->setFetchMode(PDO::FETCH_OBJ);
    $req->bindParam(':num', $num);
    $req->execute();
    $lesNations = $req->fetch();
}
//requete pour avoir les continents
$reqContinent = $monPdo->prepare("select * from continent");
$reqContinent->setFetchMode(PDO::FETCH_OBJ);
$reqContinent->execute();
$lesContinent = $reqContinent->fetchAll();
?>
    <main role="main">

        <div class="container mt-5">
            <h1 style="text-decoration: underline"><?php echo $action ?> une nationalité </h1>
            <form action="valideNation.php?action=<?php echo $action ?>" method="post">
                <div class="form-group">
                    <label for='libelle'>Libellé</label>
                    <input type="text" class="form-control" id='libelle' placeholder="Saisir le libellé" name='libelle'
                           value="<?php if ($action == "Modifier") {echo $lesNations->libelle;} ?>">
                </div>
                <div class="form-group">
                    <label for='continent'>Continents</label>
                    <select name="continent" class="form-control">
                        <?php
                        //liste deroulante des continents
                        foreach ($lesContinent as $continent) {
                            $select = $continent->num == $lesNations->numContinent ? 'selected' : '';
                            echo "<option  value='$continent->num' $select> $continent->libelle </option >";
                        }
                        ?>
                    </select>
                </div>
                <input type="hidden" id="num" name="num" value="<?php if ($action == "Modifier")
                {echo $lesNations->num;} ?>">
                <div class="row">
                    <div class="col"><a href="listeNations.php" class="btn btn-warning btn-block">Revenir à la liste des
                            nations</a>
                    </div>
                    <div class="col">
                        <button type='submit' class="btn btn-success btn-block"><?php echo $action ?> la nationalité
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

<?php include "java.php";

?>