<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 style="text-align: center;">Blood Donation</h1>
    <button onclick="location='login.html';"  style="float: right;padding: 13px;"><b>Login</b></button>
    <br>
    <br>
    <center>
        <br>
        <h3>Registration</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <br>
            <br>
            Enter your Name: <input type="text" name="name" id="" required>
            <br>
            <br>
            Enter your Aadhar Number: <input type="text" name="aadhar" id="" required>
            <br>
            <br>
            Enter your Blood Group: <input type="text" name="bgroup" id="" required>
            <br>
            <br>
            Enter your Phone Number: <input type="text" name="phno" id="" required>
            <br>
            <br>
            <p>Enter your Address: </p><textarea name="address" id="" cols="50" rows="2" required></textarea>
            <br>
            <br>
            
            <input type="submit">
    
    
        </form>
    </center>
</body>
</html>
<?php 
    if($_SERVER['REQUEST_METHOD']=="POST"){
        require 'connection.php';
        $name=$_POST["name"];
        $aadhar=$_POST["aadhar"];
        $bgroup=$_POST["bgroup"];
        $phno=$_POST["phno"];
        $address=$_POST["address"];
        $query = "insert into users(name,aadhar,bgroup,phno,address) values ('$name','$aadhar','$bgroup','$phno','$address')";
        $result= $conn->query($query);
        if($result===TRUE){
            echo "Registered successfully!";
            $conn->close();
            setcookie('name',$name);
            header('refresh:2;url=index.php');
        }
    }
?>