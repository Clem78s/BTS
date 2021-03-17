<?php include "header.php";
include "base.php";
$libelle ="";
$texteReq = "select * from genre";
if (!empty($_GET)) {
    $libelle = $_GET['libelle'];
    if ( $libelle!= "") {
        $texteReq .= " where libelle like '%" . $libelle . "%'";
    }
}
$texteReq .= " order by libelle";
$req = $monPdo->prepare($texteReq);
$req->setFetchMode(PDO::FETCH_OBJ);
$req->execute();
$lesGenres = $req->fetchAll();

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
                <div class="col-9"><h1 style="text-decoration: underline">Liste de tous les genres :</h1></div>
                <div class="col-3"><a href="formModifGenre.php?action=Ajouter" class='btn btn-success'> <i class="fas fa-plus-circle"></i>
                        Créer un genre</a>
                </div>
                <form action="" method="get" class="border border-dark rounded p-3 mt-3 mb-3">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" id='libelle' placeholder="Saisir le libellé"
                                   name='libelle' value="<?php echo $libelle; ?>">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-warning btn-block">Rechercher</button>
                        </div>
                    </div>
                </form>
                <table class="table table-striped">
                    <thead>
                    <tr class="table-info d-flex">
                        <th scope="col" class="col-md-4">Numéro</th>
                        <th scope="col" class="col-md-6">Libellée</th>
                        <th scope="col" class="col-md-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($lesGenres as $genre) {
                        echo "<tr class='d-flex' >";
                        echo "<td class='col-md-4'>$genre->num</td>";
                        echo "<td class='col-md-6'>$genre->libelle</td>";
                        echo "<td class='col-md-2'>
                        <a href='formModifGenre.php?action=Modifier&num=" . $genre->num . "'class='btn btn-success'><i class='fas fa-pencil-alt'></i></a>
                        <a href='#modalsupp' data-toggle='modal' data-suppression='supGenre.php?num=$genre->num' class='btn btn-danger'><i class='fas fa-trash'></i> </a>
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
                            <p>Voulez-vous réellement supprimer ce genre ?</p>
                        </div>
                        <div class="modal-footer">
                            <a id="btnSuppr" href="" type="button" class="btn btn-success">Supprimer le genre</a>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
    </main>

<?php include "java.php";

?>