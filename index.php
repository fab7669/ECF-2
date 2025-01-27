<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'Or</title>
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
    <?php
    include_once('./connexion.php');
    session_start();
    ?>
</head>
<body>
<?php
if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Vérifier si l'utilisateur existe déjà
    $sql = $bdd->prepare("SELECT id_user FROM users WHERE email = :email;");
    $sql->bindParam('email', $email, PDO::PARAM_STR);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        echo "L'utilisateur existe déjà.";
    } else {
        // Insérer le nouvel utilisateur dans la base de données
        $insertSql = $bdd->prepare("INSERT INTO users (name, email, password) VALUES (:nom, :email, :password);");
        $insertSql->bindParam('nom', $nom, PDO::PARAM_STR);
        $insertSql->bindParam('email', $email, PDO::PARAM_STR);
        $insertSql->bindParam('password', $password, PDO::PARAM_STR);

        if ($insertSql->execute()) {
            echo "Inscription réussie.";
            $sql->execute();
            $newuser = $sql->fetch(PDO::FETCH_ASSOC);
            $id_user = $newuser['id_user'];
        } else {
            echo "Erreur lors de l'inscription.";
        }
    }
}
?>

<div id="header" class="container-fluid">
    <h1>Livre d'Or</h1>
</div>

<div id="flex" class="container p-2">
    <div class="row">
        <div class="col-md-6" id="formulaire">
            <div class="mt-5">
                <h2>Formulaire d'Inscription</h2>
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de Passe:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit" value="inscription">S'inscrire</button>
                </form>
            </div>

            <div class="mt-5">
                <h2>Formulaire de Connexion</h2>
                <?php
                if (isset($_SESSION['message'])) {
                    echo "<div class='alert alert-info'>" . $_SESSION['message'] . "</div>";
                    unset($_SESSION['message']);
                }
                ?>
                <form action="controle.php" method="POST">
                    <div class="form-group">
                        <label for="email_connexion">Email:</label>
                        <input type="email" class="form-control" id="email_connexion" name="email_connexion" required>
                    </div>
                    <div class="form-group">
                        <label for="motdepasse_connexion">Mot de Passe:</label>
                        <input type="password" class="form-control" id="motdepasse_connexion" name="motdepasse_connexion" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </form>
            </div>
        </div>

        <div class="col-md-6 d-flex flex-column align-items-center" id="image">
            <figure class="text-center">
                <img class="img-fluid" src="./assets/images/livre.jpg" alt="livre d'or">
            </figure>
            
            <div class="mt-4">
                <?php
                // Récupérer le dernier message
                $req = $bdd->query('SELECT `message` FROM `messages` ORDER BY `date` DESC LIMIT 1');
                while ($messages = $req->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <article>
                        <h2>Dernier Message:</h2>
                        <p><?= htmlspecialchars($messages['message']) ?></p>
                    </article>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div id="header" class="container-fluid">
        <h1>Livre d'Or</h1>
       
    <figure>
        <img src="./assets/images/face.webp" class="img-fluid" alt="facebook">
        <img src="./assets/images/Insta.webp" class="img-fluid" alt="Instagram">
        <img src="./assets/images/twitter.webp" class="img-fluid" alt="twitter">
    </figure>
</div>  


</body>
</html>