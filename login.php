<?php
if (($_SERVER["REQUEST_METHOD"] == "POST")) {
    session_start();

    require 'db_connect.php';

    $loginname = $_POST['id'];
    $loginpass = $_POST['pass'];


    if (empty($loginname) || empty($loginpass)) {
        // stocker le message d'erreur dans la session
        $_SESSION['vide'] = 'Veuillez saisir un login et un mot de passe.';

        // rediriger vers la page login.php
        header('Location: login.php');
        exit();

    } else {
        $sql = "SELECT * FROM compteproprietaire WHERE loginProp = '$loginname' and motPasse = '$loginpass'";

        $result = mysqli_query($conn, $sql);

        if (!$row = mysqli_fetch_assoc($result)) {
            $_SESSION['incorrect'] = 'Erreur de login/mot de passe !';

            header('Location: login.php');
            exit();
        } else {
            $_SESSION['Login'] = "Active";
            $_SESSION['id'] = $row['loginProp'];
            header("Location: index.php");
        }
    }

}
?>


<!DOCTYPE html>
<html data-bs-theme='light' lang='fr'>

<head>
    <meta charset='utf-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, shrink-to-fit=no'/>
    <title>Authentication - L-Stock</title>
    <link rel='stylesheet' href='assets/bootstrap/css/bootstrap.min.css'/>
    <link rel='stylesheet'
          href='https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap'/>
    <link rel='stylesheet' href='assets/css/Table-With-Search-search-table.css'/>
    <link rel='shortcut icon' href='assets/img/lstock.svg' type='image/svg'/>

    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css'>
</head>

<body>

<?php
// démarrer la session
session_start();

// vérifier si le message d'erreur existe
if (isset($_SESSION['vide'])) {
    include_once 'vide.html';

    unset($_SESSION['vide']);
}

if (isset($_SESSION['incorrect'])) {
    include_once 'incorrect.html';

    unset($_SESSION['incorrect']);
}

?>

<section class="py-5" style="padding-top: 1px;">
    <div class="container profile profile-view" id="profile">
        <div class="card">
            <div class="card-body text-center d-flex flex-column align-items-center">
                <div class="bs-icon-xl bs-icon-circle bs-icon-primary shadow bs-icon my-4">
                    <svg
                            xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                            viewBox="0 0 16 16"
                            class="bi bi-person">
                        <path
                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z">
                        </path>
                    </svg>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" data-bs-theme="light">

                    <div class="mb-3">
                        <input class="form-control" type="text" name="id" placeholder="Login">
                    </div>
                    <div class="mb-3"><input class="form-control" type="password" name="pass"
                                             placeholder="Mot de Passe"
                        >
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary shadow d-block w-100" type="submit">S'authentifier</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</section>

</body>

</html>