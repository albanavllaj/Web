<!DOCTYPE html>
<html>
<head>
    <title>Search_users.php</title>
    <link rel="stylesheet" type="text/css" href="assets/styles/registration.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/table.css">
</head>
<body>
</body>
</html>
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
    $searchId = $_POST["searchId"];
    $searchFirstName = $_POST["searchFirstName"];
    $searchLastName = $_POST["searchLastName"];
    $searchGender = $_POST["searchGender"];
    $searchCars = isset($_POST["searchCars"]) ? $_POST["searchCars"] : [];
    $searchComments = $_POST["searchComments"];

    $sql = "SELECT * FROM userinfo 
            WHERE id LIKE '%$searchId%' 
            AND firstname LIKE '%$searchFirstName%' 
            AND lastname LIKE '%$searchLastName%' 
            AND gender LIKE '%$searchGender%'
            AND car_preferences LIKE '%" . implode("%' OR car_preferences LIKE '%", $searchCars) . "%'
            AND comments LIKE '%$searchComments%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Search Results:</h3>
              <a href='search.html'><button class='button-6'>Go to search Menu</button></a><br><br>";
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Birthdate</th>
                    <th>Gender</th>
                    <th>Telephone</th>
                    <th>Password</th>
                    <th>Image</th>
                    <th>Cars</th>
                    <th>Comments</th>
                    <th>Created At</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["firstname"] . "</td>
                    <td>" . $row["lastname"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["birthdate"] . "</td>
                    <td>" . $row["gender"] . "</td>
                    <td>" . $row["telephone"] . "</td>
                    <td>" . $row["password"] . "</td>
                    <td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' height='50' width='50'/></td>
                    <td>" . $row["car_preferences"] . "</td>
                    <td>" . $row["comments"] . "</td>
                    <td>" . $row["created"] . "</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No results found.</p>";
    }
}

$conn->close();
?>
