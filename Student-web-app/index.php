
<?php
session_start();

if(isset($_POST['submit'])){
    $FirstName= $_POST['FirstName'];
    $LastName= $_POST['LastName'];
    $Email= $_POST['Email'];
    $PhoneNumber= $_POST['PhoneNumber'];
    $Address= $_POST['Address'];
    
    $conn = new mysqli('localhost', 'root','', 'student-web-app');
    if($conn ->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into students(FirstName, LastName, Email, PhoneNumber, Address) values(?,?,?,?,?)");
        $stmt->bind_param("sssss", $FirstName, $LastName, $Email, $PhoneNumber, $Address);
        $stmt->execute();
        echo 'Registration Successful';

        $stmt->close();
        $conn->close();
        $_SESSION['FirstName'] = $FirstName;
        $_SESSION['Email'] = $Email;
        $_SESSION['LastName'] = $LastName;
        $_SESSION['PhoneNumber'] = $PhoneNumber;
        $_SESSION['Address'] = $Address;
        header( "refresh:1;url=update.php" );
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

<h5> Register below</h5>

<form method="post">
    <label for="fname">FirstName</label>
    <input type="text" id="fname"  name="FirstName">

    <label for="lname">LastName</label>
    <input type="text" id="lname" name="LastName">

    <label for="email">Email</label>
    <input type="email" id="email" name="Email">
    
    <label for="phone">Phone Number</label>
    <input type="tel" id="phone" name="PhoneNumber">
    
    <label for="address">Address</label>
    <input type="text" id="address" name="Address">
    
<input type="submit" name="submit">

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