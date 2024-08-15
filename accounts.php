<html>

<title>Accounts</title>
<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="otpenter.css" />
<link rel="stylesheet" href="account.css" />
<style>

</style>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <?php

                $servername = "localhost";
                $username = "root";
                $password = "gokulraj@2654";
                $database = "web";

                $conn = new mysqli($servername, $username, $password, $database);




                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM userdetails";


                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    echo "<table border='1' cellspacing='0' align='center'>";
                    echo "<tr>";

                    while ($fieldinfo = $result->fetch_field()) {
                        echo "<th>" . $fieldinfo->name . "</th>";
                    }
                    echo "</tr>";


                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";

                        foreach ($row as $value) {
                            echo "<td>" . $value . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }


                $conn->close(); ?>
            </div>
        </div>
        <a href="homepage.html">Back</a>
    </div>
</body>

</html>