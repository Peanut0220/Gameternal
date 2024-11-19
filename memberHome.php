<!DOCTYPE html>
<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: memberLogin.php");
    exit;
}
?>
<style>
    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: black;
        font-family: "Kanit", san-serif;
        animation: 2.5s fadeIn;
    }

    @font-face {
        font-family: "Kanit";
        src: url('Kanit-Regular.ttf');
    }
    
    .nav-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 6%;
        background-color: rgb(7, 8, 23);
        transition: all 0.13s;
    }

    .sticky {
        background-color: rgb(5, 29, 65);
        padding: 3px 3%;
        position: fixed;
    }

    .logo {
        width: 20%;
        height: 20%;
        background: transparent;
        cursor: pointer;
    }

    .nav-link {
        list-style: none;
    }

    .nav-link li {
        display: inline-block;
        padding: 0px 30px;
        background: transparent;
    }

    .nav-link li a {
        text-decoration: none;
        color: white;
        font-size: 22px;
    }

    .nav-link li a::after {
        content: '';
        width: 0;
        display: block;
        height: 3px;
        margin-top: -1px;
        transition: 0.6s;
    }

    .nav-link li a:hover::after {
        width: 100%;
        background-color: rgb(19, 78, 144);
    }

    .hover-effect li a:hover::after {
        width: 100%;
        background-color: rgb(77, 77, 77);
    }

    .nav-link li a .fa-solid {
        margin-left: 6px;
    }

    .log-in{
        color: white;
        background-color: rgba(0, 0, 255, 1);
        border-radius: 20px;
        padding: 14px;
        text-decoration: none;
    }

    .log-in:hover{
        background-color: rgba(0, 0, 255, 0.6);
        transition: all 0.2s;
    }

    .content {
        overflow: hidden;
    }

    

    .content1 {
        padding-top: 5%;
        margin-left: 8%;
        margin-right: 8%;
    }

    .content1 .content-title {
        display: flex;
        justify-content: space-between;
        background: url(image/gaming3.jpg) no-repeat;
        background-position: right;
        background-size: 50% 100%;
        height: 100vh;
    }

    .content-title .main-title h1{
        color: white;
        font-size: 95px;
        width: 50%;
        overflow-wrap: break-word;
        line-height: 95%;
    }

    .content-title .main-title p {
        font-size: 21px;
        width: 45%;
        overflow-wrap: break-word;
        color: rgb(104, 104, 104);
        margin-top: 4.5%;
    }

    .content1 .content-title .content-image {
        width: 100%;
    }

    .content1 .content-title .content-image img {
        width: 100%;
        height: 100%;
    }
</style>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Gameternal | Game Is Eternal</title>
        <link rel="shortcut icon" href="image/logo2.png">
    </head>
    <body>
        <header>
            <?php
            include 'memberNav.php';
            ?>
        </header>

        <div class="content">
            <div class="content-background">
                <div class="content1">
                    <div class="content-title">
                        <div class="main-title">
                            <h1>Welcome</h1>
                            <h1><?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis assumenda quas suscipit eaque excepturi 
                                incidunt voluptates exercitationem aliquid architecto odio, officia, perferendis ipsum earum eveniet iure 
                                accusantium ad fugiat porro.Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

    </body>
    <?php
    include 'memberFooter.php';
    ?>
</html>
