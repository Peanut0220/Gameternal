<?php
session_start();
//Check if the user is logged in, if not then redirect him to login page
//if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
//    header("location: memberLogin.php");
//}
require_once "config.php";

$sql = "SELECT * FROM event;";
$result = mysqli_query($mysqli, $sql);
?>

<!DOCTYPE html>
<html>
    <style>
        * {
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: black;
            font-family: "Kanit";
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

        .announce-container{
            color:white;
            margin-left: 8%;
            margin-right: 8%;
            display:block;
        }

        .announce-title h1{
            display:inline-block;
            border-bottom:7px solid rgb(19, 78, 144);
            margin-top: 5%;
        }
        
        .table-container {
            margin-bottom: 7%;
        }
        
        .search-box {
            position: absolute;
            transform: translate(-50%,-50%);
            right: 5%;
            top: 26.5%;
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

        .button{
            color: white;
            background-color: transparent;
            border: 3px rgba(0, 0, 255, 0.6) solid;
            border-radius: 20px;
            padding: 10px 20px;
            display:inline-block;
            margin-left:33%;
            margin-top:10%;
            text-decoration: none;
            cursor:pointer;
            transition: all 0.25s;
        }

        .button:hover{
            background-color: rgba(0, 0, 255, 0.6);
            transition: all 0.25s;
        }

        a{
            text-decoration:none;
        }

        table{
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            width: 100%;
        }

        table th,td{
            padding: 12px 15px;
        }

        table thead tr {
            background-color: rgba(0, 0, 255, 0.6);
            color: #ffffff;
            text-align: left;
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

    </style>


    <head>
        <meta charset="UTF-8">
        <title>Event Details</title>
        <link rel="shortcut icon" href="image/logo2.png">

        <?php
        include 'memberNav.php';
        ?>
    </head>

    <body>

        <div class="announce-container">
            <form action="memberSearchEvent.php" method="POST">
                <div class="search-box">
                    <button class="search-btn" name="submit-search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input name="search" class="search-txt" type="text" placeholder="Search"">
                </div>
            </form>
            <div class="announce-title">
                <h1>Event List</h1>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Date</td>
                            <td>Description</td>
                            <td>Max Person</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        echo mysqli_num_rows($result) . " result(s)";
                        while
                        ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tbody>
                                <tr>
                                    <td><?= $row["eventname"] ?></td>
                                    <td><?= $row["eventdate"] ?></td>
                                    <td><?= $row["eventdesc"] ?></td>
                                    <td><?= $row["maxperson"] ?></td>
                                    <td >
                                        <a href="seat.php?id=<?= $row["eventid"] ?>" class="button">BUY TICKET</a>                                  
                                    </td>
                                </tr>
                                <tr>
                                    <?php
                                }
                            } else {
                                echo "0 result";
                            }


                            mysqli_close($mysqli);
                            ?>
                </table>
                
            </div>
        </div>

    </body>
    <?php
    include 'memberFooter.php';
    ?>

</html>

