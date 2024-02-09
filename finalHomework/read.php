<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="assets/styles/registration.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/table.css">

    <!-- Add the link to your external CSS file above -->
</head>
<body>
<!-- Rest of your HTML content -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webprograming";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
echo "<nav>
        <a href='registration.html'>Register</a>
        <a href='read.php'>Read</a>
        <a href='search.html'>Search</a>
        <a href='modify.html'>Modify</a>
        <a href='delete.php.html'>Delete</a>
      </nav>";
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM userinfo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
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
                <th>Created At</th>
                <th>Color</th>
                <th>Year</th>
                <th>Car Preferences</th>
                <th>Comments</th>
                <th>Delete Data</th>
                <th>Modify Data</th>
                
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . ($row["firstname"] ? $row["firstname"] : 'null') . "</td>
                <td>" . ($row["lastname"] ? $row["lastname"] : 'null') . "</td>
                <td>" . ($row["email"] ? $row["email"] : 'null') . "</td>
                <td>" . ($row["birthdate"] ? $row["birthdate"] : 'null') . "</td>
                <td>" . ($row["gender"] ? $row["gender"] : 'null') . "</td>
                <td>" . ($row["telephone"] ? $row["telephone"] : 'null') . "</td>
                <td>" . ($row["password"] ? $row["password"] : 'null') . "</td>
                <td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' height='50' width='50'/></td>
                <td>" . $row["created"] . "</td>
                <td class='color-cell' style='background-color: " . $row["color"] . ";'>" . ($row["color"] ? $row["color"] : 'null') . "</td>
                <td>" . ($row["year"] ? $row["year"] : 'null') . "</td>
                <td>" . ($row["car_preferences"] ? $row["car_preferences"] : 'null') . "</td>
                <td>" . ($row["comments"] ? $row["comments"] : 'null') . "</td>
                <td><a href='delete.php.html'>Delete</a></td>
                <td><a href='modify.html'>Modify</a></td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
</body>
</html>



