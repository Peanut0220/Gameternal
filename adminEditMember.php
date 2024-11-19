<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
 header("location: adminLogin.php");
}
require_once 'config.php';
$id = $_GET["id"] ?? "";
$sql = "SELECT * FROM member WHERE memberid='$id'";
$result = mysqli_query($mysqli, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row["memberid"];
    $username = $row["username"];
    $fullname = $row["fullname"];
    $email = $row["email"];
    $phoneno = $row["phoneno"];
}

$username_err = $fullname_err = $email_err = $phoneno_err = $password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST["id"];
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
    } elseif (strlen(trim($_POST["phoneno"])) > 12) {
        $phoneno_err = "Phone number Shouldn't exceed 12 characters";
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
            "<script>alert('Member Information Successfully updated! Redirecting to Member List..');window.location.href='adminMember.php';</script>";
        } else {
            echo 
            "<script>alert('Member Information was not Successfully updated. Redirecting to Member List..');window.location.href='adminMember.php';</script>";
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
        <title>Edit Member</title>

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

            .memberid-holder label {
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

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
            <div class="table-container">
                <div class="table-content">
                    <div class="profile-address">
                        <h2>Member Details</h2>
                        <div class="profile-detail">
                            <div class="memberid-holder">
                                <label for="memberid">Member ID : </label>
                                <input readonly type="text" id="memberid" name="id" value="<?php echo $id ?>" required>
                            </div>
                            <input type="text" id="userName" name="username" class="inputt <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username ?>" placeholder="Username" required>
                            <input type="text" id="fullName" name="fullname" class="inputt <?php echo (!empty($fullname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fullname ?>" placeholder="Full Name" required>
                            <input type="email" id="mail" name="email" class="inputt <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email ?>" placeholder="E-mail" required>
                            <input type="tel" id="phone" name="phoneno" class="inputt <?php echo (!empty($phoneno_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phoneno ?>" placeholder="Phone No." pattern="[0-9]{3}-[0-9]{7,8}" required>
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
