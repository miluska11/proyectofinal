<?php
//conexion a la base de datos
try {

$hostname ="localhost";
$username ="root";
$password ="";
$dbname ="login_db";

$mysqli = new mysqli($hostname,$username,$password,$dbname);


} catch(mysqli_sql_exception $e){
    echo "Error: " . $e->getMessage();
}
?>