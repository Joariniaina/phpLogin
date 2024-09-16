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
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        
        // Suppression de l'utilisateur
        $delete_sql = "DELETE FROM etudiant WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $id);
        
        if ($delete_stmt->execute()) {
            // Rediriger vers index.php après la suppression
            header("Location: index.php");
            exit();
        } else {
            echo "Erreur : " . $conn->error;
        }
        
        $delete_stmt->close();
    }

    // Fermer la connexion
    $conn->close();
?>
