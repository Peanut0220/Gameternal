<?php
session_start();

//Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: adminLogin.php");
}

require_once 'config.php';

$id = $_GET["id"] ?? "";
$sql = "SELECT * FROM ticket WHERE ticketid='$id'";

$result = mysqli_query($mysqli, $sql);

$memberid = $eventid = $ticketnum = $registerdate = "";

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row["ticketid"];
    $memberid = $row["memberid"];
    $eventid = $row["eventid"];
    $ticketnum = $row["ticketnum"];
    $registerdate = $row["registerdate"];
}

$memberid_err = $eventid_err = $ticketnum_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST["id"];
// Validate
    if (empty(trim($_POST["memberid"]))) {
        $memberid_err = "Please enter Member ID.";
    } elseif (strlen(trim($_POST["memberid"])) > 10) {
        $memberid_err = "Member Name Shouldn't exceed 30 characters";
    } else {
        $memberid = $_POST["memberid"];
    }

    if (empty(trim($_POST["eventid"]))) {
        $eventid_err = "Please enter Event ID.";
    } elseif (strlen(trim($_POST["eventid"])) > 10) {
        $eventid_err = "Event ID Shouldn't exceed 10 characters";
    } else {
        $eventid = $_POST["eventid"];
    }

    if (empty(trim($_POST["ticketnum"]))) {
        $ticketnum_err = "Please enter ticket number.";
    } elseif (strlen(trim($_POST["ticketnum"])) > 10) {
        $ticketnum_err = "Ticket Number Shouldn't exceed 10 characters";
    } else {
        $ticketnum = $_POST["ticketnum"];
    }

    if (empty($memberid_err) && empty($eventid_err) && empty($ticketnum_err)) {
        $sql = "UPDATE ticket SET
                memberid='$memberid',
                eventid='$eventid',
                ticketnum='$ticketnum'
                WHERE ticketid='$id'";  
    }
    if (mysqli_query($mysqli, $sql)) {
        echo
        "<script>alert('Ticket Information Successfully updated! Redirecting to Ticket List..');window.location.href='adminTicket.php';</script>";
    } else {
        echo
        "<script>alert('Ticket Information was not Successfully updated. Redirecting to Ticket List..');window.location.href='adminTicket.php';</script>";
    }
}
$mysqli->close();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Ticket</title>

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

            .table-container {
                margin-left: 20%;
                margin-right: 20%;
                padding-top: 5%;
            }

            .table-content {
                background-color: #0E399E;
                border-radius: 20px;
                width: 100%;
                padding-top: 2%;
            }

            .table-content h2 {
                text-transform: uppercase;
                font-size: 30px;
            }

            .table-content h2::after {
                content: '';
                display: block;
                height: 2px;
                background-color: black;
                width: 40%;
                margin: 0 auto;
            }

            .ticketid-holder label {
                font-size: 25px;
            }

            .memberid-holder label {
                font-size: 25px;
            }

            .registerdate-holder label {
                font-size: 25px;
            }

            .input-field label {
                font-size: 25px;
            }

            .profile-address {
                padding-top: 2%;
                padding-bottom: 3%;
                text-align: center;
            }

            .profile-detail {
                vertical-align: middle;
                width: 80%;
                margin: 0 auto;
            }

            .profile-detail input, select{
                margin: 2%;
                color: white;
                background: transparent;
                padding-left: 0;
                padding-top: 0.5%;
                padding-bottom: 0.5%;
            }

            .profile-detail input {
                border: none;
                border-bottom: 2px #2077a1 solid;
                font-size: 19px;
                color: white;
                margin: 4%;
                padding-top: 1%;
                padding-left: 1%;
                box-shadow: 0 0 2px black;
            }

            .profile-detail input::placeholder {
                color: black;
            }

            .profile-detail input:focus::placeholder {
                color: transparent;
            }

            .profile-detail input:focus {
                outline: none;
                border-bottom: 2px #0c63e4 solid;
                transition: all 0.2s ease;
            }

            .submit-reset {
                text-align: center;
                margin-top: 4%;
                color: white;
            }

            .submit-reset button{
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

            .submit-reset button:hover {
                opacity: 1;
            }

        </style>
    </head>
    <body>
        <?php
        include 'adminNav.php';
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <div class="table-container">
                <div class="table-content">
                    <div class="profile-address">
                        <h2>Ticket Details</h2>
                        <div class="profile-detail">
                            <div class="ticketid-holder">
                                <label for="memberid">Ticket ID : </label>
                                <input readonly type="text" id="ticketid" name="id" value="<?php echo $id ?>" required>
                            </div>
                            <div class="registerdate-holder">
                                <label for="registerdate">Register Date : </label>
                                <input readonly type="text" id="registerdate" name="registerdate" value="<?php echo $registerdate ?>" placeholder="Register Date" required>
                            </div>
                            <div class="input-field">
                                <div class="memberid-holder">
                                    <label for="memberid">Member ID : </label>
                                    <input type="text" id="memberid" name="memberid" value="<?php echo $memberid ?>" required>
                                </div>
                                <div class="eventid-holder">
                                    <label for="eventid">Event ID : </label>
                                    <input type="text" id="eventid" name="eventid" class="inputt <?php echo (!empty($eventid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $eventid ?>" placeholder="Username" required>
                                </div>
                                <div class="ticketnum-holder">
                                    <label for="ticketnum">Ticket Number : </label>
                                    <input type="text" id="ticketnum" name="ticketnum" class="inputt <?php echo (!empty($ticketnum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ticketnum ?>" placeholder="Ticket Number" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="submit-reset">
                <button type="submit">Submit</button>
            </div>
        </form>

    </body>
    <?php include 'admin_footer.php' ?>
    <script>
    </script>
</html>
