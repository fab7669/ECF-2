<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'Or</title>
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    
</body>
</html>

<div id=centrage>
        <div id=header>
        <h1>Livre d'Or</h1>
        </div>
        
     <div id=flex class="container fluid">
        <div class=row>
            
            <div class="col-6 text-center d-flex align-items-center" id=image>
            <figure>
            <img src="./assets/images/livre.jpg" alt="livre">
            </figure>
             </div>
        
        <div class=col-6 id= blocdroit>
            <div id=texte>
                    <?php
                    include_once('./connexion.php');
                    $req = $bdd->query('SELECT `message` FROM `messages` ORDER BY`date`DESC LIMIT 2');
?>
<?php
        while($messages = $req->fetch(PDO::FETCH_ASSOC)){
    ?>
            <article>
            <h3>Message:</h3>
        <p><?= $messages['message'] ?></p>
        </article>
    <?php
        }
    ?>
            </div>
        </div>

        <div class="container mt-5">
            <h2>Ajouter un Nouveau Message</h2>
            <form action="ajout.php" method="POST">
            <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>"> <!-- ID de l'utilisateur connecté -->
            <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>


    </div>
    </div>

    <?php

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];

    // Préparer la requête pour récupérer les messages
    $sql = $bdd->prepare("SELECT id_message, message FROM messages WHERE id_user = :id_user");
    $sql->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $sql->execute();

    // Afficher les messages
    $messages = $sql->fetchAll(PDO::FETCH_ASSOC);
    if (count($messages) > 0) {
        echo "<h2>Messages de l'utilisateur</h2>";
        echo "<ul class='list-unstyled'>"; // Liste des messages
        foreach ($messages as $msg) {
            echo "<li class='text-center'>"; // Élément de message
            echo "<div class='border p-3 rounded'>";
            echo "<p class='message-content'>" . htmlspecialchars($msg['message']) . "</p>"; // Afficher le message
            echo "<form action='modifier.php' method='GET' style='display:inline;'>"; // Formulaire pour modifier
            echo "<input type='hidden' name='message_id' value='" . $msg['id_message'] . "'>";
            echo "<button type='submit' class='btn btn-primary btn-sm'>Modifier</button>"; // Bouton Modifier
            echo "</form>";
            echo "<form action='delete.php' method='POST' style='display:inline;'>"; // Formulaire pour supprimer
            echo "<input type='hidden' name='message_id' value='" . $msg['id_message'] . "'>";
            echo "<button type='submit' class='btn btn-danger btn-sm'>Supprimer</button>"; // Bouton Supprimer
            echo "</form>";
            echo "</div>";
            echo "</li>"; // Fin de l'élément de message
        }
        echo "</ul>"; // Fin de la liste des messages
    } else {
        echo "<p>Aucun message trouvé.</p>";
    }
} else {
    echo "<p>Vous devez être connecté pour voir vos messages.</p>";
}
?>
</div>

</div>
        <div id=deconnection>
            
    <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
        </div>
</body>
</html>