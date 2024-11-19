<!DOCTYPE html>

<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: memberHome.php");
    exit;
}

require_once "config.php";
$username = $password = "";
$username_err = $password_err = $login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT memberid, username, password FROM member WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["memberid"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: memberHome.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
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
        background-image:linear-gradient(rgba(0, 0, 0, 0.527),rgba(0, 0, 0, 0.5)) , url("image/gaming1.jpg");
        background-size: cover;
        height:100vh;
        overflow:hidden;
        animation: fadeIn 3s;
        font-family:"Kanit";
    }

    @font-face{
        font-family: "Kanit";
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
        margin-top:15px;
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
        padding:0 0 20px 0;
        font-weight:lighter;
        color:white;
    }
    .center form{
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
        border:3px solid #1F1B1D;
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
        border-color:#0E399E;
        transition:all 0.3s ;
    }

    .signup_link{
        margin:20px 0;
        text-align:center;
        font-size:16px;
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
    
    .alert-danger{
        position:absolute;
        display:inline-block;
        right:43%;
        color:white;
        padding:10px;
        background:#A61313;
        border-radius:40px;
        top:10%;
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
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        <div class="center">
            <div class="logo2">
                <img src="image/logo2.png" alt="logo2">
            </div>
            <h1>LOGIN</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                <div class="txt_field">
                    <input type="text" name="username" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" required>
                    <label>Username</label>
                     <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
                <div class="txt_field">
                    <input id="myInput" name="password" type="password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?> required>
                    <label>Password</label><i id="icon" class="fa-solid fa-eye" onclick="myFunction()"></i>
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="pass"> 
                    <a href="resetPassM.php">Forgot Password?</a>
                </div>
                <input type="submit" value="Login">
                <div class="signup_link">
                    Not a member? <a href="memberRegister.php">Register</a>
                </div>
            </form>
        </div>

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
