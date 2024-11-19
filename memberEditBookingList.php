<?php
session_start();
//Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: memberLogin.php");
}

require_once "config.php";
$id = $_GET["id"] ?? "";
$sql = "SELECT t.ticketid, t.memberid,t.eventid,e.eventname,t.ticketnum, t.registerdate FROM ticket t, event e where ticketid='$id' AND t.eventid = e.eventid GROUP BY t.ticketid, t.memberid,t.eventid,e.eventname,t.ticketnum, t.registerdate";
$result = mysqli_query($mysqli, $sql);
$memberid = $eventid = $eventname = $ticketnum = $registerdate = "";

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row["ticketid"];
    $memberid = $row["memberid"];
    $eventid = $row["eventid"];
    $eventname = $row["eventname"];
    $ticketnum = $row["ticketnum"];
    $registerdate = $row["registerdate"];
}

$ticketid_err = $eventid_err = $eventname_err = $ticketnum_err = $registerdate_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];

    $memberid = $_POST["memberid"];

    $eventid = $_POST["eventid"];

    $eventname = $_POST["eventname"];

    if (empty(trim($_POST["ticketnum"]))) {
        $ticketnum_err = "Please enter ticket number ";
    } elseif (strlen(trim($_POST["ticketnum"])) < 1) {
        $ticketnum_err = "Ticket number for event must be 1 or greater to 1";
    } else {
        $ticketnum = $_POST["ticketnum"];
    }

    $registerdate = $_POST["registerdate"];

    if (empty($ticketnum_err)) {
        $sql = "UPDATE ticket SET
                ticketnum='$ticketnum'
		WHERE ticketid='$id'";
    }
    if (mysqli_query($mysqli, $sql)) {
        echo "<script>alert('Booking List Successfully updated! Redirecting to Booking List..');window.location.href='memberBookingList.php';</script>";
    } else {
        echo "<script>alert('Booking List was not Successfully updated. Redirecting to Booking List..');window.location.href='memberBookingList.php';</script>";
    }
    
}
$mysqli->close();
?>
<!DOCTYPE html>


<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <title>Edit Booking List</title>

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

            .booking-container {
                margin-bottom: 7%;
                margin-left: 20%;
                margin-right: 20%;
                padding-top: 6%;
            }

            .booking-container fieldset {
                border: none;
            }

            .booking-container fieldset h1 {
                color: white;
                text-transform: uppercase;
                font-size: 40px;
                border-bottom: 4px #0E399E solid;
                display: inline-block;
                margin-bottom: 5%;
            }

            .add-booking fieldset {
                border: none;
            }

            .add-booking h1 {
                font-size: 40px;
                color: white;
                text-transform: uppercase;
            }

            .add-booking {
                background-color: #084298;
                text-align: center;
                border-radius: 30px;
                padding-top: 5%;
                padding-bottom: 5%;
            }

            .add-booking .add-eventname label {
                display:block;
                font-size: 30px;
                width: 30%;
                margin: 0 auto;
                border-bottom: 3.5px black solid;
                text-transform: uppercase;
            }

            .add-booking .add-eventname input {
                margin-top: 3%;
                padding: 0.7%;
                background: #06357a;
                color: white;
                border: 1px #383838 solid;
                border-radius: 6px;
                font-size: 20px;
            }

            .add-booking .add-eventname input:focus {
                outline: none;
            }

            .add-booking .add-description label {
                display: block;
                font-size: 30px;
                width: 25%;
                margin: 0 auto;
                margin-bottom:20px;
                border-bottom: 3.5px black solid;
                text-transform: uppercase;
            }

            .add-booking .add-description textarea {
                padding: 1%;
                background: #06357a;
                color: white;
                font-size: 18px;
                border: 1px #383838 solid;
                border-radius: 10px;
            }

            .add-booking .add-description textarea:focus {
                outline: none;
            }

            .submit-cancel {
                text-align: center;
                margin-top: 4%;
            }

            .submit-cancel button{
                color: white;
                background-color: transparent;
                border: 3px rgba(0, 0, 255, 0.6) solid;
                border-radius: 20px;
                padding: 10px 20px;
                text-decoration: none;
                font-family: kanit;
                cursor:pointer;
                transition: all 0.5s;
            }


            .submit-cancel button:hover {
                background-color: rgba(0, 0, 255, 0.6);
                transition: all 0.5s;
            }

            input::file-selector-button {
                color: white;

                padding: 5px 10px 5px 10px;
                background-color: black;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                font-family: kanit;
                transition: all 0.25s;
            }
            input::file-selector-button:hover {

                color:rgba(0, 0, 255, 0.6);
                transition: all 0.5s;
            }

            .invalid-feedback{

                color:rgb(220, 20, 60);
                font-size: 12px;
                margin:0;

            }
            .inputt{
                width:70%;
            }


        </style>  
    </style>
</head>

<body>
    <?php
    include 'memberNav.php';
    ?>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" >
        <div class="booking-container">
            <fieldset>
                <h1>Edit Booking List</h1>
                <div class="add-booking">
                    <div class="add-eventname">
                        <label>Member ID</label>
                        <input readonly type="text" id="announTitle" name="memberid" value="<?php echo $memberid; ?>"required>
                    </div>

                    <div class="add-eventname">
                        <label>Ticket ID</label>
                        <input readonly type="text" id="announTitle" name="id"  value="<?php echo $id; ?>"required>
                    </div>

                    <h4 class="invalid-feedback"><?php echo $ticketid_err; ?></h4>
                    <div class="add-eventname">
                        <label for="announDesc">Event ID</label>
                        <input readonly type="text" id="announTitle" name="eventid" class="<?php echo (!empty($eventid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $eventid; ?>"required>
                    </div>
                    <h4 class="invalid-feedback"><?php echo $eventid_err; ?></h4>
                    <div class="add-description">

                        <div class="add-eventname">
                            <label>Event Name</label>
                            <input readonly type="text" id="announTitle" name="eventname" class="inputt <?php echo (!empty($eventname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $eventname; ?>"required>
                        </div>                      
                        <div class="add-eventname">
                            <label for="announTitle">Ticket Number</label>
                            <input type="number" id="announTitle" name="ticketnum"class="<?php echo (!empty($ticketnum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ticketnum ?>"> 
                        </div>
                        <h4 class="invalid-feedback"><?php echo $ticketnum_err; ?></h4>

                        <h4 class="invalid-feedback"><?php echo $ticketid_err; ?></h4>
                        <div class="add-eventname">
                            <label for="announTitle">Register Date</label>
                            <input readonly type="text" id="announTitle" name="registerdate" class="inputt <?php echo (!empty($registerdate_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $registerdate; ?>" required>
                        </div>
                        <h4 class="invalid-feedback"><?php echo $registerdate_err; ?></h4>



                    </div>
                    <div class="submit-cancel">
                        <button type="submit" >Submit</button>
                    </div>
            </fieldset>
        </div>
    </form>
</body>
<?php include 'memberFooter.php' ?>
<script>

</script>
</html>


