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

    // Si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les valeurs du formulaire
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $parcours = isset($_POST['parcours']) ? $_POST['parcours'] : '';
        $birthdate = isset($_POST['dateDeNaissance']) ? $_POST['dateDeNaissance'] : '';
        $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : '';
        $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : '';

        // Insertion dans la base de données
        $insert_sql = "INSERT INTO etudiant (name, username, parcours, birthdate, adresse, sexe) VALUES (?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ssssss", $name, $username, $parcours, $birthdate, $adresse, $sexe);
        
        if ($insert_stmt->execute()) {
            // Rediriger vers index.php après l'insertion
            header("Location: index.php");
            exit();
        } else {
            echo "Erreur : " . $conn->error;
        }
        
        $insert_stmt->close();
    }

    // Fermer la connexion
    $conn->close();
?>
