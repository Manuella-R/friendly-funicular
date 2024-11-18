<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ISP";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists in the database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user data
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Redirect to index.htm
            header("Location: index.html");
            exit; // Make sure to exit after a header redirect
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        echo "<script>alert('User not found.');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            background-color: #2c3e50;
            font-family: 'Arial', sans-serif;
            color: #ecf0f1;
        }
        .login-box {
            width: 300px;
            margin: 100px auto;
            padding: 40px;
            background-color: #34495e;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 6px;
            background-color: #7f8c8d;
            color: #fff;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #1abc9c;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #16a085;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <input type="text" id="username" name="username" placeholder="Username" required><br>
            <input type="password" id="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Login">
        </form>
    </div>

</body>
</html>
