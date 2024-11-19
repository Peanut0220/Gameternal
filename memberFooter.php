<?php
//footer.php
?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>

<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }
    @font-face{
        font-family: Kanit;
        src:url("Kanit-Regular.ttf");
    }
    footer{
        font-family:"Kanit";
        font-weight:400;
        background-color: rgb(7, 8, 23);
        padding:40px 0;

    }
    footer .social {
        text-align:center;
        padding-bottom:0px;
        color:white;
    }

    footer .social a{
        font-size:20px;
        color:inherit;
        border:2px solid white;
        width:40px;
        height:40px;
        line-height:38px;
        display:inline-block;
        text-align:center;
        border-radius:50%;
        margin: 0 8px;
        opacity:0.7;
        transition:0.5s;
    }

    footer .social a i{
        font-size:20px;
        
    }

    footer .social a:hover{
        opacity:1;
        transition:0.5s;
    }

    footer ul{
        margin-top:20px;
        padding:0;
        list-style:none;
        font-size:18px;
        line-height:1.6;
        margin-bottom:0;
        text-align:center;
    }
    footer ul li a{
        color:white;
        text-decoration:none;
        opacity:0.8;
    }

    footer ul li{
        display:inline-block;
        padding:0 15px;
    }
    footer ul li a:hover{
        opacity:1;
    }

    footer .copyright{
        margin-top:15px;
        text-align:center;
        font-size:13px;
        color:#aaa;
    }

    .list li a::after {
        content: '';
        width: 0;
        display: block;
        height: 3px;
        margin-top: -1px;
        transition: 0.6s;
    }

    .list li a:hover::after {
        width: 100%;
        background-color: rgb(19, 78, 144);
    }

    #footerImg {
        width:43px;
        height:34px;
        display: block;
        margin-top:0px;
        margin-bottom:25px;
        margin-left: auto;
        margin-right: auto;
    }


</style>

<footer>
    <img src="image/logo2.png" id="footerImg" alt="logo">
    <div class="social">
        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
        <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
        <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
        <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
        <a href="https://www.tiktok.com/"><i class="fab fa-tiktok"></i></a>
        <a href="https://discord.com/"><i class="fab fa-discord"></i></a>
        <a href="https://www.twitch.tv/"><i class="fab fa-twitch"></i></a>
    </div>

    <ul class="list">
        <li>
            <a href="memberHome.php">Home</a>
        </li>
        <li>
            <a href="memberBookingList.php">Booking List</a>
        </li>
        <li>
            <a href="memberEvent.php">Event</a>
        </li>
        <li>
            <a href="memberProfile.php">Profile</a>
        </li>
    </ul>
    <p class="copyright">
        &#169; 2022, Gameternal | TARC, All rights reserved
    </p>
</footer>
