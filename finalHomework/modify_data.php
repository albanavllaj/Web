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
    $userId = $_POST["userId"];

    // Initialize arrays to store attribute updates
    $updates = array();

    // Check each attribute and add to updates array if set and not empty
    if (isset($_POST["firstname"]) && !empty($_POST["firstname"])) {
        $updates[] = "firstname='" . $_POST["firstname"] . "'";
    }

    if (isset($_POST["lastname"]) && !empty($_POST["lastname"])) {
        $updates[] = "lastname='" . $_POST["lastname"] . "'";
    }

    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $updates[] = "email='" . $_POST["email"] . "'";
    }

    if (isset($_POST["tel"]) && !empty($_POST["tel"])) {
        $updates[] = "telephone='" . $_POST["tel"] . "'";
    }

    if (isset($_POST["password"]) && !empty($_POST["password"])) {
        $updates[] = "password='" . $_POST["password"] . "'";
    }

    // Handle image upload separately
    if (isset($_FILES["image"]["tmp_name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
            $updates[] = "image='$imgContent'";
        }
    }

    // Construct SQL query only if there are updates
    if (!empty($updates)) {
        $sql = "UPDATE userinfo SET " . implode(', ', $updates) . " WHERE id=$userId";

        if ($conn->query($sql) === TRUE) {
            // Fetch the modified data
            $selectSql = "SELECT * FROM userinfo WHERE id=$userId";
            $result = $conn->query($selectSql);

            if ($result->num_rows > 0) {
                $modifiedData = $result->fetch_assoc();
                echo json_encode(array('status' => 'success', 'message' => 'Record updated successfully', 'modified_data' => $modifiedData));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Error fetching modified record'));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error updating record: ' . $conn->error));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'No fields to update'));
    }
}

$conn->close();
?>
