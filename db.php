<?php

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'create' : create();break;
        case 'drop' : drop();break;
        case 'addProduct' : addProduct();break;
        case 'getShoppingCartProducts' : getProducts();break;
        case 'addOrder' : addOrder();break;
        case 'getOrders' : getOrders();break;
    }
}

function connect() {
    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function create() {
    $conn = connect();

    $sql = "CREATE DATABASE credicant";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully" . PHP_EOL;
        $conn->select_db("credicant");

        $sql = "CREATE TABLE Products (
            p_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(30) NOT NULL,
            description TEXT NOT NULL,
            price DECIMAL(10,2)
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table Products created successfully" . PHP_EOL;
        } else {
            echo "Error creating table: " . mysqli_error($conn) . PHP_EOL;
        }

        $sql = "CREATE TABLE Keywords (
            k_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            p_id int(6) UNSIGNED,
            title VARCHAR(30) NOT NULL,
            FOREIGN KEY (p_id) REFERENCES Products(p_id)
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table Keywords created successfully" . PHP_EOL;
        } else {
            echo "Error creating table: " . mysqli_error($conn) . PHP_EOL;
        }

        $sql = "CREATE TABLE Pictures (
            pic_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            p_id int(6) UNSIGNED,
            src VARCHAR(30) NOT NULL,
            FOREIGN KEY (p_id) REFERENCES Products(p_id)
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table Pictures created successfully" . PHP_EOL;
        } else {
            echo "Error creating table: " . mysqli_error($conn) . PHP_EOL;
        }

        $sql = "CREATE TABLE Orders (
            o_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            orderdate DATE NOT NULL,
            firstname VARCHAR(30) NOT NULL,
            surname VARCHAR(30) NOT NULL,
            street VARCHAR(30) NOT NULL,
            city VARCHAR(30) NOT NULL,
            postal INTEGER(10) NOT NULL,
            mail VARCHAR(30) NOT NULL
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table Orders created successfully" . PHP_EOL;
        } else {
            echo "Error creating table: " . mysqli_error($conn) . PHP_EOL;
        }

        $sql = "CREATE TABLE OrderItems (
            oi_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            o_id int(6) UNSIGNED,
            p_id int(6) UNSIGNED,
            FOREIGN KEY (o_id) REFERENCES Orders(o_id),
            FOREIGN KEY (p_id) REFERENCES Products(p_id)
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table OrderItems created successfully" . PHP_EOL;
        } else {
            echo "Error creating table: " . mysqli_error($conn) . PHP_EOL;
        }


    } else {
        echo "Error creating database: " . $conn->error . PHP_EOL;
    }

    $conn->close();
}

function drop() {
    $conn = connect();

    $sql = "DROP DATABASE credicant";
    if ($conn->query($sql) === TRUE) {
        echo "Database dropped successfully" . PHP_EOL;
    } else {
        echo "Error dropping database: " . $conn->error . PHP_EOL;
    }

    $conn->close();
}

function addProduct() {

    $conn = connect();
    $conn->select_db("credicant");

    $sql = "INSERT INTO Products (title, price, description) VALUES ('" . $_POST["title"] . "', " . $_POST["price"] . ", '" . $_POST["desc"] . "')";

    if ($conn->query($sql) === TRUE) {
        echo "Product inserted successfully" . PHP_EOL;
        $id = $conn->insert_id;
        foreach($_POST["keywords"] as $keyword) {
            if (!empty($keyword)) {
                echo $id;
                $sql = "INSERT INTO Keywords (p_id, title) VALUES (" . $id . ",'" . $keyword . "')";
                if ($conn->query($sql) === TRUE) {
                    echo "Keyword inserted successfully" . PHP_EOL;
                }  else {
                    echo "Error inserting into database: " . $conn->error . PHP_EOL;
                }
            }

        }
        foreach($_POST["pictures"] as $picture) {
            if (!empty($picture)) {
                $sql = "INSERT INTO Pictures (p_id, src) VALUES (" . $id . ",'" . $picture . "')";
                $conn->query($sql);
            }
        }
    } else {
        echo "Error inserting into database: " . $conn->error . PHP_EOL;
    }
    $conn->close();
}

function addOrder() {

    $conn = connect();
    $conn->select_db("credicant");

    $sql = "INSERT INTO orders (orderdate, firstname, surname, street, city, postal, mail) VALUES ('" . date("Y-m-d") . "', '" . $_POST["firstname"] . "', '" . $_POST["surname"] . "', '" . $_POST["street"] . "', " . $_POST["city"] . "', " . $_POST["postal"] . ", '" . $_POST["mail"] . "')";

    if ($conn->query($sql) === TRUE) {
        echo "Order inserted successfully" . PHP_EOL;
        $id = $conn->insert_id;
        foreach($_POST["products"] as $productId) {
            $sql = "INSERT INTO OrderItems (o_id, p_id) VALUES (" . $id . ", " . $productId . ")";
            $conn->query($sql);
        }

    } else {
        echo "Error inserting into database: " . $conn->error . PHP_EOL;
    }
    $conn->close();
}

function getProducts() {
    $conn = connect();
    $conn->select_db("credicant");

    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    $jsonData = array();
    while ($array = $result->fetch_assoc()) {
        $sql = "SELECT src FROM pictures WHERE pictures.p_id = " . $array["p_id"];
        $presult = $conn->query($sql);
        $array["pictures"] = [];
        while ($parray = $presult->fetch_assoc()) {
            array_push($array["pictures"], $parray["src"]);
        }

        $sql = "SELECT title FROM keywords WHERE keywords.p_id = " . $array["p_id"];
        $kresult = $conn->query($sql);
        $array["keywords"] = [];
        while ($karray = $kresult->fetch_assoc()) {
            array_push($array["keywords"], $karray["title"]);
        }

        $jsonData[] = $array;
    }

    echo json_encode($jsonData);
}

function getProduct($id) {
    $conn = connect();
    $conn->select_db("credicant");

    $sql = "SELECT * FROM products WHERE products.p_id = " . $id;
    $result = $conn->query($sql);

    $data = $result->fetch_row();
    $sql = "SELECT src FROM pictures WHERE pictures.p_id = " . $id;
    $presult = $conn->query($sql);
    $data["pictures"] = [];
    while ($parray = $presult->fetch_assoc()) {
        array_push($data["pictures"], $parray["src"]);
    }

    $sql = "SELECT title FROM keywords WHERE keywords.p_id = " . $id;
    $kresult = $conn->query($sql);
    $data["keywords"] = [];
    while ($karray = $kresult->fetch_assoc()) {
        array_push($data["keywords"], $karray["title"]);
    }

    return $data;
}

function getOrders() {
    $conn = connect();
    $conn->select_db("credicant");

    $sql = "SELECT * FROM orders";
    $result = $conn->query($sql);

    $jsonData = array();
    while ($array = $result->fetch_assoc()) {
        $sql = "SELECT p_id FROM orderItems WHERE orderItems.o_id = " . $array["o_id"];
        $oresult = $conn->query($sql);
        $array["products"] = [];
        while ($oarray = $oresult->fetch_assoc()) {
            array_push($array["products"], getProduct($oarray["p_id"]));
        }

        $jsonData[] = $array;
    }

    echo json_encode($jsonData);
}
?>