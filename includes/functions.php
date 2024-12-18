<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/utils.php';

/**
 * Retrieve all students from the database.
 *
 * @return array An array of associative arrays representing the students.
 *               Each student is represented as an associative array with
 *               the following keys: id, nom, prenom, email, date_naissance.
 *               If the query fails, an empty array is returned.
 */
function get_all_students() {
    $conn = db_connect();
    $query = "SELECT id, nom, prenom, email, date_naissance FROM etudiants ORDER BY nom, prenom";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        error_log("Erreur de requête : " . mysqli_error($conn));
        db_close($conn);
        return [];
    }
    
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
    db_close($conn);
    
    return $students;
}

/**
 * Retrieve a student's details from the database by their ID.
 *
 * @param int $id The ID of the student to fetch.
 * @return array|false An associative array of the student's data if found, 
 *                     false if the student does not exist or on query failure.
 */

function get_student_by_id($id) {
    $conn = db_connect();
    $query = "SELECT * FROM etudiants WHERE id = ?";
    $stmt = prepare_sql_query($conn, $query, [$id]);
    
    if (!$stmt) {
        db_close($conn);
        return false;
    }
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $student = mysqli_fetch_assoc($result);
    
    mysqli_stmt_close($stmt);
    db_close($conn);
    
    return $student;
}