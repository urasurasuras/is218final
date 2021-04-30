<?php         
    require("connection.php");
    require("user.php");

    session_start();
    if(isset($_POST) && isset($_SESSION))
    {
        print_r($_POST);
        echo "<br>";echo "<br>";echo "<br>";
        $loginInfo = $_SESSION['loginInfo'][0];
        // print_r($loginInfo);
        // echo $loginInfo['username'];
        echo "hello ".$_POST["username"];
        echo "<br>";echo "<br>";echo "<br>";


        $conn = new SqlConnection();
        $conn->connect();
        $loginVerified = $conn->doLogin($loginInfo['username'], $_POST["current_password"]);

        if (!empty($loginVerified)){

            $sql = "UPDATE `users` 
                    SET 
                    `password`='".$_POST['new_password']."'
                    
                    WHERE `username`='".$loginInfo['username']."'";
                
            echo $sql;
            echo "<br>";echo "<br>";echo "<br>";
            $conn->runQuery($sql);
        }
        else {

            echo "Could not lotign";
        }
                    //TODO: UPDATE SESSION

    } 
?>

<!-- change all info 
$sql = "UPDATE `users` 
        SET 
        `username`='".$_POST['username']."', 
        `email`='".$_POST['email']."', 
        `password`='".$_POST['password']."', 
        `LastName`='".$_POST['lastName']."', 
        `FirstName`='".$_POST['firstName']."' 
        
        WHERE username='".$loginInfo['username']."'"; -->