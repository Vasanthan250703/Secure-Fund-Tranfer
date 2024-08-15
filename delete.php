<html>

<head>
    <title>Delete account</title>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="otpenter.css" />
    <style>

    </style>
</head>

<body>
    <form action="delete.php" name="otpenters" method="post" onsubmit="update()">
        <div class="container">
            <div class="start">
                <h2 class="title">Delete account </h2>
                <p id="error"></p>


                <div class="input-field">
                    <i class="fa-solid fa-piggy-bank"></i>
                    <input class="ac" name="accountno" type="text" placeholder="Recipient Account Number"><br>
                </div>


                <input class="btn" id="otp" type="submit" class="otpbtn" value="Delete" onclick="update()">
                <a href="homepage.html">Back</a>
            </div>
        </div>
    </form>
</body>

</html>

<?php
// Connection parameters
$servername = "localhost";
$username = "root";
$password = "gokulraj@2654";
$database = "web";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values from the form
    $accountno = $_POST['accountno'];

    // Prepare and execute the SQL select statement to check if the record exists
    $check_sql = "SELECT COUNT(*) FROM userdetails WHERE accountnumber = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $accountno);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($count > 0) {
        // Prepare and execute the SQL delete statement
        $delete_sql = "DELETE FROM userdetails WHERE accountnumber = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $accountno);

        if ($delete_stmt->execute()) {
            echo '<script>alert("Record deleted successfully."); window.location.href = window.location.href;</script>';
        } else {
            echo '<script>alert("Error deleting record: ' . $delete_stmt->error . '"); window.location.href = window.location.href;</script>';
        }

        // Close statement
        $delete_stmt->close();
    } else {
        echo '<script>alert("Record with the given account number does not exist. Please enter a correct number."); window.location.href = window.location.href;</script>';
    }
}

// Close connection
$conn->close();
?>