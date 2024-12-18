<?php
require_once '../config/db.php';
require_once '../includes/utils.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: list.php');
    exit();
}

$id = intval($_GET['id']);

$conn = db_connect();

$query = "DELETE FROM etudiants WHERE id = ?";
$stmt = prepare_sql_query($conn, $query, [$id]);

if ($stmt) {
    mysqli_stmt_execute($stmt);
    
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $_SESSION['message'] = "Étudiant supprimé avec succès !";
    } else {
        $_SESSION['error'] = "Étudiant non trouvé.";
    }
    
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['error'] = "Erreur lors de la suppression de l'étudiant.";
}

db_close($conn);

header('Location: list.php');
exit();