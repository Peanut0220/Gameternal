<!DOCTYPE html>

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

    .about-us-container {
        margin-right: 8%;
        margin-left: 8%;
        padding-bottom: 4%;
        color: white;
    }

    .about-title {
        padding-top: 3%;
    }

    .about-title h1 {
        font-size: 60px;
        text-transform: uppercase;
        border-bottom: 8px rgb(19, 78, 144) solid;
        display: inline-block;
    }


    .content-about-us p {
        margin-top: 3%;
        margin-bottom: 3%;
        font-size: 20px;
        font-weight: normal;
    }

</style>

<html>
    <head>
        <meta charset="UTF-8">
        <title>About Gameternal</title>
        <link rel="icon" type="image/x-icon" href="image/logo2.ico"/>
    </head>
    <body>
        <header>
            <?php include 'visitorNav.php'; ?>
        </header>

        <div class="about-us-container">
            <div class="about-title">
                <h1>About Gameternal</h1>
            </div>
            <div class="content-about-us">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim 
                    veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit 
                    esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>

                <p>
                    Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis 
                    sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. 
                    Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam. Maecenas fermentum consequat mi. Donec fermentum. 
                    Pellentesque malesuada nulla a mi. Duis sapien sem, aliquet nec, commodo eget, consequat quis, neque. Aliquam faucibus, elit ut dictum aliquet, felis nisl 
                    adipiscing sapien, sed malesuada diam lacus eget erat. Cras mollis scelerisque nunc. Nullam arcu. Aliquam consequat. Curabitur augue lorem, dapibus quis, 
                    laoreet et, pretium ac, nisi. Aenean magna nisl, mollis quis, molestie eu, feugiat in, orci. In hac habitasse platea dictumst.
                </p>

                <p>
                    Fusce convallis, mauris imperdiet gravida bibendum, nisl turpis suscipit mauris, sed placerat ipsum urna sed risus. In convallis tellus a mauris. 
                    Curabitur non elit ut libero tristique sodales. Mauris a lacus. Donec mattis semper leo. In hac habitasse platea dictumst. Vivamus facilisis diam at odio. 
                    Mauris dictum, nisi eget consequat elementum, lacus ligula molestie metus, non feugiat orci magna ac sem. Donec turpis. Donec vitae metus. 
                    Morbi tristique neque eu mauris. Quisque gravida ipsum non sapien. Proin turpis lacus, scelerisque vitae, elementum at, lobortis ac, quam. 
                    Aliquam dictum eleifend risus. In hac habitasse platea dictumst. Etiam sit amet diam. Suspendisse odio. Suspendisse nunc. In semper bibendum libero.
                </p>

                <p>
                    Proin nonummy, lacus eget pulvinar lacinia, pede felis dignissim leo, vitae tristique magna lacus sit amet eros. Nullam ornare. 
                    Praesent odio ligula, dapibus sed, tincidunt eget, dictum ac, nibh. Nam quis lacus. Nunc eleifend molestie velit. Morbi lobortis quam eu velit. 
                    Donec euismod vestibulum massa. Donec non lectus. Aliquam commodo lacus sit amet nulla. Cras dignissim elit et augue. Nullam non diam.
                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In hac habitasse platea dictumst. Aenean vestibulum.
                    Sed lobortis elit quis lectus. Nunc sed lacus at augue bibendum dapibus.
                </p>
            </div>
        </div>
    </body>
    <?php include 'visitorFooter.php'; ?>
</html>
