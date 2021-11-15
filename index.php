<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome <?php
            if(isset($_COOKIE["name"]))
            echo $_COOKIE["name"];
        ?>
    </h1>
    <button onclick='document.cookie = "name=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";location.href="login.html"' style="float:right">Logout</button>
    <h3>SEARCH</h3>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        Enter Blood Group: <input type="search" name="search_by_bgroup" id="">
        <input type="submit">
    </form>
    <?php

    if($_SERVER["REQUEST_METHOD"]=="POST" && !isset($_COOKIE["name"])){
        require 'connection.php';
        $aadhar = $_POST["aadhar"];
        $query = "select * from users where aadhar='$aadhar'";
        $result=$conn->query($query);
        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            
            setcookie('name',$row["name"]);
            $conn->close();
        }
        else{
            $conn->close();
            header('location:login.php');
        }
    }
        if(array_key_exists('search_by_bgroup',$_POST)===true){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                require 'connection.php';
                $bgroup = $_POST["search_by_bgroup"];
                $query = "select * from users where bgroup='$bgroup'";
                $result=$conn->query($query);
                if($result->num_rows>0){
                    echo "<table border='1' cellpadding='15'>";
                    echo "<tr><th>Name</th><th>Address</th><th>Phone Number</th></tr>";
                    while($row=$result->fetch_assoc()){
                        echo "<tr><td>".$row["name"]."</td><td>".$row["address"]."</td><td>".$row["phno"]."</td></tr>";
                    }
                    echo "</table>";
                    $conn->close();
                }
            }
        }
    
?> <br>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        Enter Address: <input type="search" name="search_by_address" id="">
        <input type="submit">
    </form>
    <?php
    if(array_key_exists('search_by_address',$_POST)===true){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            require 'connection.php';
            $address = $_POST["search_by_address"];
            $query = "select * from users where address='$address'";
            $result=$conn->query($query);
            if($result->num_rows>0){
                echo "<table border='1' cellpadding='15'>";
                    echo "<tr><th>Name</th><th>Blood Group</th><th>Phone Number</th></tr>";
                while($row=$result->fetch_assoc()){
                    echo "<tr><td>".$row["name"]."</td><td>".$row["bgroup"]."</td><td>".$row["phno"]."</td></tr>";
                }
                echo "</table>";
                $conn->close();
            }
        }
    }
    ?>
</body>
</html>
