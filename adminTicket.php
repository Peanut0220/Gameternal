<?php
session_start();

//Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: adminLogin.php");
}


require_once 'config.php';

$sql = "SELECT T.ticketid, T.memberid, M.username, T.eventid, ticketnum, registerdate FROM ticket T,member M WHERE t.memberid=m.memberid ORDER BY ticketid";
$key = $_POST["search"] ?? "";
$result = mysqli_query($mysqli, $sql);
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/bfb46dc9da.js" crossorigin="anonymous"></script>        
        <title>Ticket List</title>

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
                left: 17%;
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
                margin-left: 7%;
                margin-right: 7%;
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
                border-bottom: 3px black solid;
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

            <form id="search" action="adminSearchTicket.php" method="POST">
                <div class="search-box">
                    <button class="search-btn" name="submit-search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input class="search-txt" name="search" type="text" value="<?= $key ?>" placeholder="Search"">
                </div>
            </form>
            <div class="title">
                <h1>Ticket</h1>
            </div>

            <div class="table-container">
                <table class="table">
                    <tr>
                        <th>Ticket ID</th>
                        <th>Member ID</th>
                        <th>Member Name</th>
                        <th>Event ID</th>
                        <th>Ticket Number</th>
                        <th>Register Date</th>
                    </tr>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr class="event">
                                <td><?= $row["ticketid"] ?></td>
                                <td><?= $row["memberid"] ?></td>
                                <td><?= $row["username"] ?></td>
                                <td><?= $row["eventid"] ?></td>
                                <td><?= $row["ticketnum"] ?></td>
                                <td><?= $row["registerdate"] ?></td>
                                <td style="text-align: center;">
                                    <a href="adminEditTicket.php?id=<?= $row["ticketid"] ?>"><i class="fas fa-edit" style="font-size:20px;"></i></a>
                                    <a onClick="return confirm('Confirm to delete ? ');" href="adminDeleteTicket.php?id=<?= $row["ticketid"] ?>";><i class="fas fa-trash" style="font-size:20px;"></i></a>
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
    </body>
    <?php include 'adminFooter.php' ?>
</html>



