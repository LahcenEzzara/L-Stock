<?php
session_start();
if ($_SESSION['Login'] != "Active") {
    header("location:login.php");
}


if (isset($_GET['id'])) {
    $_SESSION['prodId'] = $_GET['id'];
}

$reference = $_SESSION['prodId'];

$conn = mysqli_connect("localhost", "root", "", "gestionproduit");


$sql = "SELECT * FROM produit WHERE reference = $reference";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $success = true;

    $libelle = $_POST['libelle'];
    $prix_unitaire = $_POST['prix_unitaire'];
    $date_achat = $_POST['date_achat'];
    $photo_produit = $_FILES['photo_produit'];
    $categorie = $_POST['categorie'];

    function getCategorieId($name)
    {
        switch ($name) {
            case "Camera":
                return 1;
            case "Casque":
                return 2;
            case "Clavier":
                return 3;
            case "Souris":
                return 4;
            default:
                return "Nom de catégorie non valide";
        }
    }

    $categorieId = getCategorieId($categorie);

    $conn = mysqli_connect("localhost", "root", "", "gestionproduit");

    $sql = "UPDATE produit SET libelle = '$libelle', prixUnitaire = '$prix_unitaire', dateAchat = '$date_achat', idCategorie = '$categorieId' WHERE reference = '$reference'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $success = true;
    } else {
        $success = false;
    }

    if ($success) {
        header("location:index.php");
    } else {
        echo "Désolé, il y a eu une erreur lors de la modification du produit.";
    }
}

?>


<!DOCTYPE html>
<html data-bs-theme='light' lang='fr'>

<head>
    <meta charset='utf-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, shrink-to-fit=no'/>
    <title>Modifier Produit - L-Stock</title>
    <link rel='stylesheet' href='assets/bootstrap/css/bootstrap.min.css'/>
    <link rel='stylesheet'
          href='https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap'/>
    <link rel='stylesheet' href='assets/css/Table-With-Search-search-table.css'/>
    <link rel='shortcut icon' href='assets/img/lstock.svg' type='image/svg'/>

    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css'>
</head>

<body>
<nav class='navbar navbar-expand-md sticky-top navbar-shrink py-3 navbar-light' id='mainNav'>
    <div class='container'>
        <a class='navbar-brand d-flex align-items-center' href='index.php'>
            <span>L-Stock</span></a>
        <button data-bs-toggle='collapse' class='navbar-toggler' data-bs-target='#navcol-1'>
            <span class='visually-hidden'>Toggle navigation</span><span class='navbar-toggler-icon'></span>
        </button>

        <div class='collapse navbar-collapse' id='navcol-1'>
            <ul class='navbar-nav mx-auto'>
                <li class='nav-item'>
                    <a class='nav-link' href='index.php'>Home</a>
                </li>

                <li class='nav-item'>
                    <a class='nav-link' href='ajouterproduit.php'>Ajouter Produits</a>
                </li>

                <li class='nav-item'>
                    <a class='nav-link' href='logout.php'>Quitter la session</a>
                </li>

            </ul>

        </div>
    </div>
</nav>

<header class='bg-primary-gradient'>
    <div class='container pt-4'>
        <div class='row '>
            <div class='col-md-8 col-lg-8 col-xl-6 text-center text-md-start mx-auto'>
                <div class='text-center'>
                    <h1 class='fw-bold'>Modifier Produit</h1>
                </div>
            </div>
        </div>
    </div>
</header>
<section class='py-5'>
    <div class='container profile profile-view' id='profile'>

        <form method='post' action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <div class='row profile-row'>
                <div class='col-md-8 col-lg-8 offset-lg-2 text-start'>
                    <div class='form-group mb-3'>

                        <div class='col-sm-12 col-md-6'>
                            <div class='form-group mb-3'>
                                <label class='form-label'><strong>Libelle</strong></label><input class='form-control'
                                                                                                 type='text'
                                                                                                 name='libelle'
                                                                                                 required
                                                                                                 value="<?php echo $row['libelle']; ?>"/>
                            </div>
                        </div>

                        <div class='form-group mb-3'>
                            <div class='col-sm-12 col-md-6'>
                                <div class='form-group mb-3'>
                                    <label class='form-label'><strong>Prix Unitaire</strong></label><input
                                            class='form-control'
                                            type='number' name='prix_unitaire' required
                                            value="<?php echo $row['prixUnitaire']; ?>"/>
                                </div>
                            </div>
                        </div>

                        <div class='form-group mb-3'>
                            <div class='col-sm-12 col-md-6'>
                                <div class='form-group mb-3'>
                                    <label class='form-label'><strong>Date Achat</strong></label><input
                                            class='form-control' type='date'
                                            name='date_achat' required
                                            value="<?php echo $row['dateAchat']; ?>"/>
                                </div>
                            </div>
                        </div>


                        <div class='form-group mb-3'>
                            <div class='col-sm-12 col-md-6'>
                                <div class='form-group mb-3'>
                                    <?php

                                    $sql2 = "SELECT * FROM categorie WHERE idCategorie = '$row[idCategorie]' ";
                                    $result2 = mysqli_query($conn, $sql2);

                                    $row2 = mysqli_fetch_assoc($result2);

                                    $categorieProduitActuel = $row2['denomination'];
                                    ?>

                                    <label class='form-label' for="categorieList"><strong>Categorie</strong></label><br>
                                    <select class='form-label' id="categorieList" name="categorie">
                                        <option value="Camera" <?php if ($categorieProduitActuel == 'Camera') echo 'selected'; ?>>
                                            Camera
                                        </option>
                                        <option value="Casque" <?php if ($categorieProduitActuel == 'Casque') echo 'selected'; ?>>
                                            Casque
                                        </option>
                                        <option value="Clavier" <?php if ($categorieProduitActuel == 'Clavier') echo 'selected'; ?>>
                                            Clavier
                                        </option>
                                        <option value="Souris" <?php if ($categorieProduitActuel == 'Souris') echo 'selected'; ?>>
                                            Souris
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class='row'>
                        <div class='col-md-12 col-lg-6 offset-lg-0 content-right'>

                            <button class='btn btn-primary form-btn' type='submit' style='margin-right: 20px'>MODIFIER
                            </button>

                            <button class='btn btn-danger form-btn' type='reset'
                                    onclick="window.location.href='index.php';">ANNULER
                            </button>

                        </div>
                    </div>
                </div>
        </form>
    </div>
</section>
</body>

</html>