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

        body {
            background-color: black;
            animation: 3s fadeIn;
        }

        @font-face {
            font-family: "Kanit";
            src: url('Kanit-Regular.ttf');
        }


        div {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            top: 30%;
            left: 40%;
            width: 300px;
            height: 300px;
            background: black;
            border-radius: 125px;
            font-family: 'Kanit';
            font-size: 20px;
            font-weight: lighter;
            letter-spacing: 2px;
            transition: 1s box-shadow;
            color: white;
            cursor: pointer;
        }

        div:hover {
            box-shadow: 0 5px 35px 0px rgba(0,0,0,.1);
        }

        div:hover::before, div:hover::after {
            display: block;
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: #fff;
            border-radius: 125px;
            z-index: -1;
            animation: 1s clockwise infinite;
        }

        div:hover:after {
            background: #0E399E;
            animation: 2s counterclockwise infinite;
        }

        @keyframes clockwise {
            0% {
                top: -5px;
                left: 0;
            }
            12% {
                top: -2px;
                left: 2px;
            }
            25% {
                top: 0;
                left: 5px;
            }
            37% {
                top: 2px;
                left: 2px;
            }
            50% {
                top: 5px;
                left: 0;
            }
            62% {
                top: 2px;
                left: -2px;
            }
            75% {
                top: 0;
                left: -5px;
            }
            87% {
                top: -2px;
                left: -2px;
            }
            100% {
                top: -5px;
                left: 0;
            }
        }

        @keyframes counterclockwise {
            0% {
                top: -5px;
                right: 0;
            }
            12% {
                top: -2px;
                right: 2px;
            }
            25% {
                top: 0;
                right: 5px;
            }
            37% {
                top: 2px;
                right: 2px;
            }
            50% {
                top: 5px;
                right: 0;
            }
            62% {
                top: 2px;
                right: -2px;
            }
            75% {
                top: 0;
                right: -5px;
            }
            87% {
                top: -2px;
                right: -2px;
            }
            100% {
                top: -5px;
                right: 0;
            }
        }
    </style>

    <head>
        <title>Start Home Page</title>
    </head>
    <body>
        <div onclick="location.href = 'visitorHome.php'">Start Home Page</div>
    </body>
</html>

