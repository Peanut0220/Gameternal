<?php
session_start();
//Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: adminLogin.php");
}
require_once "config.php";
$id = $_GET["id"] ?? "";
$sql = "SELECT * FROM event WHERE eventid='$id';";
$result = mysqli_query($mysqli, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row["eventid"];
    $eventname = $row["eventname"];
    $eventdate = $row["eventdate"];
    $eventdesc = $row["eventdesc"];
    $maxperson = $row["maxperson"];
    $price = $row["price"];
}

$eventname_err = $eventdate_err = $eventdesc_err = $maxperson_err = $price_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];
    // Validate fullname
    if (empty(trim($_POST["eventname"]))) {
        $eventname_err = "Please enter an eventname.";
    } elseif (strlen(trim($_POST["eventname"])) > 50) {
        $eventname_err = "Event name Shouldn't exceed 50 characters";
    } else {
        $eventname = $_POST["eventname"];
    }

    if (empty(trim($_POST["eventdate"]))) {
        $eventdate_err = "Please select Event Date.";
    } else {
        $eventdate = $_POST["eventdate"];
    }

    if (empty(trim($_POST["eventdesc"]))) {
        $eventdesc_err = "Please enter news eventdesc.";
    } elseif (strlen(trim($_POST["eventdesc"])) > 400) {
        $eventname_err = "Event name Shouldn't exceed 400 characters";
    } else {
        $eventdesc = $_POST["eventdesc"];
    }

    if (empty(trim($_POST["maxperson"]))) {
        $maxperson_err = "Please enter max person";
    } elseif (strlen(trim($_POST["maxperson"])) < 0) {
        $maxperson_err = "Max person number for event must be greate or equal to 0";
    } else {
        $maxperson = $_POST["maxperson"];
    }

    if (empty(trim($_POST["price"]))) {
        $price_err = "Please enter price";
    } elseif (strlen(trim($_POST["price"])) < 0) {
        $price_err = "Price for event must be greate or equal to 0";
    } else {
        $price = $_POST["price"];
    }

    if (empty($eventname_err) && empty($eventdate_err) && empty($eventdesc_err) && empty($maxperson_err) && empty($price_err)) {
        $sql = "update event SET eventname=?, eventdate=?, eventdesc=?, maxperson=?, price=? where eventid=?;";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("sssidi", $eventname, $eventdate, $eventdesc, $maxperson, $price,$id);
            
            if ($stmt->execute()) {
                echo "<script>alert('Event Successfully updated! Redirecting to Admin Event..');window.location.href='adminEvent.php';</script>";
            } else {
                echo "<script>alert('News was not Successfully updated. Redirecting to Admin Event..');window.location.href='adminEvent.php';</script>";
            }
            $stmt->close();
        }
    }
    $mysqli->close();
}
?>
<!DOCTYPE html>


<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <title>Edit Event</title>

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

            .announce-container {
                margin-bottom: 7%;
                margin-left: 20%;
                margin-right: 20%;
                padding-top: 6%;
            }

            .announce-container fieldset {
                border: none;
            }

            .announce-container fieldset h1 {
                color: white;
                text-transform: uppercase;
                font-size: 40px;
                border-bottom: 4px #0E399E solid;
                display: inline-block;
                margin-bottom: 5%;
            }

            .add-announ fieldset {
                border: none;
            }

            .add-announ h1 {
                font-size: 40px;
                color: white;
                text-transform: uppercase;
            }

            .add-announ {
                background-color: #084298;
                text-align: center;
                border-radius: 30px;
                padding-top: 5%;
                padding-bottom: 5%;
            }

            .add-announ .add-eventname label {
                display:block;
                font-size: 30px;
                width: 30%;
                margin: 0 auto;
                border-bottom: 3.5px black solid;
                text-transform: uppercase;
            }

            .add-announ .add-eventname input {
                margin-top: 3%;
                padding: 0.7%;
                background: #06357a;
                color: white;
                border: 1px #383838 solid;
                border-radius: 6px;
                font-size: 20px;
            }

            .add-announ .add-eventname input:focus {
                outline: none;
            }

            .add-announ .add-description label {
                display: block;
                font-size: 30px;
                width: 25%;
                margin: 0 auto;
                margin-bottom:20px;
                border-bottom: 3.5px black solid;
                text-transform: uppercase;
            }

            .add-announ .add-description textarea {
                padding: 1%;
                background: #06357a;
                color: white;
                font-size: 18px;
                border: 1px #383838 solid;
                border-radius: 10px;
            }

            .add-announ .add-description textarea:focus {
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
    include 'adminNav.php';
    ?>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" >
        <div class="announce-container">
            <fieldset>
                <h1>Edit Event</h1>
                <div class="add-announ">
                    <div class="add-eventname">
                        <label>Event ID</label>
                        <input readonly type="text" id="announTitle" name="id" value="<?php echo $id; ?>"required>
                    </div>
                    <div class="add-eventname">
                        <label>Event Name</label>
                        <input type="text" id="announTitle" name="eventname" class="inputt <?php echo (!empty($eventname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $eventname; ?>"required>
                    </div>
                    <h4 class="invalid-feedback"><?php echo $eventname_err; ?></h4>
                    <div class="add-eventname">
                        <label for="announDesc">Event Date</label>
                        <input type="datetime-local" id="announTitle" name="eventdate" class="<?php echo (!empty($eventdate_err)) ? 'is-invalid' : ''; ?>" value="<?= $eventdate; ?>"required>
                    </div>
                    <h4 class="invalid-feedback"><?php echo $eventdate_err; ?></h4>
                    <div class="add-description">
                        <label>Description</label>
                        <textarea rows="5" cols="60" id="announTitle" name="eventdesc" class="<?php echo (!empty($eventdesc_err)) ? 'is-invalid' : ''; ?>"><?= $eventdesc ?></textarea>
                    </div>
                    <h4 class="invalid-feedback"><?php echo $eventdesc_err; ?></h4>
                    <div class="add-eventname">
                        <label for="announTitle">Max Number</label>
                        <input type="number" id="announTitle" name="maxperson" class="inputt <?php echo (!empty($maxperson_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $maxperson; ?>" required>
                    </div>
                    <h4 class="invalid-feedback"><?php echo $maxperson_err; ?></h4>

                    <div class="add-eventname"> 
                        <label for="announTitle">Price</label>
                        <input type="number" name="price" id="announTitle" class="<?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>"    >
                    </div>
                    <h4 class="invalid-feedback"><?php echo $price_err; ?></h4>

                </div>
                <div class="submit-cancel">
                    <button type="submit" >Submit</button>
                </div>
            </fieldset>
        </div>
    </form>
</body>
<?php include 'adminFooter.php' ?>
<script>

</script>
</html>
