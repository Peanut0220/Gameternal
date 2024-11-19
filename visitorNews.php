<?php
session_start();
require_once "config.php";

$sql = "SELECT * FROM news;";
$result = mysqli_query($mysqli, $sql);
?>
<!DOCTYPE html>
<style>

    body{
        font-family:"Kanit";
        color:white;
        animation:3s fadeIn;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }
    .content{
        margin-left:8%;
        margin-right:8%;
    }

    .newsTitle{
        display:inline-block;
        border-bottom:10px solid rgb(19, 78, 144);
        margin-top:20px;
        margin-bottom:20px;
    }

    iframe{
        display:block;
        text-align: center;
        margin-left:auto;
        margin-right:auto;
        margin-bottom:70px;
    }
    .content > h3{
        display:inline-block;
        border-bottom:7px solid rgb(19, 78, 144);
    }

    .news-post{
        margin-top:20px;
        margin-bottom:20px;
        display:flex;
        border:1px white;
        border-radius:10px;
        margin-left:8%;
        margin-right:8%;
        position: relative;
        object-fit: cover;
    }

    .news-post img{
        width: 600px;
        height: 350px;
        object-fit: cover;
        margin-right:20px;
        border-radius:20px;
        display:inline-block;
    }

    .news-post news-info {
        display:block;
        float:right;
    }

    .news-post .news-info .news-title{
        font-size:35px;
        display:inline-block;
        line-height:45px;
        height:30%;
    }

    .news-post .news-info .news-detail{
        height:20%;
        display:block;
    }

    .news-post .news-info .news-text{
        font-size:15px;
        height:60%;
        display:inline-block;
    }

    .news-post .news-info .news-date{
        font-size:20px;
        display:inline-block;
    }

    .news-post .news-info .news-game{
        font-size:20px;
        display:flex;
        float:right;
    }

    .news-read{
        display:block;
        text-decoration: none;
        color:white;
        transition:all 0.5s;
        margin-bottom:40px;
        margin-left:1%;
        margin-right:1%;
    }

    .news-read:hover{
        transform: scale(1.02);
        transition:all 0.5s;
    }



</style>    
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gameternal | Next Generation of E-Sport</title>
        <link rel="icon" type="image/x-icon" href="logo2.png"/>
        <script src="https://kit.fontawesome.com/bfb46dc9da.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <?php
            include 'visitorNav.php';
            ?>
        </header>

        <div class="content">
            <h1 class="newsTitle">Week's Highlight</h1>
            <iframe width="921" height="518" src="https://www.youtube.com/embed/KPPPO4-wrkQ?autoplay=1&mute=1" title="Old Man Jankos STILL got it! | Plays of the Week" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <h3>Esport News</h3>
        </div>
        <?php
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while
            ($row = mysqli_fetch_assoc($result)) {
                ?>
                <a href="#" class="news-read">
                    <div class="news-post">
                        <img src="<?= $row["image"] ?>" alt="newsImage">
                        <div class="news-info">
                            <h1 class="news-title"><?= $row["title"] ?></h1>
                            <h3 class="news-text">
                                <?= $row["detail"] ?>
                            </h3>
                            <div class="news-detail">
                                <span class="news-date"><?= $row["date"] ?></span> 
                                <span class="news-game"><?= $row["game"] ?></span> 
                            </div>
                        </div>

                    </div>
                </a>
                <?php
            }
        } else {
            echo "0 results";
        }


        mysqli_close($mysqli);
        ?>





    </body>
    <?php
    include 'visitorFooter.php';
    ?>
</html>


