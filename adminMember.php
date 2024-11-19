<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: adminLogin.php");
    exit;
}
require_once 'config.php';

$sql = "SELECT * FROM member";
$result = mysqli_query($mysqli, $sql);
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/bfb46dc9da.js" crossorigin="anonymous"></script>        
        <title>Member List</title>

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

            .search-box {
                position: absolute;
                transform: translate(-50%,-50%);
                left: 20%;
                top: 30%;
                background-color: #0E114F;
                height: 40px;
                border-radius: 40px;
                padding: 10px;
            }

            .search-box input::placeholder {
                color: gray;
            }

            .search-btn {
                text-decoration: none;
                color: #0E399E;
                float: left;
                width: 40px;
                border-radius: 50%;
                background: #0E114F;
                display: flex;
                justify-content: center;
                align-items: center;
                transition: 0.4s;
                border: none;
            }

            .search-txt {
                background:none;
                outline: none;
                border: none;
                float: right;
                padding: 0;
                color: white;
                font-size: 17px;
                line-height: 20px;
                width: 160px;
            }

            .search-btn i {
                font-size: 20px;
            }

            body {
                font-family: "Kanit";
                background: black;
                color: white;
                animation: 3s fadeIn;
            }

            .container {
                margin-left: 4%;
                margin-right: 4%;
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

            .table-container .table {
                border-collapse: separate;
                border-spacing: 0 1rem;
                background-color: #084298;
                padding: 2%;
                border-radius: 30px;
                width:100%;
            }

            .table-container .table th {
                font-size: 20px;
                padding-bottom: 1.5%;
            }

            .table-container .table td {
                border-bottom: 2.5px black solid;
                font-size: 20px;
                text-align: center;
                padding-bottom: 1%;
            }

            .table-container .table .event:hover {
                transform:scale(1.01);
                transition: 0.3s;
            }

            .table img {
                width: 80px;
                height: 50px;
            }

            .edit {
                cursor:pointer;
            }

            .add-cancel {
                text-align: center;
                margin-top: 4%;
                color: white;
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

            .add-cancel button{
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

            .add-cancel button:hover {
                opacity: 1;
            }
        </style>
    </head>

    <body>
        <?php
        include 'adminNav.php';
        ?>

        <div class="container">
            <form action="adminSearchMember.php" method="POST">
                <div class="search-box">
                    <button class="search-btn" name="submit-search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input name="search" class="search-txt" type="text" placeholder="Search"">
                </div>
            </form>

            <div class="title">
                <h1>Member</h1>
            </div>

            <div class="table-container">
                <table class="table">
                    <tr>
                        <th>Member ID</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>E-mail</th>
                        <th>Phone No.</th>
                        <th>Created At</th>
                    </tr>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr class="event">
                                <td><?= $row["memberid"] ?></td>
                                <td><?= $row["username"] ?></td>
                                <td><?= $row["fullname"] ?></td>
                                <td><?= $row["email"] ?></td>
                                <td><?= $row["phoneno"] ?></td>
                                <td><?= $row["created_at"] ?></td>
                                <td style="text-align: center;">
                                    <a href="adminEditMember.php?id=<?= $row["memberid"] ?>"><i class="fas fa-edit" style="font-size:20px;"></i></a>
                                    <a onClick="return confirm('Confirm to delete ? ');" href="adminDeleteMember.php?id=<?= $row["memberid"] ?>";><i class="fas fa-trash" style="font-size:20px;"></i></a>
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
                <div class="add-cancel">
                    <button type="button" class="add" onclick="location.href = 'adminAddMember.php'">Add</button>
                </div>
            </div>
        </div>
    </body>
    <?php include 'admin_footer.php' ?>
</html>



