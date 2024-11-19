<?php
session_start();

//Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
 header("location: adminLogin.php");
}
require_once "config.php";

$sql = "SELECT * FROM news;";
$result = mysqli_query($mysqli, $sql);
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <title>News</title>

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

            .announce-container{
                color:white;
                margin-left: 8%;
                margin-right: 8%;
                display:block;
            }

            .announce-title h1{
                display:inline-block;
                border-bottom:7px solid rgb(19, 78, 144);
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


            .imgs{
                width:auto;
                height:150px;
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




            .add-cancel {
                text-align: center;
                margin-top: 4%;

            }

            .add-cancel .perform{
                color: white;
                background-color: transparent;
                border: 3px rgba(0, 0, 255, 0.6) solid;
                border-radius: 30px;
                padding: 10px 20px;
                text-decoration: none;
                font-family: kanit;
                cursor:pointer;
                transition: all 0.5s;
                font-size:20px;
                margin-bottom:20px;
            }





            .add-cancel .perform:hover {
                background-color: rgba(0, 0, 255, 0.6);
                transition: all 0.5s;
            }
        </style>
    </head>

    <body>
        <?php
        include 'adminNav.php';
        ?>
        <div class="announce-container">
            <div class="announce-title">
                <h1>News</h1>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <td>Title</td>
                            <td>Details</td>
                            <td>Date</td>
                            <td>Game</td>
                            <td>Image</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        echo mysqli_num_rows($result)." result(s)";
                        while
                        ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tbody>
                                <tr>
                                    <td><?= $row["title"] ?></td>
                                    <td><?= $row["detail"] ?></td>
                                    <td><?= $row["date"] ?></td>
                                    <td><?= $row["game"] ?></td>
                                    <td><img src="<?= $row["image"] ?>" width="250px" name="imgname" class="imgs"></td>
                                    <td style="text-align: center;">
                                        <a href="adminEditNews.php?id=<?= $row["newsid"] ?>"><i class="fas fa-edit" style="font-size:20px;"></i></a>
                                        <a onClick="return confirm('Please confirm deletion');" href="adminDeleteNews.php?id=<?= $row["newsid"] ?>";><i class="fas fa-trash" style="font-size:20px;"></i></a>
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
            <br><br><br><br><br>
            <div class="add-cancel">
                <button class="perform" type="button" onclick="location.href = 'adminAddNews.php'">Add</button>

            </div>
        </div>
    </body>
    <?php include 'adminFooter.php' ?>
</html>
