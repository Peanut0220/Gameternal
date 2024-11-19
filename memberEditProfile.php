<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: memberLogin.php");
    exit;
}
require_once 'config.php';
$id = $_GET["id"];
$sql = "SELECT * from member WHERE memberid='$id'";
$result = mysqli_query($mysqli, $sql);

$username = $fullname = $email = $phoneno = $password = "";

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row["memberid"];
    $username = $row["username"];
    $fullname = $row["fullname"];
    $email = $row["email"];
    $phoneno = $row["phoneno"];
}

$username_err = $fullname_err = $email_err = $phoneno_err = $password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST["memberid"];
    // Validate
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter Username.";
    } elseif (strlen(trim($_POST["username"])) > 30) {
        $username_err = "Username Shouldn't exceed 30 characters";
    } else {
        $username = $_POST["username"];
    }

    if (empty(trim($_POST["fullname"]))) {
        $fullname_err = "Please enter full name.";
    } elseif (strlen(trim($_POST["fullname"])) > 30) {
        $fullname_err = "Full Name Shouldn't exceed 30 characters";
    } else {
        $fullname = $_POST["fullname"];
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = $_POST["email"];
    }

    if (empty(trim($_POST["phoneno"]))) {
        $phoneno_err = "Please enter Phone Number";
    } elseif (!preg_match('/^[0]{1}[1]{1}[1-9]{1}-[0-9]{7,8}+$/', trim($_POST["phoneno"]))) {
        $phoneno_err = "Invalid phone number format.";
    } else {
        $phoneno = $_POST["phoneno"];
    }



    if (empty($username_err) && empty($fullname_err) && empty($email_err) && empty($phoneno_err) && empty($password_err)) {
        $sql = "UPDATE member SET
		username='$username',
		fullname='$fullname',
		email='$email',
                phoneno='$phoneno'
		WHERE memberid='$id';";

        if (mysqli_query($mysqli, $sql)) {
            echo
            "<script>alert('Member Information Successfully updated! Redirecting to Member Profile..');window.location.href='memberProfile.php';</script>";
        } else {
            echo
            "<script>alert('Member Information was not Successfully updated. Redirecting to Member Profile..');window.location.href='memberProfile.php';</script>";
        }
    }
    $mysqli->close();
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

    .container{
        padding-top:5%;
        margin-left:8%;
        margin-right:8%;
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

    form{
        width:100%;
    }

    .form-control{
        color: white;
        background-color: transparent;
        border: 3px rgba(0, 0, 255, 0.6) solid;
        border-radius: 20px;
        padding: 10px 20px;
        text-decoration: none;
        transition: all 0.25s;

    }

    .form-control:hover,
    .form-control:focus{
        border: 3px blue solid;
        transition: all 0.25s;
        outline: none;
    }

    .button{
        color: white;
        background-color: transparent;
        border: 3px rgba(0, 0, 255, 0.6) solid;
        border-radius: 20px;
        padding: 10px 20px;
        margin-top: 2%;
        margin-bottom: 2%;
        text-decoration: none;
        transition: all 0.25s;
        cursor: pointer;
    }

    .button:hover,
    .button:focus{
        background-color:blue;
        transition: all 0.25s;
    }

    .mt-3,.insertImg{
        margin-bottom:10px;
    }


</style>
<html>

    <title>Edit Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="image/logo2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

</head>
<body>
    <header>
        <?php
        include 'memberNav.php';
        ?>
    </header>

    <div class="container mt-3">
        <div class="title">
            <h1>Edit Profile</h1>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <div class="mb-3 mt-3">
                <label for="name" >Member ID : </label>
                <input readonly type="text" class="form-control" id="name" value="<?php echo $id; ?>" name="memberid" required>
            </div>
            <div class="mb-3 mt-3">
                <label for="name" >Username : </label>
                <input type="text" class="form-control" id="username" value="<?php echo $username ?>" name="username" required>
            </div>
            <div class="mb-3 mt-3">
                <label for="name" >Full Name : </label>
                <input type="text" class="form-control" id="fullname" value="<?php echo $fullname ?>" name="fullname" required>
            </div>
            <div class="mb-3 mt-3">
                <label for="email" >Email : </label>
                <input type="email" class="form-control" id="email" value="<?php echo $email ?>" name="email" required>
            </div>
            <div class="mb-3 mt-3">
                <label for="phone" >Phone Number : </label>
                <input type="tel" class="form-control" name="phoneno" value="<?php echo $phoneno ?>" required>
            </div>
            <input type="submit" class="button" value="Submit">
        </form>
    </div>
    
</body>
<?php include 'memberFooter.php' ?>
<script>
        var password = document.getElementById("password"),
                confirm_password = document.getElementById("confirm-password");

        function validatePassword() {
            if (password.value !== confirm_password.value) {
                confirm_password.setCustomValidity("Password does not match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }
        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
</html>