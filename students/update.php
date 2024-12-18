<?php
require_once '../config/db.php';
require_once '../includes/utils.php';
require_once '../includes/functions.php';

$error_message = '';
$success_message = '';


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: list.php');
    exit();
}

$id = intval($_GET['id']);
$student = get_student_by_id($id);

if (!$student) {
    header('Location: list.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = db_connect();
    
    $nom = validate_input($_POST['nom'], 'string');
    $prenom = validate_input($_POST['prenom'], 'string');
    $email = validate_input($_POST['email'], 'email');
    $date_naissance = validate_input($_POST['date_naissance'], 'string');
    
    if ($nom && $prenom && $email && $date_naissance) {
        $query = "UPDATE etudiants SET nom = ?, prenom = ?, email = ?, date_naissance = ? WHERE id = ?";
        $stmt = prepare_sql_query($conn, $query, [$nom, $prenom, $email, $date_naissance, $id]);
        
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                $success_message = "Étudiant modifié avec succès !";
                $student = get_student_by_id($id);
            } else {
                $error_message = "Aucune modification effectuée.";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <title>Éditer un Étudiant</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container pt-16 px-6">
        <h1 class="text-2xl font-bold text-gray-900">Éditer un Étudiant</h1>
        <a class="btn-back text-blue-500 font-medium hover:underline" href="list.php">Retour à la liste</a>
        
        <?php if ($error_message): ?>
            <div class="error-message"><?= $error_message ?></div>
        <?php endif; ?>
        
        <?php if ($success_message): ?>
            <div class="success-message"><?= $success_message ?></div>
        <?php endif; ?>
        
        <form method="post" action="">
            <div class="form-group mb-4 w-full">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($student['nom']) ?>" required>
            </div>
            
            <div class="form-group mb-4 w-full">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($student['prenom']) ?>" required>
            </div>
            
            <div class="form-group mb-4 w-full">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" required>
            </div>
            
            <div class="form-group mb-4 w-full">
                <label for="date_naissance">Date de Naissance :</label>
                <input type="date" id="date_naissance" name="date_naissance" value="<?= $student['date_naissance'] ?>" required>
            </div>
            
            <button type="submit" class="btn-submit">Modifier</button>
        </form>
    </div>
</body>
</html>