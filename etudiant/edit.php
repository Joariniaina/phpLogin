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
    <link rel="stylesheet" href="../front/styleInscription.css">
</head>
<body>
    <div id="inscription">
    <h1>Modification de <?php echo htmlspecialchars($user['name']); ?></h1>
        <div>
            <form action="update.php" method="post">
            <table cellpadding="10">
                <tr>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                    <td><label for="name">Nom :</label></td>
                    <td><input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="username">Prénom :</label></td>
                    <td><input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required></td>
                </tr>
                <tr>    
                    <td><label for="parcours">Parcours :</label></td>
                    <td><select name="parcours" id="parcours">
                        <option value="math" <?php if ($user['parcours'] == 'math') echo 'selected'; ?>>Math</option>
                        <option value="physics" <?php if ($user['parcours'] == 'physics') echo 'selected'; ?>>Physics</option>
                        <option value="science" <?php if ($user['parcours'] == 'science') echo 'selected'; ?>>Science</option>
                        <option value="MIT" <?php if ($user['parcours'] == 'MISA') echo 'selected'; ?>>MIT</option>
                    </select></td>
                </tr>
                <tr>
                    <td><label for="dateDeNaissance">Date de naissance :</label></td>
                    <td><input type="date" id="dateDeNaissance" name="dateDeNaissance" value="<?php echo htmlspecialchars($user['birthdate']); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="adresse">Adresse :</label></td>
                    <td><input type="text" id="adresse" name="adresse" value="<?php echo htmlspecialchars($user['adresse']); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="sexe">Sexe :</label></td>
                    <td>
                        <div id="sexe">
                            <div> 
                                <input type="radio" name="sexe" value="Masculin" <?php if ($user['sexe'] == 'Masculin') echo 'checked'; ?>/>
                                <p>M</p>
                            </div>
                            <div>
                                <input type="radio" name="sexe" value="Féminin" <?php if ($user['sexe'] == 'Féminin') echo 'checked'; ?> />
                                <p>F</p>
                            </div>
                            <div>
                                <input type="radio" name="sexe" value="Autre" <?php if ($user['sexe'] == 'Autre') echo 'checked'; ?>/>
                                <p>N</p>
                            </div> 
                        </div> 
                    </td>
                </tr>
            </table>
            <div class="save" >
                <input type="submit" value="Sauvegarder" href="index.php" id="submit">
            </div>    
        </form>
        </div>
    </div>
</body>
</html>

<?php
    // Fermer la connexion
    $conn->close();
?>