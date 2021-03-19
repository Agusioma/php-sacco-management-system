<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$mysqli = new mysqli("", "", "");
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
 
// Attempt create database query execution
$sql = "CREATE DATABASE jbcs";
if($mysqli->query($sql) === true){
    echo "Database created successfully";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

$mysqli->close();

$mysqli = new mysqli("", "", "","");

// Attempt create table query execution
$sql = "CREATE TABLE customers(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    NatID VARCHAR(12) NOT NULL UNIQUE,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(40) NOT NULL UNIQUE,
    PhoneNo VARCHAR(12) NOT NULL,
    regDate VARCHAR(19) NOT NULL,
    password VARCHAR(20) NOT NULL          
)";
if($mysqli->query($sql) === true){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

// Attempt create table query execution
$sql = "CREATE TABLE loans(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    customerID VARCHAR(12) NOT NULL,
    loanID VARCHAR(10) NOT NULL UNIQUE,
    loanAmount DECIMAL(10,2) NOT NULL,
    repaymentDate VARCHAR(19) NOT NULL,
    penaltyDate VARCHAR(19) NOT NULL DEFAULT 0,    
    penalty DECIMAL(10,2) NOT NULL DEFAULT 0.00
)";
if($mysqli->query($sql) === true){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

// Attempt create table query execution
$sql = "CREATE TABLE transactions(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    customerID VARCHAR(12) NOT NULL,
    transID VARCHAR(10) NOT NULL UNIQUE,
    transType VARCHAR(12) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    transDate VARCHAR(19) NOT NULL
)";
if($mysqli->query($sql) === true){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

$sql = "CREATE TABLE savings(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    customerID VARCHAR(12) NOT NULL UNIQUE,
    currYear VARCHAR(4) NOT NULL UNIQUE,
    january DECIMAL(10,2) NOT NULL DEFAULT 0,
    february DECIMAL(10,2) NOT NULL DEFAULT 0,
    march DECIMAL(10,2) NOT NULL DEFAULT 0,
    april DECIMAL(10,2) NOT NULL DEFAULT 0,
    june DECIMAL(10,2) NOT NULL DEFAULT 0,
    july DECIMAL(10,2) NOT NULL DEFAULT 0,
    august DECIMAL(10,2) NOT NULL DEFAULT 0,
    september DECIMAL(10,2) NOT NULL DEFAULT 0,
    october DECIMAL(10,2) NOT NULL DEFAULT 0,
    november DECIMAL(10,2) NOT NULL DEFAULT 0,
    december DECIMAL(10,2) NOT NULL DEFAULT 0
)";
if($mysqli->query($sql) === true){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

$sql = "CREATE TABLE dividends(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    customerID VARCHAR(12) NOT NULL UNIQUE,
    currYear VARCHAR(4) NOT NULL UNIQUE,
    amount DECIMAL(10,2) NOT NULL DEFAULT 0
)";
if($mysqli->query($sql) === true){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

$mysqli->close();
?>
