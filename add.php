<html>

<head>
    <title>User details</title>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="otpenter.css" />
    <style>

    </style>
</head>

<body>
    <form action="add.php" name="otpenters" method="post" onsubmit="update()">
        <div class="container">
            <div class="start">
                <h2 class="title">User details </h2>
                <p id="error"></p>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username" name="name" />
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-envelope"></i>
                    <input class="mail" name="mailid" type="text" placeholder="email">
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-piggy-bank"></i>
                    <input class="ac" name="accountno" type="text" placeholder="Recipient Account Number"><br>
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-piggy-bank"></i>
                    <input class="ac" name="phoneno" type="text" placeholder="Phone number"><br>
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-piggy-bank"></i>
                    <input class="ac" name="pan no" type="text" placeholder="Pancard number"><br>
                </div>
                <div>
                    <p> Gender:&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="gen" type="radio">Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gen">Female<br>
                    </p>
                </div>


                <input class="btn" id="otp" type="submit" class="otpbtn" value="Add" onclick="update()">
                <a href="homepage.html">Back</a>
            </div>
        </div>
    </form>
    >
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
    $mailid = $_POST['mailid'];
    $accountno = $_POST['accountno'];
    $pan_no = $_POST['pan_no'];
    $phoneno = $_POST['phoneno'];
    $name = $_POST['name'];

    // Check if the account number already exists in the table
    $check_sql = "SELECT * FROM userdetails WHERE accountnumber = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $accountno);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // If account number exists, display error message
        echo '<script>alert("Error: Account number already exists."); window.location.href = window.location.href;</script>';
    } else {
        // Prepare and execute the SQL insert statement
        $insert_sql = "INSERT INTO userdetails (name, pancard, phonenumber, email, accountnumber) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ssssi", $name, $pan_no, $phoneno, $mailid, $accountno);

        if ($stmt->execute()) {
            // If insertion is successful, display success message
            echo '<script>alert("Record inserted successfully."); window.location.href = window.location.href;</script>';
        } else {
            // If insertion fails, display error message
            echo '<script>alert("Error inserting record: ' . $stmt->error . '"); window.location.href = window.location.href;</script>';
        }

        // Close statement
        $stmt->close();
    }

    // Close check statement
    $check_stmt->close();
}

// Close connection
$conn->close();
?>