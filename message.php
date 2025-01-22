<?php
include_once('./connexion.php');
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $message = $_POST['message'];
    $user_id = $_POST['id_user'];

    var_dump($message,$user_id);

    // Préparer la requête d'insertion
    $sql = $bdd->prepare("INSERT INTO messages (id_user, message) VALUES (:id_user, :message)");

    // Lier les paramètres
    $sql->bindParam(':id_user', $user_id, PDO::PARAM_INT);
    $sql->bindParam(':message', $message, PDO::PARAM_STR);

    // Exécuter la requête
    if ($sql->execute()) {
        echo "Message ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du message.";
    }
}
?>



    

