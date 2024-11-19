<html>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: black;
            font-family: "Kanit", san-serif;
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
            background-color: rgb(7, 8, 23);
            padding: 3px 3%;
            position: fixed;
            z-index: 1;
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

        .nav-link li a .fa-solid {
            margin-left: 6px;
        }

        .log-in{
            color: white;
            background-color: transparent;
            border: 3px rgba(0, 0, 255, 0.6) solid;
            border-radius: 20px;
            padding: 10px 20px;
            text-decoration: none;
            transition: all 0.25s;
        }

        .log-in:hover{
            background-color: rgba(0, 0, 255, 0.6);
            transition: all 0.25s;
        }

    </style>

    <head>
        <title>Nav</title>
        <script src="https://kit.fontawesome.com/bfb46dc9da.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <div class="nav-bar">
                <img src="image/logo.png" class="logo" alt="Gameternal" onclick="location.href = 'visitorHome.php'">
                <nav>
                    <ul class="nav-link">
                        <li><a href="visitorHome.php">Home</a></li>
                        <li><a href="visitorGames.php">Games</a></li>
                        <li><a href="visitorAboutUs.php">About Us</a></li>
                        <li><a href="visitorNews.php">News</a></li>
                        <li><a href="visitorFaq.php">FAQs</a></li>
                    </ul>
                </nav>
                <a href="memberOrAdmin.php" class="log-in">Log In</a>
            </div>
        </header>
    </body>
    <script type="text/javascript">
        window.addEventListener("scroll", function() {
            var header = document.querySelector('.nav-bar');
            header.classList.toggle("sticky", window.scrollY > 0);
        });

    </script>
</html>




