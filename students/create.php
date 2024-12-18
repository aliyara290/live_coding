<?php
require_once '../config/db.php';
require_once '../includes/utils.php';

$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = db_connect();
    
    $nom = validate_input($_POST['nom'], 'string');
    $prenom = validate_input($_POST['prenom'], 'string');
    $email = validate_input($_POST['email'], 'email');
    $date_naissance = validate_input($_POST['date_naissance'], 'string');
    
    if ($nom && $prenom && $email && $date_naissance) {
        $query = "INSERT INTO etudiants (nom, prenom, email, date_naissance) VALUES (?, ?, ?, ?)";
        $stmt = prepare_sql_query($conn, $query, [$nom, $prenom, $email, $date_naissance]);
        
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                $success_message = "Étudiant ajouté avec succès !";
            } else {
                $error_message = "Erreur lors de l'ajout de l'étudiant.";
            }
            
            mysqli_stmt_close($stmt);
        }
    } else {
        $error_message = "Données invalides. Veuillez vérifier vos informations.";
    }
    
    db_close($conn);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Étudiant</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un Étudiant</h1>
        <a href="list.php">Retour à la liste</a>
        
        <?php if ($error_message): ?>
            <div class="error-message"><?= $error_message ?></div>
        <?php endif; ?>
        
        <?php if ($success_message): ?>
            <div class="success-message"><?= $success_message ?></div>
        <?php endif; ?>
        
        <form method="post" action="">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="date_naissance">Date de Naissance :</label>
                <input type="date" id="date_naissance" name="date_naissance" required>
            </div>
            
            <button type="submit" class="btn-submit">Ajouter</button>
        </form>
    </div>
</body>
</html>