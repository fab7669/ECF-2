<?php
include_once('./connexion.php');
session_start();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Traitement de la connexion
    $email_connexion = htmlspecialchars($_POST['email_connexion']);
    $motdepasse_connexion = htmlspecialchars($_POST['motdepasse_connexion']);

    // Vérifier l'utilisateur
    $stmt = $bdd->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(":email", $email_connexion, PDO::PARAM_STR);
    $stmt->execute();
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

var_dump($utilisateur);

    if ($utilisateur > 0) {
            if (password_verify($motdepasse_connexion, $utilisateur['password'])) {
                $_SESSION['id_user'] = $utilisateur['id_user'];
                $_SESSION['message'] = "Connexion réussie pour $email_connexion!";
            header('Location: saisie.php'); // Rediriger vers une page protégée
            } else {
                $_SESSION['message'] = "Mot de passe incorrect.";
                header('Location: index.php?motdepasseincorect');
            }
    } else {
        $_SESSION['message'] = "L'email n'existe pas.";
        header('Location: index.php?emailinconnu');
    }
    exit();
}
?>