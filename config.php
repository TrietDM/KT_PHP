<?php 
    $conn = mysqli_connect("localhost","root", "","ql_nhansu");
    if(!$conn){
        echo "Database not connected" .mysqli_connect_error() ;
    } 
?>