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
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security

    // Insert the user into the database
    $sql = "INSERT INTO users (username, email, phone, dob, password) 
            VALUES ('$username', '$email', '$phone', '$dob', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User registered successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <style>
        body {
            background: linear-gradient(135deg, #f06, #4a90e2);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
        }
        .signup-container {
            width: 400px;
            margin: 100px auto;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        input[type="text"], input[type="password"], input[type="email"], input[type="tel"], input[type="date"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            font-size: 14px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #34c759;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #28a745;
        }
    </style>
</head>
<body>

    <div class="signup-container">
        <h2>Sign Up Now</h2>
        <form method="POST" action="signup.php">
            <input type="text" id="username" name="username" placeholder="Username" required><br>
            <input type="email" id="email" name="email" placeholder="Email" required><br>
            <input type="tel" id="phone" name="phone" placeholder="Phone Number" required><br>
            <input type="date" id="dob" name="dob" required><br>
            <input type="password" id="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Signup">
        </form>
    </div>

</body>
</html>
