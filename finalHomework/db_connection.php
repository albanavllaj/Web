<?php
//
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname= "webprograming";
//// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
//
//// Check connection
//if($conn->connect_error) {
//    die("Connection failed" . $conn->connect_error);
//}
//if($_SERVER["REQUEST_METHOD"] == "POST"){
//    $firstname = $_POST["firstname"];
//    $lastname = $_POST["lastname"];
//    $email = $_POST["email"];
//    $birthdate = $_POST["birthdate"];
//    $gender = $_POST["gender"];
//    $telephone = $_POST["tel"];
//    $password = $_POST["password"];
///**  Here experimenting */
//    $fileName = basename($_FILES["image"]["name"]);
//    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
//
//    // Allow certain file formats
//    $allowTypes = array('jpg','png','jpeg','gif');
//
//    $image = $_FILES['image']['tmp_name'];
//    $imgContent = addslashes(file_get_contents($image));
//
//    $sql = "INSERT INTO userinfo
//    (firstname, lastname, email, birthdate, gender, telephone, password, image)
//    VALUES ('$firstname', '$lastname', '$email', '$birthdate', '$gender', '$telephone', '$password', $imgContent)";
//
//    if ($conn->query($sql) === TRUE) {
//        echo "New record created successfully";
//    } else {
//        echo "Error: " . $sql . "<br>" . $conn->error;
//    }
//
//}

//
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "webprograming";
//// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
//
//// Check connection
//if ($conn->connect_error) {
//    die("Connection failed" . $conn->connect_error);
//}
//
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    $firstname = $_POST["firstname"];
//    $lastname = $_POST["lastname"];
//    $email = $_POST["email"];
//    $birthdate = $_POST["birthdate"];
//    $gender = $_POST["gender"];
//    $telephone = $_POST["tel"];
//    $password = $_POST["password"];
//
//    // Check if the file has been uploaded
//    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
//        $fileName = basename($_FILES["image"]["name"]);
//        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
//
//        // Allow certain file formats
//        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
//
//        // Check if the file type is allowed
//        if (in_array($fileType, $allowTypes)) {
//            $image = $_FILES['image']['tmp_name'];
//            $imgContent = addslashes(file_get_contents($image));
//
//            // Add the image data to the SQL query
//            $sql = "INSERT INTO userinfo
//                    (firstname, lastname, email, birthdate, gender, telephone, password, image, created)
//                    VALUES ('$firstname', '$lastname', '$email', '$birthdate', '$gender', '$telephone', '$password', '$imgContent', NOW())";
//
//            if ($conn->query($sql) === TRUE) {
//                echo json_encode(array('status' => 'success', 'message' => 'New record created successfully'));
//            } else {
//                echo json_encode(array('status' => 'error', 'message' => 'Error: ' . $sql . '<br>' . $conn->error));
//            }
//        } else {
//            echo json_encode(array('status' => 'error', 'message' => 'Invalid file type. Allowed types: jpg, png, jpeg, gif'));
//        }
//    } else {
//        echo json_encode(array('status' => 'error', 'message' => 'Error uploading file.'));
//    }
//}
//
//
////?>



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
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];
    $telephone = $_POST["tel"];
    $password = $_POST["password"];
    $color = $_POST["color"];
    $year = $_POST["year"];

    // Check if the file has been uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        // Check if the file type is allowed
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));

            // Add the image data to the SQL query
            $sql = "INSERT INTO userinfo
                    (firstname, lastname, email, birthdate, gender, telephone, password, image, color, year, created)
                    VALUES ('$firstname', '$lastname', '$email', '$birthdate', '$gender', '$telephone', '$password', '$imgContent', '$color', '$year', NOW())";

            if ($conn->query($sql) === TRUE) {
                //Convert associative array into JSON-formating string
                echo json_encode(array('status' => 'success', 'message' => 'New record created successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Error: ' . $sql . '<br>' . $conn->error));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid file type. Allowed types: jpg, png, jpeg, gif'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error uploading file.'));
    }

    // Process checkboxes and textarea
    if (isset($_POST['car'])) {
        $carPreferences = implode(', ', $_POST['car']);
        $comments = $_POST['comments'];

        // Update the user record with car preferences and comments
        $updateSql = "UPDATE userinfo SET car_preferences='$carPreferences', comments='$comments' WHERE email='$email'";

        if ($conn->query($updateSql) === TRUE) {
            echo json_encode(array('status' => 'success', 'message' => 'Record updated successfully'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error updating record: ' . $conn->error));
        }
    }
}

?>

