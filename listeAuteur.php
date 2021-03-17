<?php include "header.php";
include "base.php";
$nom="";
$prenom="";
$libelle ="";
$continentSel="Tous";
$texteReq = "SELECT auteur.num,auteur.nom,auteur.prenom,auteur.numNationalite,nationalite.libelle
                FROM auteur INNER JOIN nationalite WHERE auteur.numNationalite = nationalite.num";
if (!empty($_GET)) {
    $nom = $_GET['nom'];
    $prenom = $_GET['prenom'];
    $libelle = $_GET['libelle'];
    if ($nom != "") {
        $texteReq .= " and nom like '%" . $nom . "%'";
    }
    if ($prenom != "") {
        $texteReq .= " and prenom like '%" . $prenom . "%'";
    }
    if ($libelle != "Tous") {
        $texteReq .= " and nationalite.num like '" . $libelle . "'";
    }
}
$texteReq .= " order by nationalite.libelle";
$req = $monPdo->prepare($texteReq);
$req->setFetchMode(PDO::FETCH_OBJ);
$req->execute();
$lesAuteurs = $req->fetchAll();

$reqNations = $monPdo->prepare("select num,libelle from nationalite");
$reqNations->setFetchMode(PDO::FETCH_OBJ);
$reqNations->execute();
$LesNations = $reqNations->fetchAll();

if (!empty($_SESSION['message'])) {
    $mesMessages = $_SESSION['message'];
    foreach ($mesMessages as $key => $message) {
        echo '<div class="alert alert-' . $key . ' alert-dismissble fade show" role= "alerte">' . $message . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
    $_SESSION['message'] = [];
}
?>
    <main role="main">

        <div class="container mt-5">
            <div class="row pt-3">
                <div class="col-8"><h1 style="text-decoration: underline">Liste de tous les auteurs :</h1></div>
                <div class="col-4"><a href="formModifAuteur.php?action=Ajouter" class='btn btn-success'> <i
                                class="fas fa-plus-circle"></i> Créer un auteur (autrice)</a></div>
            </div>
            <form action="" method="get" class="border border-dark rounded p-3 mt-3 mb-3">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" id='nom' placeholder="Saisir le nom"
                               name='nom' value="<?php echo $nom; ?>">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id='prenom' placeholder="Saisir le prenom"
                               name='prenom' value="<?php echo $prenom; ?>">
                    </div>
                    <div class="col">
                        <select name="libelle" class="form-control">
                            <?php
                            echo "<option value ='Tous'>Tous les auteurs</option>";
                            foreach ($LesNations as $nations){
                                $select = $nations->num == $libelle ? 'selected' : '';
                                echo "<option  value='$nations->num' $select> $nations->libelle </option >";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-warning btn-block">Rechercher</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped">
                <thead>
                <tr class="table-info d-flex">
                    <th scope="col" class="col-md-2">Numéro</th>
                    <th scope="col" class="col-md-2">Nom</th>
                    <th scope="col" class="col-md-2">Prénom</th>
                    <th scope="col" class="col-md-2">Numéro de nationalité</th>
                    <th scope="col" class="col-md-2">Nationalité</th>
                    <th scope="col" class="col-md-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($lesAuteurs as $auteur) {
                    echo "<tr class='d-flex' >";
                    echo "<td class='col-md-2'>$auteur->num</td>";
                    echo "<td class='col-md-2'>$auteur->nom</td>";
                    echo "<td class='col-md-2'>$auteur->prenom</td>";
                    echo "<td class='col-md-2'>$auteur->numNationalite</td>";
                    echo "<td class='col-md-2'>$auteur->libelle</td>";
                    echo "<td class='col-md-2'>
                        <a href='formModifAuteur.php?num=" . $auteur->num . "&action=Modifier'class='btn btn-success'><i class='fas fa-pencil-alt'></i></a>
                        <a href='#modalsupp' data-toggle='modal' data-suppression='supAuteur.php?num=$auteur->num' class='btn btn-danger'><i class='fas fa-trash'></i> </a>
                            </td>";

                    echo "</tr>";

                }
                ?>
                </tbody>
            </table>


        </div>
        </div>
        <div id="modalsupp" class="modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation de suppression :</h5>
                    </div>
                    <div class="modal-body">
                        <p>Voulez-vous réellement supprimer cet(te) auteur (autrice) ?</p>
                    </div>
                    <div class="modal-footer">
                        <a id="btnSuppr" href="" type="button" class="btn btn-success">Supprimer l'auteur
                            (l'autrice)</a>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include "java.php";

?>