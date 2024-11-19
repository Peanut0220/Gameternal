<?php
session_start();

//Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: memberLogin.php");
}

require_once 'config.php';
$id = $_SESSION["staffid"];
$sql = "SELECT * FROM staff where staffid='$id';";
$result = mysqli_query($mysqli, $sql);
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>

        <style>
            * {
                padding: 0;
                box-sizing: border-box;
            }

            @keyframes fadeIn {
                0% {
                    opacity: 0;
                }
                100% {
                    opacity: 1;
                }
            }

            @font-face {
                font-family: "Kanit";
                src: url('Kanit-Regular.ttf');
            }

            body {
                background-color: black;
                font-family: "Kanit";
                animation: 3s fadeIn;
            }

            .profile-container {
                margin-left: 15%;
                margin-right: 15%;
            }

            .center {
                text-align: center;
            }

            .profile-container h1 {
                font-size: 40px;
                color: white;
                text-transform: uppercase;
                border-bottom: #0E399E 5px solid;
                margin-bottom: 5%;
                display: inline-block;
            }

            .center img {
                width: 15%;
            }

            .info {
                background-color: #084298;
                color: white;
                border-radius: 20px;
            }

            .table-container .table {
                border-collapse: separate;
                border-spacing: 0 1.5rem;
                background-color: #084298;
                padding: 2.5%;
                border-radius: 30px;
                width:100%;
            }
            
            .table-container .table th {
                font-size: 20px;
                font-weight: bolder;
            }

            .table-container .table td {
                font-size: 18px;
                border-bottom: 2.5px black solid;
                padding-bottom: 1%;
                text-align: center;
            }
            
            .table-container .table .list:hover {
                transform:scale(1.01);
                transition: 0.3s;
            }
            
            a{
                color:white;
            }

            i{
                transition:0.5s;
            }
            
            fas{
                font-size: 20px;
            }

            i:hover{
                color:blue;
                transition:0.5s;
            }
            
            .edit-cancel {
                text-align: center;
                margin-top: 4%;
            }

            .edit-cancel button{
                background-color: #06357a;
                padding: 1% 2%;
                border: 1px white solid;
                cursor: pointer;
                font-size: 19px;
                margin-bottom: 5%;
                border-radius: 18px;
                transition: 0.2s;
                opacity: 0.78;
                color: white;
                text-decoration: none;
            }

            .edit-cancel button:hover {
                opacity: 1;
            }
            
        </style>
    </head>
    <body>
        <?php include 'adminNav.php'; ?>

        <div class="profile-container">
            <div class="center">
                <img src="image/avatar_logo.jpg">
            </div>
            <h1>Information</h1>
            <div class="info">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>E-mail</th>
                                <th>Phone No.</th>
                            </tr>
                        </thead>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while
                            ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tbody>
                                    <tr class="list">
                                        <td><?= $row["staffid"] ?></td>
                                        <td><?= $row["username"] ?></td>
                                        <td><?= $row["fullname"] ?></td>
                                        <td><?= $row["email"] ?></td>
                                        <td><?= $row["phoneno"] ?></td>
                                        <td style="text-align: center;">
                                             <a href="adminEditProfile.php?id=<?= $row["staffid"] ?>"><i class="fas fa-edit" style="font-size:20px;"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <?php
                                    }
                                } else {
                                    echo "0 results";
                                }

                                mysqli_close($mysqli);
                                ?>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
    <br><br><br> <br><br><br> <br><br><br>
</body>
<?php include 'adminFooter.php' ?>
</html>
