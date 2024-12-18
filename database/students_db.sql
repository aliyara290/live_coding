CREATE DATABASE students_db;
USE students_db;

CREATE TABLE student (
    student_id INT AUTO_INCREMENT,
    first_name VARCHAR(30),
    last_name VARCHAR(30),
    age INT NOT NULL,
    grade VARCHAR(10),
    PRIMARY KEY(stuednt_id)
)