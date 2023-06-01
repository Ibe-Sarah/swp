
<?php
session_start();

$FirstName =  $_SESSION['FirstName'];
$LastName =  $_SESSION['LastName'];
$Email =      $_SESSION['Email'];
$PhoneNumber =  $_SESSION['PhoneNumber'];
$Address =  $_SESSION['Address'];


if(isset($_POST['submit'])){
    $FirstName= $_POST['FirstName'];
    $LastName= $_POST['LastName'];
    $Email= $_SESSION['Email'];
    $PhoneNumber= $_POST['PhoneNumber'];
    $Address= $_POST['Address'];
    
    $conn = new mysqli('localhost', 'root','', 'student-web-app');
    if($conn ->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("update students SET FirstName=?, LastName=?, PhoneNumber=?, Address=? where Email=?");
        $stmt->bind_param("sssss", $FirstName, $LastName,  $PhoneNumber, $Address ,$Email);
        $stmt->execute();
        echo 'Update Successful';
        $stmt->close();
        $conn->close();
    }

}


if(isset($_POST['delete'])){
    $Email= $_SESSION['Email'];
    
    $conn = new mysqli('localhost', 'root','', 'student-web-app');
    if($conn ->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("delete from students where Email=?");
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        echo 'Delete Successful';
        $stmt->close();
        $conn->close();
    }

}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h3>Student Web Based Application
</h3>

<h5> Update your information below</h5>

<form method="post">
    <label for="fname">FirstName</label>
    <input type="text" id="fname"  name="FirstName" value="<?php echo $FirstName?>">

    <label for="lname">LastName</label>
    <input type="text" id="lname" name="LastName" value="<?php echo $LastName?>">

    <label for="email">Email</label>
    <input type="email" id="email" name="Email" value="<?php echo $Email?>" disabled>
    
    <label for="phone">Phone Number</label>
    <input type="tel" id="phone" name="PhoneNumber" value="<?php echo $PhoneNumber?>">
    
    <label for="address">Address</label>
    <input type="text" id="address" name="Address" value="<?php echo $Address?>">
    
<input type="submit" name="submit">
<input type="submit" name="delete" value="delete">
</form>

<style>
    form{
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    input{
        width: 20em;
    }

    body{
        padding-left: 13em;
    }
</style>
</body>
</html>