<?php
header("Content-Type: application/json");

// PostgreSQL connection parameters
$host = "db"; // PostgreSQL container name or IP
$port = "5432";
$dbname = "website_db";
$user = "postgres";
$password = "gfg";

// Connect to PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die(json_encode(["error" => "Connection failed: " . pg_last_error()]));
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
$result = pg_query($conn, $sql);
if ($result) {
    $temps = pg_fetch_all($result);
    echo json_encode($temps);
} else {
    echo json_encode(["error" => "Query failed: " . pg_last_error($conn)]);
}
}

function get_temperature($id) {
global $conn;
$sql = "SELECT * FROM cpu_temps WHERE id=$id";
$result = pg_query($conn, $sql);
if ($result) {
    $row = pg_fetch_assoc($result);
    echo json_encode($row);
} else {
    echo json_encode(["error" => "Temperature record not found"]);
}
}

function insert_temperature() {
global $conn;
$data = json_decode(file_get_contents('php://input'), true);
$temperature = pg_escape_string($data["temperature"]);
$sql = "INSERT INTO cpu_temps (temperature) VALUES ('$temperature')";
$result = pg_query($conn, $sql);
if ($result) {
    echo json_encode(["message" => "Temperature record created successfully"]);
} else {
    echo json_encode(["error" => "Error: " . pg_last_error($conn)]);
}
}

function update_temperature($id) {
    global $conn;
    $data = json_decode(file_get_contents('php://input'), true);
    $temperature = pg_escape_string($data["temperature"]);
    $sql = "UPDATE cpu_temps SET temperature='$temperature' WHERE id=$id";
    $result = pg_query($conn, $sql);
    if ($result) {
        echo json_encode(["message" => "Temperature record updated successfully"]);
    } else {
        echo json_encode(["error" => "Error: " . pg_last_error($conn)]);
    }
}

function delete_temperature($id) {
    global $conn;
    $sql = "DELETE FROM cpu_temps WHERE id=$id";
    $result = pg_query($conn, $sql);
    if ($result) {
        echo json_encode(["message" => "Temperature record deleted successfully"]);
    } else {
        echo json_encode(["error" => "Error: " . pg_last_error($conn)]);
    }
}

pg_close($conn);
?>
