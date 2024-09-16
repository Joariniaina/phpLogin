<?php
    // Connexion à la base de données
    $servername = "localhost";
    $username = "userMysql";
    $password = "AZertyuiop123@@@!";
    $dbname = "inscription";

    // Créer la connexion
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    // Vérifier si l'ID est défini
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // Récupérer les données de l'utilisateur
        $sql = "SELECT * FROM etudiant WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            echo "Utilisateur non trouvé.";
            exit();
        }
        
        $stmt->close();
    } else {
        echo "ID non spécifié.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
</head>
<body>

    <h1>Modifier l'utilisateur</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénoms</th>
            <th>Parcours</th>
            <th>Date de naissance</th>
            <th>Adresse</th>
            <th>Sexe</th>
        </tr>
        <tr>
            <td><?php echo htmlspecialchars($user['id']); ?></td>
            <td><?php echo htmlspecialchars($user['name']); ?></td>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
            <td><?php echo htmlspecialchars($user['parcours']); ?></td>
            <td><?php echo htmlspecialchars($user['birthdate']); ?></td>
            <td><?php echo htmlspecialchars($user['adresse']); ?></td>
            <td><?php echo htmlspecialchars($user['sexe']); ?></td>
        </tr>
</table><br><br>
<a href="index.php">Accueil</a>
</body>
</html>

<?php
    // Fermer la connexion
    $conn->close();
?>