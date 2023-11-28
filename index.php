<?php
session_start();
if ($_SESSION['Login'] != "Active") {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html data-bs-theme='light' lang='fr'>

<head>
    <meta charset='utf-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, shrink-to-fit=no'/>
    <title>Acceuil - L-Stock</title>
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
                    <a class='nav-link active' href='index.php'>Home</a>
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

                    <?php
                    $id = $_SESSION['id'];

                    require 'db_connect.php';
                    $sql = "SELECT prenom, nom  FROM compteproprietaire WHERE  loginProp = '$id' ";
                    $result = mysqli_query($conn, $sql);

                    $row1 = mysqli_fetch_assoc($result);

                    date_default_timezone_set('Africa/Casablanca');

                    $heure = date("H");

                    if ($heure < "18") {
                        $hellomessage = "Bonjour";
                    } else {
                        $hellomessage = "Bonsoir, ";
                    }
                    ?>

                    <h1 class='fw-bold'><?php echo $hellomessage . ' ' . ucwords(strtolower($row1['prenom'])) . ' ' . ucwords(strtolower($row1['nom'])); ?></h1>
                </div>
            </div>
        </div>
    </div>
</header>
<section class='py-5'>
    <div class='container'>
        <div>
            <div>
                <table class='table table-hover table-bordered table-responsive'>
                    <thead>
                    <tr>
                        <th id='trs-hd-1' class='text-center align-middle'>Reference</th>
                        <th id='trs-hd-2' class='text-center align-middle'>Libelle</th>
                        <th id='trs-hd-4' class='text-center align-middle'>Prix Unitaire</th>
                        <th id='trs-hd-5' class='text-center align-middle'>Date Achat</th>
                        <th id='trs-hd-6' class='text-center align-middle'>Photo Produit</th>
                        <th id='trs-hd-7' class='text-center align-middle'>Categorie</th>
                        <th id='trs-hd-8' class='text-center align-middle'>Modifier</th>
                        <th id='trs-hd-9' class='text-center align-middle'>Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    require 'db_connect.php';

                    $sql = "SELECT * FROM produit ORDER BY reference ASC";
                    $result = mysqli_query($conn, $sql);

                    $row = mysqli_fetch_assoc($result);
                    do { ?>
                        <?php
                        $sql2 = "SELECT * FROM categorie WHERE idCategorie = '$row[idCategorie]' ";
                        $result2 = mysqli_query($conn, $sql2);

                        $row2 = mysqli_fetch_assoc($result2);
                        ?>


                        <tr class='text-start'>
                            <td class='text-center align-middle'><?php echo $row['reference']; ?></td>
                            <td class='text-center align-middle'><?php echo $row['libelle']; ?></td>
                            <td class='text-center align-middle'><?php echo $row['prixUnitaire']; ?></td>
                            <td class='text-center align-middle'><?php echo $row['dateAchat']; ?></td>
                            <td class='text-center align-middle'><img
                                        src="assets/img/<?php echo $row['photoProduit']; ?>.png" alt="image" width="50"
                                        height="50">
                            </td>
                            <td class='text-center align-middle'><?php echo $row2['denomination']; ?></td>


                            <td class='text-center align-middle'>
                                <a class='btn btn-success btn-sm text-start'
                                   href="modifierproduit.php?id=<?php echo $row['reference']; ?>">
                                    <i class='bi bi-pencil-fill'></i>
                                </a>
                            </td>

                            <td class='text-center align-middle'>
                                <a class='btn btn-danger btn-sm'
                                   href="supprimerproduit.php?supid=<?php echo $row['reference']; ?>">
                                    <i class='bi bi-trash-fill'></i>
                                </a>
                            </td>

                        </tr>


                    <?php } while ($row = mysqli_fetch_assoc($result)) ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
</body>

</html>