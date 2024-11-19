<!DOCTYPE html>

<style>
    body{
        background-color:#1F1B1D;
        font-family: Verdana,sans-serif;
        margin:0;
        padding:0;
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

    div{
        align-items: center;
        display:flex;
        justify-content: center;
        margin-top:80px;

    }
    h1{
        font-size: 30px;
        margin-top:200px;
        display:block;
        text-align: center;
        color: white;
        font-weight:lighter;

    }
    span{
        font-size: 30px;
        display:inline-block;
        margin: 15px 25px 10px 25px;
        top: 50%;
        left: 50%;
        color: white;
    }
    .button{
        border-radius:70px;
        border-width: 5px;
        border-color:white;
        background-color:#1F1B1D;
        color: white;
        padding: 45px 90px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 40px;
        cursor: pointer;
        transition: all 0.5s ease-in-out;
        font-family: "Kanit";

    }
    a>.button{
        text-decoration:none;
        color:white;
    }
    #adminbtn:hover{
        background-image:url("image/gamer1.jpg");
        background-size:cover;
        transition: all 0.5s ease-in-out;
        margin-top:-10px;
        margin-bottom:-10px;
        padding:50px 95px;
    }
    


    #memberbtn:hover {
          background-image:url("image/gaming1.jpg");
        background-size:cover;
        transition: all 0.5s ease-in-out;
        margin-top:-10px;
        margin-bottom:-10px;
        padding:50px 95px;
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
        include 'adminLoginNav.php';
        ?>
        <h1>&nbsp;&nbsp;Who are you?</h1>
        <div id="background">
            <a href="memberLogin.php"><button type="button" id="memberbtn" class="button">Member</button></a>
            <span>or</span>
            <a href="adminLogin.php"><button type="button" id="adminbtn" class="button">Admin</button></a>
        </div>

    </body>
</html>
