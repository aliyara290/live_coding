<?php

/**
 * Clean a given input to prevent XSS attacks
 *
 * @param string $data the input to clean
 *
 * @return string the cleaned input
 */
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Validate an input according to a given type
 *
 * @param string $input the input to validate
 * @param string $type the type of input to validate (email, int, string)
 * @param array $options options for the validation (min_length, max_length for string type)
 *
 * @return false|string the validated input or false if invalid
 */
function validate_input($input, $type = 'string', $options = []) {
    $input = clean_input($input);
    
    switch($type) {
        case 'email':
            return filter_var($input, FILTER_VALIDATE_EMAIL) ? $input : false;
        case 'int':
            return filter_var($input, FILTER_VALIDATE_INT, $options) !== false ? $input : false;
        case 'string':
            $min_length = $options['min_length'] ?? 2;
            $max_length = $options['max_length'] ?? 255;
            
            return (strlen($input) >= $min_length && strlen($input) <= $max_length) ? $input : false;
        default:
            return $input;
    }
}

/**
 * Prepare a SQL query with parameters to prevent SQL injection
 *
 * @param mysqli $conn the connection to use
 * @param string $query the SQL query to prepare
 * @param array $params the parameters to bind to the query
 *
 * @return false|mysqli_stmt the prepared statement or false if an error occurs
 */

function prepare_sql_query($conn, $query, $params = []) {
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt === false) {
        error_log("Erreur de préparation de requête SQL : " . mysqli_error($conn));
        return false;
    }
    
    if (!empty($params)) {
        $types = str_repeat('s', count($params));
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    
    return $stmt;
}