<?php include "header.php";
include "base.php";
$libelle ="";
$continentSel="Tous";
$texteReq = "select n.num,n.libelle as 'nation',c.libelle as 'continent' from nationalite n inner join continent c where n.numContinent=c.num ";
if (!empty($_GET)) {
    $libelle = $_GET['libelle'];
    $continentSel= $_GET['continent'];
    if ($libelle != "") {
        $texteReq .= " and n.libelle like '%" . $libelle . "%'";
    }
    if ($continentSel != "Tous") {
        $texteReq .= " and c.num =" .$continentSel;
    }
}
$texteReq .= " order by n.libelle";
$req = $monPdo->prepare($texteReq);
$req->setFetchMode(PDO::FETCH_OBJ);
$req->execute();
$lesNations = $req->fetchAll();

$reqContinent = $monPdo->prepare("select * from continent");
$reqContinent->setFetchMode(PDO::FETCH_OBJ);
$reqContinent->execute();
$lesContinent = $reqContinent->fetchAll();

if (!empty($_SESSION['message'])) {
    $mesMessages = $_SESSION['message'];
    foreach ($mesMessages as $key => $message) {
        echo '<div class="alert alert-' . $key . ' alert-dismissble fade show" role= "alerte">' . $message . '
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
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
                <div class="col-9"><h1 style="text-decoration: underline">Liste des nationalités :</h1></div>
                <div class="col-3"><a href="formModifNationalite.php?action=Ajouter" class='btn btn-success'> <i
                                class="fas fa-plus-circle"></i> Créer une nationalité</a></div>
            </div>
            <form action="" method="get" class="border border-dark rounded p-3 mt-3 mb-3">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" id='libelle' placeholder="Saisir le libellé"
                               name='libelle' value="<?php echo $libelle; ?>">
                    </div>
                    <div class="col">
                        <select name="continent" class="form-control">
                            <?php
                            echo "<option value ='Tous'>Tous les continents</option>";
                            foreach ($lesContinent as $continent) {
                                $select = $continent->num == $continentSel ? 'selected' : '';
                                echo "<option  value='$continent->num' $select> $continent->libelle </option >";
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
                    <th scope="col" class="col-md-4">Libellée</th>
                    <th scope="col" class="col-md-4">Continent</th>
                    <th scope="col" class="col-md-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($lesNations as $nationalite) {
                    echo "<tr class='d-flex' >";
                    echo "<td class='col-md-2'>$nationalite->num</td>";
                    echo "<td class='col-md-4'>$nationalite->nation</td>";
                    echo "<td class='col-md-4'>$nationalite->continent</td>";
                    echo "<td class='col-md-2'>
                        <a href='formModifNationalite.php?action=Modifier&num=" . $nationalite->num . "' class='btn btn-success'><i class='fas fa-pencil-alt'></i></a>
                        <a href='#modalsupp' data-toggle='modal' data-suppression='supNation.php?num=$nationalite->num' class='btn btn-danger'><i class='fas fa-trash'></i> </a>
                            </td>";

                    echo "</tr>";

                }
                ?>
                </tbody>
            </table>


        </div>
        <div id="modalsupp" class="modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation de suppression :</h5>
                    </div>
                    <div class="modal-body">
                        <p>Voulez-vous réellement supprimer cette nationalité ?</p>
                    </div>
                    <div class="modal-footer">
                        <a id="btnSuppr" href="" type="button" class="btn btn-success">Supprimer la nationalité</a>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include "java.php";

?>