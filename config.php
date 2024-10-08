<?php

// connect to MySQL general server
$gconn = mysqli_connect('localhost','root','');

// check general connection
if(!$gconn){
    die("Connection failed: " . mysqli_connect_error()); // exit
}


///////////// move on to check user db /////////////


// Create user db if not exists
$userdb = 'user_db';
$userdbCheckQuery = "CREATE DATABASE IF NOT EXISTS $userdb";

if(mysqli_query($gconn, $userdbCheckQuery)){
    // echo "Db 'user_db' checked/created successfully<br>";
}
else{
    die("Error creating db: " . mysqli_error($gconn));
}

// connect to user db
$conn = mysqli_connect('localhost', 'root', '', 'user_db');

// check connection
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

// SQL qry to create user_form table if not exist
$createTableQuery = "
    CREATE TABLE IF NOT EXISTS user_form (
        id INT(255) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        user_type VARCHAR(255) NOT NULL DEFAULT 'user'
    ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
";

if(mysqli_query($conn, $createTableQuery)){
    // echo "table 'user_form' checked/created succesfully<br>";
}
else{
    die("Error creating db: " . mysqli_error($conn));
}


///////////// move on to check questions db /////////////

// Create question db if not exists
$questionsdb = 'questions_db';
$questionsdbCheckQuery = "CREATE DATABASE IF NOT EXISTS $questionsdb";

if(mysqli_query($gconn, $questionsdbCheckQuery)){
    // echo "Db 'questions_db' checked/created successfully<br>";
}
else{
    die("Error creating db: " . mysqli_error($gconn));
}

// connect to user db
$conn2 = mysqli_connect('localhost', 'root', '', 'questions_db');

// check connection
if(!$conn2){
    die("Connection failed: " . mysqli_connect_error());
}

// SQL qry to create problems table if not exist
$createTableQuery2 = "
    CREATE TABLE IF NOT EXISTS problems (
        id INT AUTO_INCREMENT PRIMARY KEY,
        question TEXT NOT NULL,
        answer_a TEXT NOT NULL,
        answer_b TEXT NOT NULL,
        answer_c TEXT NOT NULL,
        answer_d TEXT NOT NULL,
        correct_answer CHAR(1) NOT NULL,
        category VARCHAR(100) NOT NULL,
        difficulty ENUM('easy', 'medium', 'hard') NOT NULL
    );
";

if(mysqli_query($conn2, $createTableQuery2)){
    // echo "table 'problems' checked/created succesfully<br>";
}
else{
    die("Error creating db: " . mysqli_error($conn2));
}


?>