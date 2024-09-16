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

    // Récupérer tous les utilisateurs
    $sql = "SELECT * FROM etudiant";
    $result = $conn->query($sql);

    // recuperer les parcours
    $sql1 = "SELECT * FROM parcours";
    $result1 = $conn->query($sql1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement des Utilisateurs</title>
    <link rel="stylesheet" href="../front/styleInscription.css">
    <script>
        function confirmDelete() {
            return confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?");
        }
    </script>

</head>
<body>
    <div id="head">
        <h2>BIENVENUE DANS LE SITE D'INSCRIPTION</h2>
    </div>
    <div id="inscription">
        <div id="inscriptionContainer">
            <div id="userInscription">
                <h2>inscription</h2>
                <form action="submit.php" method="post">
                <table cellpadding="10">
                        <tr>
                            <td><label for="name">Nom :</label></td>
                            <td><input type="text" id="name" name="name" required></td>
                        </tr>
                        <tr>
                            <td><label for="username">Prénom :</label></td>
                            <td><input type="text" id="username" name="username" required></td>
                        </tr>
                            <!-- ///////////////////////////////////lire les contenus de parcours//////////////////////////////////////////////////////// -->
                        <tr>
                            <td><label for="parcours">Parcours :</label></td>
                            <td><select name="parcours" id="parcours">
                                <?php if ($result1->num_rows > 0): ?>
                                    <?php while($row = $result1->fetch_assoc()): ?>
                                            <option value="<?php echo htmlspecialchars($row['matiere']); ?>"><?php echo htmlspecialchars($row['matiere']); ?></option>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8">Aucun utilisateur trouvé</td>
                                    </tr>
                                <?php endif; ?>
                                </select>
                            </td>
                        </tr>
                            <!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
                        <tr>
                            <td><label for="dateDeNaissance">Date de naissance :</label></td>
                            <td><input type="date" id="dateDeNaissance" name="dateDeNaissance" required></td>
                        </tr>
                        <tr>
                            <td><label for="adresse">Adresse :</label></td>
                            <td><input type="text" id="adresse" name="adresse" required></td>
                        </tr>
                        <tr>                            
                            <td><label for="sexe">Sexe :</label></td>
                            <td>
                                <div id="sexe">
                                    <div>    
                                        <input type="radio" name="sexe" value="Masculin">
                                        <p>M</p>
                                    </div>
                                    <div>
                                        <input type="radio" name="sexe" value="Féminin">
                                        <p>F</p>
                                    </div>
                                    <div>
                                        <input type="radio" name="sexe" value="Autre">
                                        <p>N</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" value="Soumettre" id="submit">
                    </form>
                </div>
            <div id="inscriptionList">
                <h2>Liste des utilisateurs</h2>        
                <table border="1" cellpadding="10">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td>
                                    <form action="delete.php" method="post" style="display:inline;" onsubmit="return confirmDelete();">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                        <input type="submit" value="Effacer">
                                    </form>
                                    <form action="edit.php" method="get" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                        <input type="submit" value="Modifier">
                                    </form>
                                    <form action="details.php" method="get" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                        <input type="submit" value="details">
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">Aucun utilisateur trouvé</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
        <div id="deconnect">
            <a href="../index.html" id="deconnectLink">Deconnecter</a>
        </div>
    </div>
</body>
</html>

<?php
    // Fermer la connexion
    $conn->close();
?>
