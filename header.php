<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css" />
    <script src="https://kit.fontawesome.com/15352f20a2.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav class="navbar">
            <a class"logo" href="home.php"><img src="#" class="logo-img" alt="website logo">
                <h1>TODO List</h1>
            </a>
            <div class="settings">

                <?php
                $loginInfo = $_SESSION['loginInfo'][0];
                // print_r($loginInfo);

                echo "Welcome, ".$loginInfo['FirstName']." ".$loginInfo['LastName'];
?>
                
                <p onclick='toggleNav()' class='settings-btn'><i ></i></p>
                
                <ul id="settings-dropdown" class="settings-content">
                    <li class="nav-item"><a href="profile.php">Edit Profile</a></li>
                    <li class="nav-item"><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>