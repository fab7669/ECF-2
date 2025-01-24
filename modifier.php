<?php

include_once('./connexion.php');
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id_user'])) {
    if (isset($_GET['message_id'])) {
        $message_id = $_GET['message_id'];

        // Récupérer le message à modifier
        $sql = $bdd->prepare("SELECT message FROM messages WHERE id_message = :message_id AND id_user = :id_user");
        $sql->bindParam(':message_id', $message_id, PDO::PARAM_INT);
        $sql->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_INT);
        $sql->execute();

        $message = $sql->fetch(PDO::FETCH_ASSOC);
        if ($message) {
            ?>
<!DOCTYPE html>
<html lang="fr">
<head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <link rel="stylesheet" href="./assets/style.css">
                <title>Modifier Message</title>
            </head>
            <body>
<div >
    <div id=centrage class=container-fluid>
        <div id=header>
        <h1>Livre d'Or</h1>
        </div>
    <div id=flex class="container">
        <div class=row>
            <div class=col-md-6 id=image>
            <figure>
            <img src="./assets/images/livre.jpg" alt="livre" class='img-fluid'>
            </figure>
             </div>
             <div class="col-md-6" id="formulaire">
            <h2>Modifier votre message:</h2>
             <form action="update.php" method="POST">
             <input type="hidden" name="message_id" value="<?php echo $message_id; ?>">
             <textarea name="message" class="form-control" rows="6" required><?php echo htmlspecialchars($message['message']); ?></textarea>
             <br>
        <button type="submit" class="btn btn-primary">Mettre à jour</button> <!-- Bouton en bleu -->
    </form>
</div>
</div>          
</div>
            
            <?php
            } else {
            echo "<p>Message introuvable.</p>";
        }
    } else {
        echo "<p>Aucun ID de message fourni.</p>";
    }
} else {
    echo "<p>Vous devez être connecté pour modifier un message.</p>";
}
?>
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


