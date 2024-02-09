
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webprograming";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deleteUserId = $_POST["deleteUserId"];

    // Delete the user from the database
    $sql = "DELETE FROM userinfo WHERE id = $deleteUserId";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 'success', 'message' => 'User deleted successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error deleting user: ' . $conn->error));
    }
}

$conn->close();
?>
