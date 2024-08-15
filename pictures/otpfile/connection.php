<?php
$server = "localhost";
$username = "root";
$password = "21mis0204@siteora";
$database = "issproject";
$connection = mysqli_connect("$server","$username","$password");
$select_db = mysqli_select_db($connection, $database);
if(!$select_db)
{
	echo("connection terminated");
}
else {
    echo"hi";
}
?>\
  