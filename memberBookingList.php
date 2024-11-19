 <?php
    session_start();
    //Check if the user is logged in, if not then redirect him to login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: memberLogin.php");
    }
    require_once "config.php";
    $memberid = $_SESSION["memberid"];

    $sql = "SELECT t.ticketid, t.memberid,t.eventid,e.eventname,t.ticketnum, t.registerdate  FROM ticket t, event e WHERE memberid = '$memberid' AND t.eventid = e.eventid GROUP BY t.ticketid, t.memberid,t.eventid,e.eventname,t.ticketnum, t.registerdate";
    $result = mysqli_query($mysqli, $sql);


?>


<!DOCTYPE html>

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

            .bookingList-container{
                color:white;
                margin-left: 8%;
                margin-right: 8%;
                display:block;
            }

            .bookingList-title h1{
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
                width:250px;
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


<html>
    <head>
        <title>Booking List</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="image/logo2.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    </head>

    <header>
        <?php
        $page_title = 'Booking List';
        include 'memberNav.php';
        ?>
    </header>

     
        <div class="bookingList-container">
            <div class="bookingList-title">
                <h1>Booking List</h1>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <td>Ticket ID</td>
                            <td>Member ID</td>
                            <td>Event ID</td>
                            <td>Event Name</td>
                            <td>Ticket Number</td>
                            <td>Register Date</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                       // echo mysqli_num_rows($result) . " result(s)";
                        while
                        ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tbody>
                                <tr>
                                    <td><?= $row["ticketid"] ?></td>
                                    <td><?= $row["memberid"] ?></td>
                                    <td><?= $row["eventid"] ?></td>
                                    <td><?= $row["eventname"] ?></td>
                                    <td><?= $row["ticketnum"] ?></td>
                                    <td><?= $row["registerdate"] ?></td>
                                    <td >
                                         <a href="memberEditBookingList.php?id=<?= $row["ticketid"] ?>"><i class="fas fa-edit" style="font-size:20px;"></i></a>
                                        <a onClick="return confirm('Please confirm deletion');" href="memberDeleteBookingList.php?id=<?= $row["ticketid"] ?>";><i class="fas fa-trash" style="font-size:20px;"></i></a>
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
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <?php
        include 'memberFooter.php';
        ?>
</html>