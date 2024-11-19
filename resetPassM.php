<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: memberHome.php");
    exit;
}
require_once "config.php";

$email = $new_pass = $new_pass_c = "";
$email_err = $new_pass_err = $new_pass_c_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate new password
    if (empty(trim($_POST["new_pass"]))) {
        $new_pass_err = "Please enter the new password.";
    } elseif (strlen(trim($_POST["new_pass"])) < 6) {
        $new_pass_err = "Password must have atleast 6 characters.";
    } else {
        $new_pass = trim($_POST["new_pass"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["new_pass_c"]))) {
        $new_pass_c_err = "Please confirm the password.";
    } else {
        $new_pass_c = trim($_POST["new_pass_c"]);
        if (empty($new_pass_c_err) && ($new_pass != $new_pass_c)) {
            $new_pass_c_err = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if (empty($new_pass_err) && empty($new_pass_c_err) && empty($email_err)) {
        // Prepare an update statement

        $sql = "SELECT memberid, username, password, email FROM member WHERE email = ?";
        $sql1 = "UPDATE member SET password = ? WHERE email = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters

            $stmt->bind_param("s", $param_email);
            $param_email = $email;
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    if ($stmt1 = $mysqli->prepare($sql1)) {
                        // Bind variables to the prepared statement as parameters
                        $stmt1->bind_param("ss", $param_pass, $param_email);

                        $param_email = $email;
                        $param_pass = password_hash($new_pass, PASSWORD_DEFAULT);

                        if ($stmt1->execute()) {
                            // Password updated successfully. Destroy the session, and redirect to login page
                            session_destroy();
                            echo "<script>alert('Password Changed Successfully! Redirecting to Login Page..');window.location.href='memberLogin.php';</script>";
                            exit();
                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    $stmt1->close();
                } else {
                    $email_err = "Invalid email.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $mysqli->close();
}
?>

<style>
    body{
        margin:0;
        padding:0;
        font-family:Verdana,sans-serif;
        background-image:linear-gradient(rgba(0, 0, 0, 0.527),rgba(0, 0, 0, 0.5)) , url("image/gaming2.jpg");
        background-size: cover;
        height:100vh;
        overflow:hidden;
        animation: fadeIn 3s;
        font-family: "Kanit";
    }
    @font-face{
        font-family: Kanit;
        src:url("Kanit-Regular.ttf");
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    .center >.logo2>img{
        width:45px;
        height:34px;
        display: block;
        margin-top:30px;
        margin-left: auto;
        margin-right: auto;

    }
    .center{
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
        width:400px;
        background:#1F1B1D;
        border-radius:40px;

    }
    .center h1{
        text-align:center;
        padding:0 0 5px 0;
        font-weight:lighter;
        color:white;
    }
    .center h3{
        text-align:center;
        font-weight:lighter;
        color:white;
        font-size:14px;
        padding:0 10px 0 10px;
    }
    .center form{
        padding:0 40px;
        box-sizing:border-box;
    }
    form .txt_field{
        position:relative;
        border-bottom:2px solid #adadad;
        margin-top:30px;
        margin-bottom:5px;
    }
    .txt_field input {
        width:100%;
        padding:0 5px;
        height:40px;
        font-size:16px;
        border:none;
        background:none;
        outline:none;
        color:white;
    }
    .txt_field label{
        position:absolute;
        top:50%;
        left:5px;
        color:white;
        transform: translateY(-50%);
        font-size:16px;
        pointer-events:none;
        transition:.5s;
    }
    .txt_field span::before{
        content:'';
        position:absolute;
        top:40px;
        left:0;
        width:0%;
        height:2px;
        background:#2691d9;
        transition:.5s;
    }

    .txt_field > input::placeholder{
        opacity: 0;
        transition: all 0.5s;
    }

    .txt_field > input:focus::placeholder,
    .txt_field > input:hover::placeholder{
        transition: all 1s;
        opacity:1;
    }

    .txt_field input:hover ~ label,
    .txt_field input:focus ~ label,
    .txt_field input:valid ~ label{
        top:-5px;
        color:#0E399E;
    }

    .txt_field input:hover ~span::before,
    .txt_field input:focus ~span::before,
    .txt_field input:valid ~ span::before{
        width:100%;
    }

    a:hover{
        text-decoration:none;
        color:#0E399E;
        transition:all 0.3s ease-in-out;
    }

    input[type="submit"]{
        width:100%;
        height:50px;
        border:3px solid #1F1B1D;
        background:#0E399E;
        border-radius:25px;
        font-size:18px;
        color:#e9f4fb;
        font-weight:lighter;
        cursor:pointer;
        outline:none;
        transition:all 0.3s ;
        margin-top:10px;
        margin-bottom:0px;
        font-family: "Kanit";
    }
    input[type="submit"]:hover{
        border-color:#0E399E;
        transition:all 0.3s ;
    }

    .invalid-feedback{

        color:rgb(220, 20, 60);
        font-size: 12px;
        margin: 0px 0px 0px 5px;

    }
    .signup_link{
        margin:20px 0;
        text-align:center;
        font-size:12px;
        color:#666666;

    }
    .signup_link a{
        color:#2691d9;
        text-decoration:none;
        transition:all 0.3s ease-in-out;
    }
    .signup_link a:hover{
        text-decoration:none;
        color:#0E399E;
        transition:all 0.3s ease-in-out;
    }

</style>


<html>
    <head>
        <meta charset="UTF-8" content="width=device-width, initial-scale=1">
        <title>Gameternal | Game Is Eternal</title>
        <link rel="shortcut icon" href="image/logo2.png">
    </head>
    <body>
        <?php
        include 'loginNav.php';
        ?>
        <div class="center">
            <div class="logo2">
                <img src="image/logo2.png" alt="logo2">
            </div>
            <h1>Forgotten Your Password? Just Reset it!</h1>
            <h3>Enter your new password.</h3>
            <form id="resetPassM" name="resetPassM" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >

                <div class="txt_field">
                    <input name="email" placeholder="xxx@gmail.com" type="email" class="holder <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>"required>
                    <label>Email</label>
                    <span></span>

                </div>
                <h4 class="invalid-feedback"><?php echo $email_err; ?></h4>
                <div class="txt_field">
                    <input type="password" class="<?php echo (!empty($new_pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_pass; ?>" id="password" name="new_pass" placeholder="*********" required>
                    <label>New Password</label> 
                    <span></span>
                </div>
                <h4 class="invalid-feedback"><?php echo $new_pass_err; ?></h4>
                <div class="txt_field">
                    <input type="password" class="form-control <?php echo (!empty($new_pass_c_err)) ? 'is-invalid' : ''; ?>" id="cpassword" name="new_pass_c" placeholder="*********" required>
                    <label>Confirm Password</label>
                    <span></span>
                </div>
                <h4 class="invalid-feedback"><?php echo $new_pass_c_err; ?></h4>

                <input type="submit" name="new_password" value="Change Password">
                <div class="signup_link">
                    <a href="memberLogin.php">I've remember my password</a>
                </div>
            </form>
        </div>
    </body>
</html>
