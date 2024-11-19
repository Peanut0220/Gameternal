<?php
session_start();

//Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: memberLogin.php");
}
require_once "config.php";

$id = $_GET["id"] ?? "";
$memberid = $_SESSION["memberid"];
$memberid_err = $eventid_err = $qty_err = $registerdate_err = "";
$qty = "";
$sql = "SELECT ticketavail FROM eventstat WHERE eventid= '$id';";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);
$ticketavail = ((int) $row["ticketavail"]);
$decision= $ticketavail<0;
if ($decision==false) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST["id"];
        $ticketavail1 = $_POST["ticketavail"];
        if (empty($_POST["qty"])) {
            $qty_err = "Please select quantity";
        } elseif ($_POST["qty"] < 0) {
            $qty_err = "Quantity must be greater or equal to 1";
        } else {
            $qty = $_POST["qty"];
        }

        if ($_POST["qty"] < $ticketavail1) {
            if (empty($qty_err)) {
                date_default_timezone_set('Asia/Kuala_Lumpur');
                $date = date('Y-m-d H:i:s', time());
                $sql = "INSERT INTO ticket (memberid, eventid, ticketnum, registerdate) VALUES (?, ?, ?, ?)";
                if ($stmt = $mysqli->prepare($sql)) {
                    $stmt->bind_param("ssds", $param_memberid, $param_eventid, $param_ticketnum, $param_registerdate);
                    $param_memberid = $memberid;
                    $param_eventid = $id;
                    $param_ticketnum = $qty;
                    $param_registerdate = $date;
                    if ($stmt->execute()) {
                        // Redirect to login page
                        echo "<script>alert('Booking Added Successfully! Redirecting to Homepage..');window.location.href='memberBookingList.php';</script>";
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    $stmt->close();
                }
            }
            $mysqli->close();
        } else {
            echo "<script>alert('Ticket Quantity has exceed available ticket, please try again.');window.location.href='memberEvent.php';</script>";
        }
    }
} else {
    echo "<script>alert('Ticket Has Already Out of Stock.');window.location.href='memberEvent.php';</script>";
}
?>

<!DOCTYPE html>
<style>
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

    #body {
        color: white;
        width:60%;
        background-color: rgb(0, 0, 0,0.95);
        border-radius: 20px;
        padding: 5%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        margin-left: 15%;
        margin-right:auto;
        margin-bottom: 5%;
    }

    .event-container{
        border: 3px rgba(0, 0, 255, 0.6) solid;
        border-radius: 20px;
        padding: 50px;
        margin-left: 18%;
    }

    .confirmbtn{
        background-color: green;
        color: white;
        padding: 2%;
        margin-left: 25%;
        width: 40%;
        margin-top:2%;
        border-radius: 30px;
        text-decoration: none;
        float:left;
    }

</style>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Seat</title>
        <link rel="shortcut icon" href="image/logo2.png">

        <?php
        include 'memberNav.php';
        ?>

    </head>
    <body>

        <div id="body">
            <div class="event-container">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <label>Event ID</label>
                    <input readonly type="text" id="announTitle" name="id" value="<?php echo $id; ?>"required>
                    <br><br>
                    <label>Ticket Available</label>
                    <input readonly type="text" id="announTitle" name="ticketavail" value="<?php echo$ticketavail; ?>"required>
                    <br><br>
                    <label for="qty">Quantity of ticket wanted: </label>
                    <input type="number" id="qty" name="qty" min="1" max="20" class=""<?php echo (!empty($qty_err)) ? 'is-invalid' : ''; ?> value="<?php echo $qty; ?>" required>
                    <br><br>

                    <button type="submit" class="confirmbtn">CONFIRM</button>
                </form>
            </div>
        </div>
    </body>
    <?php
    include 'memberFooter.php';
    ?>
</html>
