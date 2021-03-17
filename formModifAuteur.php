<?php include "header.php";
$action = $_GET['action'];
include "base.php";
// requete pour une modif auteur
if ($action == "Modifier") {
    $num = $_GET['num'];
    $req = $monPdo->prepare("select * from auteur where num = :num");
    $req->setFetchMode(PDO::FETCH_OBJ);
    $req->bindParam(':num', $num);
    $req->execute();
    $lesAuteurs = $req->fetch();
}
$reqNation = $monPdo->prepare("SELECT num,libelle FROM nationalite");
$reqNation->setFetchMode(PDO::FETCH_OBJ);
$reqNation->execute();
$nations=$reqNation->fetchAll();
?>
    <main role="main">
        <div class="container mt-5">
            <h1 style="text-decoration: underline"><?php echo $action ?> un auteur (autrice) </h1>
            <form action="valideAuteur.php?action=<?php echo $action ?>" method="post">
                <div class="form-group">
                    <label for='Nom'>Nom</label>
                    <input type="text" class="form-control" id='nom' placeholder="Saisir le nom" name='nom'
                           value="<?php if ($action== "Modifier"){ echo $lesAuteurs->nom;} ?>">
                    <label for='Prenom'>Prémon</label>
                    <input type="text" class="form-control" id='prenom' placeholder="Saisir le prenom" name='prenom'
                           value="<?php if ($action== "Modifier"){ echo $lesAuteurs->prenom;} ?>">
                </div>
                <div class="form-group">
                    <label for='libelle'>Nationalité</label>
                    <select name="libelle" class="form-control">
                        <?php
                        //liste deroulante nations
                        foreach ($nations as $nation){
                            $select = $nation->num == $lesAuteurs->numNationalite ? 'selected' : '';
                            echo "<option  value='$nation->num' $select> $nation->libelle </option >";
                        }
                        ?>
                    </select>
                </div>
                <input type="hidden" id="num" name="num" value="<?php echo $lesAuteurs->num; ?>">
                <div class="row">
                    <div class="col"><a href="listeAuteur.php" class="btn btn-warning btn-block">Revenir à la liste des
                            auteurs</a>
                    </div>
                    <div class="col">
                        <button type='submit' class="btn btn-success btn-block"><?php echo $action ?> l'auteur
                            (l'autrice)
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

<?php include "java.php";

?><?php
