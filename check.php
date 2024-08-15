<html>

<head>
    <title> hello</title>
</head>
<?php

include "logincheck.php";
if (isset($_POST['username0']) && isset($_POST['Password0'])) {

    if (login($_POST['username0'], $_POST['Password0'])) {
?>
        <script>
            window.location.href = "homepage.html";
        </script>
<?php

    } else {
        echo '<script>alert("Invalid credentials");  window.location.href ="login1.php";</script>';
    }
}

?>

</html>