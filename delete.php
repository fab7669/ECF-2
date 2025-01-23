<?php
include_once('./connexion.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['id_user'])) {
        $message_id = $_POST['message_id'];
        $id_user = $_SESSION['id_user'];

        // Préparer la requête de suppression
        $sql = $bdd->prepare("DELETE FROM messages WHERE id_message = :message_id AND id_user = :id_user");

        // Lier les paramètres
        $sql->bindParam(':message_id', $message_id, PDO::PARAM_INT);
        $sql->bindParam(':id_user', $id_user, PDO::PARAM_INT);

        // Exécuter la requête
        if ($sql->execute()) {
            // Rediriger vers la page des messages ou afficher un message de succès
            header("Location: saisie.php");
            exit();
        } else {
            echo "Erreur lors de la suppression du message.";
        }
    } else {
        echo "Aucune session active.";
    }
}
?>