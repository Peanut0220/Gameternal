<?php
session_start();
//Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
 header("location: adminLogin.php");
}


require_once "config.php";
$id = $_GET["id"] ?? "";
$sqlimg = "SELECT image FROM news where newsid='$id';";
$resultimg = mysqli_query($mysqli, $sqlimg);
$data = mysqli_fetch_assoc($resultimg);
$oldimgpath = $data["image"];

//Unlink image name
if (!empty($oldimgpath))
    unlink("$oldimgpath");

$sql = "DELETE FROM news WHERE newsid='$id';";

if (mysqli_query($mysqli, $sql)) {
    echo "<script>alert('News Successfully deleted! Redirecting to Admin News..');window.location.href='adminNews.php';</script>";
} else {
    echo "<script>alert('News was not Successfully deleted. Redirecting to Admin News..');window.location.href='adminNews.php';</script>";
}


mysqli_close($mysqli);
?>
<!DOCTYPE html>


<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <title>Edit News</title>

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

            .add-announ .add-title label {
                display:block;
                font-size: 30px;
                width: 15%;
                margin: 0 auto;
                border-bottom: 3.5px black solid;
                text-transform: uppercase;
            }

            .add-announ .add-title input {
                margin-top: 3%;
                padding: 0.7%;
                background: #06357a;
                color: white;
                border: 1px #383838 solid;
                border-radius: 6px;
                font-size: 20px;
            }

            .add-announ .add-title input:focus {
                outline: none;
            }

            .add-announ .add-description label {
                display: block;
                font-size: 30px;
                width: 25%;
                margin: 0 auto;
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

            .fileinput{
                margin-top:20px;
            }

        </style>  
    </style>
</head>

<body>
    <?php
    include 'adminNav.php';
    ?>


</body>
<?php include 'adminFooter.php' ?>
<script>

</script>
</html>


