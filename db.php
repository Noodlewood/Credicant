<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'create' : create();break;
        case 'drop' : drop();break;
        case 'addProduct' : addProduct();break;
    }
}

function create() {
    global $conn;

    $sql = "CREATE DATABASE credicant";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
        $conn->select_db("credicant");

        $sql = "CREATE TABLE Products (
            p_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(30) NOT NULL,
            description VARCHAR(30) NOT NULL,
            price DECIMAL(5,2)
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table Products created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($conn);
        }

        $sql = "CREATE TABLE Customers (
            c_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL,
            surname VARCHAR(30) NOT NULL,
            address VARCHAR(30) NOT NULL,
            postal INTEGER(10) NOT NULL,
            mail VARCHAR(30) NOT NULL
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table Customers created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($conn);
        }

        $sql = "CREATE TABLE Orders (
            o_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            c_id int(6) UNSIGNED,
            p_id int(6) UNSIGNED,
            FOREIGN KEY (c_id) REFERENCES Customers(c_id),
            FOREIGN KEY (p_id) REFERENCES Products(p_id)
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table Orders created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($conn);
        }

    } else {
        echo "Error creating database: " . $conn->error;
    }

    $conn->close();
}

function drop() {
    global $conn;

    $sql = "DROP DATABASE credicant";
    if ($conn->query($sql) === TRUE) {
        echo "Database dropped successfully";
    } else {
        echo "Error dropping database: " . $conn->error;
    }

    $conn->close();
}

function addProduct() {
    global $conn;

    echo "addProduct";
}
?>