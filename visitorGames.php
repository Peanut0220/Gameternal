<!DOCTYPE html>

<html>
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

        .game-title {
            color: white;
            margin-left: 8%;
            margin-right: 8%;
            padding-top: 2%;
        }

        .game-title h1 {
            text-align: center;
            text-transform: uppercase;
            font-size: 47px;
        }

        .game-title h1::after {
            content: '';
            display: block;
            height: 5px;
            background-color: rgb(19, 78, 144);
            width: 12%;
            margin: 0 auto;
        }

        .game-container {
            margin-left: 8%;
            margin-right: 8%;
            margin-bottom: 5%;
            display:flex;
        }

        .game-list {

        }

        .list-item {
            margin-top: 3%;
            display: grid;
            grid-auto-columns: 1fr;
            grid-template-columns: 1fr 1fr 1fr;
            grid-row-gap: 2%;
            grid-column-gap: 2%;
        }

        .list-item img {
            max-width: 100%;
            filter: grayscale(100%);
            transition: 0.7s;
        }

        .list-item img:hover {
            filter: grayscale(0%);
            transition: 0.7s;
        }

    </style>

    <head>
    <head>
        <meta charset="UTF-8">
        <title>Games</title>
        <link rel="icon" type="image/x-icon" href="image/logo2.ico"/>
        <script src="https://kit.fontawesome.com/bfb46dc9da.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <?php
            include 'visitorNav.php';
            ?>
        </header>

        <div class="game-title">
            <h1>Games</h1>
        </div>
        <div class="game-container">
            <div class="game-list">
                <div role="list" class="list-item">
                    <a href="https://www.leagueoflegends.com/en-us/"><img src="image/LoL.jpg" alt="League Of Legends"/></a>
                    <a href="https://store.steampowered.com/app/570/Dota_2/"><img src="image/dota2.jpg" alt="Dota 2"/></a>
                    <a href="https://store.steampowered.com/app/730/CounterStrike_Global_Offensive/"><img src="image/cs-go.jpg" alt="CS:GO"/></a>
                    <a href="https://www.ea.com/games/apex-legends/play-now-for-free"><img src="image/apex.jpg" alt="Apex Legends"/></a>
                    <a href="https://store.steampowered.com/app/578080/PUBG_BATTLEGROUNDS/"><img src="image/pubg.jpg" alt="PUBG"/></a>
                    <a href="https://playvalorant.com/en-us/"><img src="image/valorant.jpg" alt="Valorant"/></a>
                </div>
            </div>
        </div>
    </body>
    <?php include 'visitorFooter.php'; ?>
</html>
