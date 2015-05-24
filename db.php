<?php

$dbname = "d01e4dd1";

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'create' : create();break;
        case 'drop' : drop();break;
        case 'recreate' : recreate();break;
        case 'addProduct' : addProduct();break;
        case 'getProducts' : getProducts();break;
        case 'addOrder' : addOrder();break;
        case 'getOrders' : getOrders();break;
        case 'deleteProduct' : deleteProduct();break;
    }
}

function connect() {
/*
    $servername = "www.credicant.com";
    $username = "d01e4dd1";
    $password = "7JPMSXF3AEZEMH6H";
*/

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
    global $dbname;
    $conn = connect();

    $sql = "CREATE DATABASE " . $dbname;
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully" . PHP_EOL;
        $conn->select_db($dbname);

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
            src VARCHAR(256) NOT NULL,
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
            productcount int(255) UNSIGNED,
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
    global $dbname;
    $conn = connect();

    $sql = "DROP DATABASE " . $dbname;
    if ($conn->query($sql) === TRUE) {
        echo "Database dropped successfully" . PHP_EOL;
    } else {
        echo "Error dropping database: " . $conn->error . PHP_EOL;
    }

    $conn->close();
}

function recreate() {
    global $dbname;
    $conn = connect();

    if($conn->select_db($dbname)){
        $sql = "DROP DATABASE " . $dbname;
        if ($conn->query($sql) === TRUE) {
            echo "Database dropped successfully" . PHP_EOL;
            create();
        } else {
            echo "Error dropping database: " . $conn->error . PHP_EOL;
        }
    }else{
        create();
    }

    $conn->close();
}

function addProduct() {
    global $dbname;

    $conn = connect();
    $conn->select_db($dbname);

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

function deleteProduct() {
    global $dbname;

    $conn = connect();
    $conn->select_db($dbname);

    $sql = "DELETE FROM Keywords WHERE Keywords.p_id = " . $_POST["p_id"];
    if ($conn->query($sql) === TRUE) {
        echo "Keywords deleted successfully" . PHP_EOL;
    } else {
        echo "Error deleting from database: " . $conn->error . PHP_EOL;
    }

    $sql = "DELETE FROM Orderitems WHERE Orderitems.p_id = " . $_POST["p_id"];
    if ($conn->query($sql) === TRUE) {
        echo "OrderItems deleted successfully" . PHP_EOL;
    } else {
        echo "Error deleting from database: " . $conn->error . PHP_EOL;
    }

    $sql = "DELETE FROM Pictures WHERE Pictures.p_id = " . $_POST["p_id"];
    if ($conn->query($sql) === TRUE) {
        echo "Pictures deleted successfully" . PHP_EOL;
    } else {
        echo "Error deleting from database: " . $conn->error . PHP_EOL;
    }

    $sql = "DELETE FROM Products WHERE Products.p_id = " . $_POST["p_id"];

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully" . PHP_EOL;
    } else {
        echo "Error deleting from database: " . $conn->error . PHP_EOL;
    }
    $conn->close();
}

function addOrder() {
    global $dbname;
    $conn = connect();
    $conn->select_db($dbname);

    $sql = "INSERT INTO Orders (orderdate, firstname, surname, street, city, postal, mail) VALUES ('" . date("Y-m-d") . "', '" . $_POST["firstname"] . "', '" . $_POST["surname"] . "', '" . $_POST["street"] . "', '" . $_POST["city"] . "', " . $_POST["postal"] . ", '" . $_POST["mail"] . "')";

    if ($conn->query($sql) === TRUE) {
        echo "Order inserted successfully" . PHP_EOL;
        $id = $conn->insert_id;
        foreach($_POST["products"] as $product) {
            $sql = "INSERT INTO OrderItems (productcount, o_id, p_id) VALUES (" . $product['count'] . ", " . $id . ", " . $product['id'] . ")";
            $conn->query($sql);
        }

    } else {
        echo "Error inserting into database: " . $conn->error . PHP_EOL;
    }
    $conn->close();
}

function getProducts() {
    global $dbname;
    $conn = connect();
    $conn->select_db($dbname);

    $sql = "SELECT * FROM Products";
    $result = $conn->query($sql);

    if (is_object($result)) {

        $jsonData = array();
        while ($array = $result->fetch_assoc()) {
            $sql = "SELECT src FROM Pictures WHERE Pictures.p_id = " . $array["p_id"];
            $presult = $conn->query($sql);
            $array["pictures"] = [];
            while ($parray = $presult->fetch_assoc()) {
                array_push($array["pictures"], $parray["src"]);
            }

            $sql = "SELECT title FROM Keywords WHERE Keywords.p_id = " . $array["p_id"];
            $kresult = $conn->query($sql);
            $array["keywords"] = [];
            while ($karray = $kresult->fetch_assoc()) {
                array_push($array["keywords"], $karray["title"]);
            }

            $jsonData[] = $array;
        }

        echo json_encode($jsonData);
    } else {

        echo json_encode(array());
    }
}

function getProduct($id) {
    global $dbname;
    $conn = connect();
    $conn->select_db($dbname);

    $sql = "SELECT * FROM Products WHERE Products.p_id = " . $id;
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();

    $sql = "SELECT src FROM Pictures WHERE Pictures.p_id = " . $id;
    $presult = $conn->query($sql);
    $data["pictures"] = [];
    while ($parray = $presult->fetch_assoc()) {
        array_push($data["pictures"], $parray["src"]);
    }

    $sql = "SELECT title FROM Keywords WHERE Keywords.p_id = " . $id;
    $kresult = $conn->query($sql);
    $data["keywords"] = [];
    while ($karray = $kresult->fetch_assoc()) {
        array_push($data["keywords"], $karray["title"]);
    }

    return $data;
}

function getOrders() {
    global $dbname;
    $conn = connect();
    $conn->select_db($dbname);

    $sql = "SELECT * FROM Orders";
    $result = $conn->query($sql);

    if (is_object($result)) {

        $jsonData = array();
        while ($array = $result->fetch_assoc()) {
            $sql = "SELECT p_id, productcount FROM OrderItems WHERE OrderItems.o_id = " . $array["o_id"];
            $oresult = $conn->query($sql);
            $array["products"] = [];
            while ($oarray = $oresult->fetch_assoc()) {
                $product = new stdClass();
                $product->count = $oarray["productcount"];
                $product->product = getProduct($oarray["p_id"]);
                array_push($array["products"], $product);
            }

            $jsonData[] = $array;
        }

        echo json_encode($jsonData);
    } else {

        echo json_encode(array());
    }
}
?>