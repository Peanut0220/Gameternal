<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: memberLogin.php");
}

require_once 'config.php';

$id = $_SESSION["memberid"];
$sql = "SELECT * FROM member where memberid='$id'";
$result = mysqli_query($mysqli, $sql);
?>

<!DOCTYPE html>
<style>
    body {

        font-family: "Kanit", san-serif;
        background-color:black;
        animation: 2.5s fadeIn;
        color:white;
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

    .container{
        margin-left:8%;
        margin-right:8%;
        display:block;
        text-align:center;
        align-content: center;
    }
    .title h1{
        text-align: center;
        font-size: 52px;
        text-transform: uppercase;
        padding-top: 5%;
        margin-bottom: 4%;
    }

    .title h1::after {
        content: '';
        background-color: #0E399E;
        height: 4px;
        width: 25%;
        margin: 0 auto;
        display: block;
    }
    table{
        width:100%;
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

    .edit button{
        background-color: #06357a;
        padding: 1% 2%;
        border: 1px white solid;
        cursor: pointer;
        font-size: 19px;
        margin-left: 3%;
        margin-bottom: 5%;
        border-radius: 18px;
        transition: 0.2s;
        opacity: 0.78;
        color: white;
    }

    .button:hover{
        background-color: rgba(0, 0, 255, 0.6);
        transition: all 0.25s;
    }
</style>
<html>
    <head>
        <title>Profile</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="image/logo2.png">
    </head>

    <body>
        <header>
            <?php include 'memberNav.php' ?>
        </header>
        <div class="container">
            <div class="title">
                <h1>My Profile</h1>
            </div>

            <div class="info">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Member ID</th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>E-mail</th>
                                <th>Phone No.</th>
                            </tr>
                        </thead>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tbody>
                                    <tr class="list">
                                        <td><?= $row["memberid"] ?></td>
                                        <td><?= $row["username"] ?></td>
                                        <td><?= $row["fullname"] ?></td>
                                        <td><?= $row["email"] ?></td>
                                        <td><?= $row["phoneno"] ?></td>
                                        <td style="text-align: center;">
                                            <a href="memberEditProfile.php?id=<?= $row["memberid"] ?>"><i class="fas fa-edit" style="font-size:20px;"></i></a>
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
            <br>
        </div>
    </body>
    <?php include 'memberFooter.php' ?>
</html>

