<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'students_crud_db');

function db_connect() {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if (!$conn) {
        error_log("Erreur de connexion à la base de données : " . mysqli_connect_error());
        die("Connexion échouée. Veuillez contacter l'administrateur.");
    }
    
    mysqli_set_charset($conn, 'utf8mb4');
    
    return $conn;
}

function db_close($conn) {
    mysqli_close($conn);
}