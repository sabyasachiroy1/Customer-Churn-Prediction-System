<?php
$host ='localhost';
$user='root';
$password="";
$database="churnmeter";
$connection = mysqli_connect($host,$user,$password,$database);
if (!$connection){echo"not";}

 ?>
 <?php
if (isset($_POST['contactbutton'])){
    @$Name =$_POST['name'];
    @$mail = $_POST['email'];
    @$time = $_POST['time'];
    @$message = $_POST['message'];
    @$id=0;
    $staus=0;
   
   $query ="INSERT INTO info VALUES ('$id','$mail','$Name','$message','$time,','$staus')";
   
     $qtodb = mysqli_query($connection,$query);
   
     if (!$qtodb){
         echo "<script> alert ('Technical Issue Occured. Please Try After Some Time'); location.replace('/')</script>";
     }
     else {
       echo "<script> alert ('Thanku For Contacting Us. Our Team Will Reach You Soon');</script>";
       echo "<script>location.replace ('https://shiny-trout-45vgvqw76xqcjjq5-5000.app.github.dev/');</script>";
     }
   
}

 ?>
 <!-- login section -->

 <?php
if (isset($_POST['loginswitchs'])) {
    $uid = $_POST['username'];
    $psd = $_POST['password'];
    $designation = $_POST['role'];
    
    if ($uid == 'admin' && $psd == '5678' && $designation == 'admin') {
        echo "<script>alert('Welcome Admin');</script>";
        echo "<script>location.replace('http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=churnmeter&table=info');</script>";
    } 
    else if ($uid == '1234' && $psd == '1234' && $designation == 'staff') {
        echo "<script>alert('Welcome');</script>";
        echo "<script>location.replace('http://localhost/userdashboar.php');</script>";
        
    }
    else {
        echo "<script> alert('User Not Found'); location.replace('http://localhost/login.html');</script>";
    }

    

}
?>




<?php

 if (isset($_POST['validations'])){
   $rid=$_POST['refids'];

 $q1 = "UPDATE info SET status='1'WHERE id = $rid;";
 $q1todbms = mysqli_query($connection,$q1);
if (!$q1todbms){  

    echo "<script>alert ('Technical Issue Occured, Try After Some Times');</script>";
}
else {
    echo "<script>alert ('Issue Resolved Successfully'); location.replace('http://localhost/userdashboar.php');</script>";  
    
}

 }
?>