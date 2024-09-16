<!-- login.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./front/style.css">
</head>
<body>
    <div id="verify">
        <h2>Connexion</h2>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Entrez votre e-mail" required><br><br>
            <label for="password">Mot de passe:</label><br><br>
            <div class = 'pass'>
                <input type="password" name="password" id="password" class='passwd' placeholder="Entrez votre mot de passe" required>
                <img src="../img/option-dinterface-a-oeil-ouvert-visible.png" class="icone" >
            </div><br>
            <input type="submit" value="Se connecter">
        </form>
        <p><a href="forgot_password.php">Mot de passe oublié ?</a></p>    
    </div>
    <?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupération des données du formulaire
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Connexion à la base de données
        $servername = "localhost";
        $username = "userMysql";
        $password_db = "AZertyuiop123@@@!";
        $dbname = "inscription";

        $conn = new mysqli($servername, $username, $password_db, $dbname);

        if ($conn->connect_error) {
            die("Échec de la connexion : " . $conn->connect_error);
        }

        // Rechercher l'utilisateur
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Vérifier le mot de passe
            if (password_verify($password, $user['password'])) {
                header("Location: ./etudiant/index.php");
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Utilisateur introuvable.";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
    <script src="./front/script.js"></script>
</body>
</html>
