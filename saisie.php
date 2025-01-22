<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
</body>
</html>

<div id=centrage class=container-fluid>
        <div id=header>
    <h1>Livre d'Or</h1>
        </div>

    <div id=flex class="container">
        <div class=row>
            
            <div class=col-6 id=image>
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
            <h3>Message</h3>
        <p><?= $messages['message'] ?></p>
        </article>
    <?php
        }
    ?>
      </div>
</div>
<div class="container mt-5">
    <h2>Ajouter un Nouveau Message</h2>
    <form action="message.php" method="POST">
        <div class="form-group">
            <label for="message">Message :</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>"> <!-- ID de l'utilisateur connecté -->
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
    </div>
    </div>

    </div>
</div>
</div>

        <div id=deconnection>
            
    <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
        </div>