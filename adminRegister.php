<!DOCTYPE html>
<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $fullname = $email = $phoneno = "";
$username_err = $password_err = $fullname_err = $email_err = $phoneno_err = "";


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT staffid FROM staff WHERE username = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // store result
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validate fullname
    if (empty(trim($_POST["fullname"]))) {
        $fullname_err = "Please enter your name.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", trim($_POST["fullname"]))) {
        $fullname_err = "Name can only contains letters";
    } else {
        $fullname = $_POST["fullname"];
    }

    // Validate email
    $email = trim($_POST["email"]);
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email Format";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate phoneno
    if (empty(trim($_POST["phoneno"]))) {
        $phoneno_err = "Please enter your phone number.";
    } elseif (!preg_match('/^[0]{1}[1]{1}[1-9]{1}-[0-9]{7,8}+$/', trim($_POST["phoneno"]))) {
        $phoneno_err = "Invalid phone number format.";
    } else {
        $phoneno = trim($_POST["phoneno"]);
    }


    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }



    // Check input errors before inserting in database
    if (empty($username_err) && empty($fullname_err) && empty($email_err) && empty($phoneno_err) && empty($password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO staff (username, fullname, email, phoneno, password) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_username, $param_fullname, $param_email, $param_phoneno, $param_password);

            // Set parameters
            $param_username = $username;
            $param_fullname = $fullname;
            $param_email = $email;
            $param_phoneno = $phoneno;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                echo "<script>alert('Account Registered Successfully! Redirecting to Login Page..');window.location.href='adminLogin.php';</script>";
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }





    $mysqli->close();
}
?>

<style>
    body{
        margin:0;
        padding:0;
        font-family:"Kanit";
        background-image:linear-gradient(rgba(0, 0, 0, 0.527),rgba(0, 0, 0, 0.5)) , url("image/gamer1.jpg");
        background-size: cover;
        height:100vh;
        overflow:hidden;
        animation: fadeIn 3s;
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

    .sentence{
        color:white;
        position:absolute;
        top:40%;
        left:5%;
        margin-left: auto;
        margin-right: auto;
        display:block;
    }

    .sentence > h1{
        font-weight:lighter;
    }

    .sentence > h1>span{
        font-size:50px;
    }

    .sentence > h3{
        font-weight:lighter;
        line-height: 25px;
    }

    .right >.logo2>img{
        width:45px;
        height:34px;
        display: block;
        margin-top:15px;
        margin-left: auto;
        margin-right: auto;

    }
    .right{
        margin-left: auto;
        margin-right: auto;
        display:block;
        position:absolute;
        top:50%;
        left:80%;
        transform:translate(-50%,-50%);
        width:400px;
        background-color:transparent;
        border-radius:40px;

    }
    .right h1{
        text-align:center;
        padding:0 0 20px 0;
        font-weight:lighter;
        color:white;
    }
    .right form{
        padding:0 40px;
        box-sizing:border-box;
    }
    form .txt_field{
        position:relative;
        border-bottom:2px solid #adadad;
        margin: 30px 0;
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

    .pass>a{
        font-size:13px;
        text-decoration:none;
        color:white;
        transition:all 0.3s ease-in-out;
    }

    .pass{
        margin:0px 0px 15px 0px;
        color: white;
        cursor:pointer;
        display:inline-block;

    }

    a:hover{
        text-decoration:none;
        color:#0E399E;
        transition:all 0.3s ease-in-out;
    }

    input[type="submit"]{
        width:100%;
        height:50px;
        border:1px solid #0E399E;
        background:#0E399E;
        border-radius:25px;
        font-size:18px;
        color:#e9f4fb;
        font-weight:700;
        cursor:pointer;
        outline:none;
        transition:all 0.3s ;
        font-family: "Kanit";

    }
    input[type="submit"]:hover{
        background:#0F1E69;
        transition:all 0.3s ;
    }

    .signup_link{
        margin:20px 0;
        text-align:center;
        font-size:14px;
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

    i{
        position:absolute;
        color:white;
        right:0%;
        top:40%;
        cursor:pointer;
    }

</style>

<html>
    <head>
        <meta charset="UTF-8" content="width=device-width, initial-scale=1">
        <title>Gameternal | Game Is Eternal</title>
        <link rel="shortcut icon" href="image/logo2.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    </head>
    <body>
        <?php
        include 'adminLoginNav.php';
        ?>
        <div class="sentence">
            <h1>JOIN OUR TEAM NOW TO SUPPORT THE <br> <span>GAMETERNAL</span></h1>
            <h3>We care about gamers, we provide daily gaming news, we manage members profile,<br>most importantly we provide an eternal society for our gamers.
                <br>Engage with us and we will build a stronger society together.</h3>
        </div>
        <div class="right">
            <div class="logo2">
                <img src="image/logo2.png" alt="logo2">
            </div>
            <h1>Join The Community</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="txt_field">
                    <input type="text" name="username" class="<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" required>
                    <label>Username</label>
                    <span></span>

                </div>
                <h4 class="invalid-feedback"><?php echo $username_err; ?></h4>

                <div class="txt_field">
                    <input type="text" name="fullname" class="<?php echo (!empty($fullname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fullname; ?>" required>
                    <label>Fullname</label>
                    <span></span>

                </div>
                <h4 class="invalid-feedback"><?php echo $fullname_err; ?></h4>

                <div class="txt_field">
                    <input name="email" placeholder="xxx@gmail.com" type="email" class="holder <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>"required>
                    <label>Email</label>
                    <span></span>

                </div>
                <h4 class="invalid-feedback"><?php echo $email_err; ?></h4>

                <div class="txt_field">
                    <input name="phoneno" type="tel" placeholder="012-34567890" class="holder <?php echo (!empty($phoneno_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phoneno; ?>" required>
                    <label>Phone No.</label>
                    <span></span>

                </div>
                <h4 class="invalid-feedback"><?php echo $phoneno_err; ?></h4>

                <div class="txt_field">
                    <input id="myInput" name="password" type="password" class="<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" required>
                    <label>Password</label><i id="icon" class="fa-solid fa-eye" onclick="myFunction()"></i>
                    <span></span>

                </div>
                <h4 class="invalid-feedback"><?php echo $password_err; ?></h4>

                <input type="submit" value ="Create" >
                <div class="signup_link">
                    Already have an Account? <a href="adminLogin.php">Back to Login</a>
                </div>
        </div>

    </form>

    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            var i = document.getElementById("icon");
            if (x.type === "password") {
                x.type = "text";
                i.className = "fa-solid fa-eye-slash";
            } else {
                x.type = "password";
                i.className = "fa-solid fa-eye";
            }
        }

    </script>
</body>
</html>

