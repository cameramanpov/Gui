<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ajouter le message dans le fichier XML
    $message = $_POST['message'];
    $author = $_SESSION['username'];

    $xml = simplexml_load_file('messages.xml');
    $newMessage = $xml->addChild('message');
    $newMessage->addChild('author', $author);
    $newMessage->addChild('content', $message);
    $xml->asXML('messages.xml');

    // Redirection pour éviter le renvoi du formulaire lors du rechargement de la page
    header('Location: messages.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div id="messages">
            <?php
            // Afficher les messages à partir du fichier XML
            $messages = simplexml_load_file('messages.xml');
            foreach ($messages->message as $message) {
                $author = $message->author;
                $content = $message->content;

                echo "<div class='message'>";
                echo "<span class='author'>" . $author . "</span>: ";
                echo "<span class='content'>" . $content . "</span>";
                if ($author == 'adminNj' || $author == $_SESSION['username']) {
                    echo "<button class='delete' onclick='deleteMessage(this)'>Supprimer</button>";
                }
                echo "</div>";
            }
            ?>
        </div>
        <form id="message-form" method="post">
            <input type="text" name="message" placeholder="Votre message">
            <button type="submit">Envoyer</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
