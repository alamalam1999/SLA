<?php if (isset($_POST['register'])) {

    // Connect to the database 
    $mysqli = new mysqli("localhost", "username", "password", "login_system");

    // Check for errors 
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Prepare and bind the SQL statement 
    $stmt = $mysqli->prepare("INSERT INTO user (username, fullname, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $fullname, $password);

    // Get the form data 
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];

    // Hash the password 
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Execute the SQL statement 
    if ($stmt->execute()) {
        echo "New account created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the connection 
    $stmt->close();
    $mysqli->close();
}
?>

<form action="register.php" method="post">
    <label for="username">Username:</label>
    <input id="username" name="username" required="" type="text" />
    <label for="fullname">Fullname:</label>
    <input id="fullname" name="fullname" required="" type="fullname" />
    <label for="password">Password:</label>
    <input id="password" name="password" required="" type="password" />
    <input name="register" type="submit" value="Register" />
</form>