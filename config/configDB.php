<?php
$servename = "sql10.freesqldatabase.com:3306";
$username = "sql10294136";
$password = "aYGUndAE8u";
$dbname = "sql10294136";

$conn = new mysqli($servename, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");