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
        $name = $_POST['name'];
        $username = $_POST['username'];
        $parcours = $_POST['parcours'];
        $birthdate = $_POST['dateDeNaissance'];
        $adresse = $_POST['adresse'];
        $sexe = $_POST['sexe'];

        // Mettre à jour les données de l'utilisateur
        $update_sql = "UPDATE etudiant SET name = ?, username = ?, parcours = ?, birthdate = ?, adresse = ?, sexe = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssssi", $name, $username, $parcours, $birthdate, $adresse, $sexe, $id);
        
        if ($update_stmt->execute()) {
            // Rediriger vers index.php après la mise à jour
            header("Location: index.php");
            exit();
        } else {
            echo "Erreur : " . $conn->error;
        }
        
        $update_stmt->close();
    }

    // Fermer la connexion
    $conn->close();
?>
