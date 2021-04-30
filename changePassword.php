<?php         
    require("connection.php");
    require("user.php");

    session_start();
    if(isset($_POST) && isset($_SESSION))
    {
        // echo "POST ARRAY:";
        // print_r($_POST);
        // echo "<br>";echo "<br>";echo "<br>";
        $loginInfo = $_SESSION['loginInfo'][0];
        // echo "SESSION ARRAY:";
        // print_r($loginInfo);
        // echo $loginInfo['username'];
        // echo "hello ".$_POST["username"];
        // echo "<br>";echo "<br>";echo "<br>";

        // Try login with current password
        $conn = new SqlConnection();
        $conn->connect();
        $loginVerified = $conn->doLogin($loginInfo['username'], $_POST["current_password"]);

        if (empty($loginVerified)){// wrong password

            $_SESSION['message'] = "Wrong password";

            echo "Could not lotign";            
        }
        else {

            // Try to run update query
            $result = $conn->changePassword($loginInfo['username'], $_POST['new_password']);

            // echo "RESULT ARRAY:";
            // print_r($result);   
            // $_SESSION['username'] = $result

            if (!empty($result)){ // Null result from runQuery, assume duplicate username

                echo "RESULT ARRAY: ";
                print_r($result);
                // $_SESSION['message'] = "Username ".$_POST['new_username']." taken";
                // $_SESSION['message'] = "Username ".$_POST['new_username']." taken";

                // print_r($_SESSION);
                // echo $_SESSION['message'];
                // echo "set";
            }
            else {// successful name change

                // Get login with new credentials
                $conn = new SqlConnection();
                $conn->connect();
                $loginInfo = $conn->doLogin($loginInfo["username"], $_POST["new_password"]);

                // Reset session with new login
                if (!empty($loginInfo)){
                    session_destroy();
                    session_start();
                    $_SESSION['loginInfo'] = $loginInfo;
                    $loginInfo = $_SESSION['loginInfo'][0];
                    // echo "Changed username to: ".$loginInfo['username'];
                    // $_SESSION['message'] = "Changed password to: ".$loginInfo['password'];// DON'T DO THIS
                    $_SESSION['message'] = "Password changed successfully!";
                }

            }
                
        }  
        echo "SESSION ARRAY:";
        print_r($loginInfo);
        echo $_SESSION['message']; // we're sending this back to the previous page
        header("Location: profile.php");  
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