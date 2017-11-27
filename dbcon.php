<?php
 $servername = "localhost";
//  $username = "sani";
 $username="root";
//  $password = "sani@oxe12";
 $password="";
//  $dbname="sani";
 $dbname="oxedb";
 
 // Create connection
 $conn = new mysqli($servername, $username, $password,$dbname);
 
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 
//  echo "Connected successfully";
?>
