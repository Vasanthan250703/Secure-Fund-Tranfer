<html>

<head>
    <title>Update account</title>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="otpenter.css" />
    <style>

    </style>
</head>

<body>
    <form action="update.php" name="otpenters" method="post" onsubmit="update()">
        <div class="container">
            <div class="start">
                <h2 class="title">Update account </h2>
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


                <input class="btn" id="otp" type="submit" class="otpbtn" value="Update" onclick="update()">
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
    $mailid = isset($_POST['mailid']) ? $_POST['mailid'] : "";
    $accountno = isset($_POST['accountno']) ? $_POST['accountno'] : "";
    $pan_no = isset($_POST['pan_no']) ? $_POST['pan_no'] : "";
    $phoneno = isset($_POST['phoneno']) ? $_POST['phoneno'] : "";
    $name = isset($_POST['name']) ? $_POST['name'] : "";

    // Prepare and execute the SQL select statement to check if the account number exists
    $stmt_select = $conn->prepare("SELECT * FROM userdetails WHERE accountnumber = ?");
    $stmt_select->bind_param("i", $accountno);
    $stmt_select->execute();
    $result = $stmt_select->get_result();

    // If account number exists, perform update
    if ($result->num_rows > 0) {
        // Prepare and execute the SQL update statement
        $sql = "UPDATE userdetails SET name = IFNULL(?, name), pancard = IFNULL(?, pancard), phonenumber = IFNULL(?, phonenumber), email = IFNULL(?, email) WHERE accountnumber = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $pan_no, $phoneno, $mailid, $accountno);

        if ($stmt->execute()) {
            echo '<script>alert("Record updated successfully."); window.location.href = window.location.href;</script>';
        } else {
            echo '<script>alert("Error updating record: ' . $stmt->error . '"); window.location.href = window.location.href;</script>';
        }

        // Close statement
        $stmt->close();
    } else {
        echo '<script>alert("Account number does not exist."); window.location.href = window.location.href;</script>';
    }

    // Close select statement
    $stmt_select->close();
}

$conn->close();
?>