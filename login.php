<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des informations d'identification à partir du fichier XML
    $users = simplexml_load_file('credentials.xml');
    foreach ($users->user as $user) {
        if ($user->username == $username && $user->password == $password) {
            $_SESSION['username'] = $username;
            break;
        }
    }

    if (isset($_SESSION['username'])) {
        header('Location: index.php');
        exit;
    } else {
        echo '<script>alert("Nom d\'utilisateur ou mot de passe incorrect.");</script>';
    }
}
?>

<div id="login-form" style="<?php echo isset($_SESSION['username']) ? 'display: none;' : ''; ?>">
    <form method="post">
        <input type="text" name="username" placeholder="Nom d'utilisateur">
        <input type="password" name="password" placeholder="Mot de passe">
        <button type="submit">Connexion</button>
    </form>
</div>
