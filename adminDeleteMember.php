<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: adminLogin.php");
}
require_once "config.php";
$id = $_GET["id"] ?? "";

$sql = "DELETE FROM member WHERE memberid='$id';";

if (mysqli_query($mysqli, $sql)) {
    echo "<script>alert('Member Successfully deleted! Redirecting to Member List..');window.location.href='adminMember.php';</script>";
} else {
    echo "<script>alert('Member was not Successfully deleted. Redirecting to Member List..');window.location.href='adminMember.php';</script>";
}

mysqli_close($mysqli);
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Delete Member</title>

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
            }

            .center {
                text-align: center;
                width: 100%;
            }

            .center img {
                width: 17%;
            }

            .table-content {
                background-color: #0E399E;
                border-radius: 20px;
                width: 100%
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

            .staffid-holder label {
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

            input[type="submit"] {
                display: inline-block;
                padding: 8px 12px;
                color: white;
                background-color: #0E399E;
                border: 0;
                cursor: pointer;
                transition: all 300ms ease;
            }
            input[type="reset"] {
                display: inline-block;
                padding: 8px 12px;
                color: white;
                background-color: #0E399E;
                border: 0;
                cursor: pointer;
                transition: all 300ms ease;
            }
            button {
                display: inline-block;
                padding: 8px 12px;
                color: white;
                background-color: #0E399E;
                border: 0;
                cursor: pointer;
                transition: all 300ms ease;
                border-radius: 1rem;
                font-size: .8rem;
                text-decoration: none;
            }
            input[type="submit"]:hover {
                background-color: royalblue;
            }
            input[type="reset"]:hover {
                background-color: royalblue;
            }
            button:hover {
                background-color: royalblue;
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
                margin-left: 3%;
                margin-bottom: 5%;
                border-radius: 18px;
                transition: 0.2s;
                opacity: 0.78;
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
    </body>
    <?php include 'adminFooter' ?>
</html>
