<?php
include_once('./connexion.php');
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $message = $_POST['message'];
    $user_id = $_POST['id_user'];

   
    // Préparer la requête d'insertion
    $created_at = date('Y-m-d H:i:s');
    $sql = $bdd->prepare("INSERT INTO messages (id_user, date, message) VALUES (:id_user,:created_at, :message)");

    // Lier les paramètres
    $sql->bindParam(':created_at',$created_at , PDO::PARAM_STR);
    $sql->bindParam(':id_user', $user_id, PDO::PARAM_INT);
    $sql->bindParam(':message', $message, PDO::PARAM_STR);

    // Exécuter la requête
    if ($sql->execute()) {
        echo "Message ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du message.";
    }
}
header('location: ./saisie.php');

?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>