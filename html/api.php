<?php
header("Content-Type: application/json");

$servername = "server-of-Bjarni.pxl.bjth.xyz";
$username = "bjarni heselmans";
$password = "BjArNi";
$dbname = "Website_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$request_method = $_SERVER["REQUEST_METHOD"];
switch($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            get_temperature($id);
        } else {
            get_temperatures();
        }
        break;
    case 'POST':
        insert_temperature();
        break;
    case 'PUT':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            update_temperature($id);
        } else {
            echo json_encode(["error" => "ID is missing for update"]);
        }
        break;
    case 'DELETE':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            delete_temperature($id);
        } else {
            echo json_encode(["error" => "ID is missing for delete"]);
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function get_temperatures() {
    global $conn;
    $sql = "SELECT * FROM cpu_temps ORDER BY recorded_at DESC LIMIT 100";
    $result = $conn->query($sql);
    $temps = array();
    while($row = $result->fetch_assoc()) {
        $temps[] = $row;
    }
    echo json_encode($temps);
}

function get_temperature($id) {
    global $conn;
    $sql = "SELECT * FROM cpu_temps WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "Temperature record not found"]);
    }
}

function insert_temperature() {
    global $conn;
    $data = json_decode(file_get_contents('php://input'), true);
    $temperature = $data["temperature"];
    $sql = "INSERT INTO cpu_temps (temperature) VALUES ($temperature)";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Temperature record created successfully"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }
}

function update_temperature($id) {
    global $conn;
    $data = json_decode(file_get_contents('php://input'), true);
    $temperature = $data["temperature"];
    $sql = "UPDATE cpu_temps SET temperature=$temperature WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Temperature record updated successfully"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }
}

function delete_temperature($id) {
    global $conn;
    $sql = "DELETE FROM cpu_temps WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Temperature record deleted successfully"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }
}

$conn->close();
?>
