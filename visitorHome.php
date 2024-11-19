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

    .content-background {
        background-color: rgb(7, 8, 23) !important;
    }

    .content1 {
        padding-top: 5%;
        margin-left: 8%;
        margin-right: 8%;
    }

    .content1 .content-title {
        display: flex;
        justify-content: space-between;
        background: url(image/play-game.jpg) no-repeat;
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

    .content2 {
        background-color: black !important;
        margin-left: 8%;
        margin-right: 8%;
        color: whitesmoke;
    }

    .content2 .content2-title {
        text-align: center;
        margin-top: 13%;
    }

    .content2 .content2-title h1 {
        font-size: 90px;
        font-weight: normal;

    }

    .content2 .content2-subtitle {
        text-align: center;
    }

    .content2 .content2-subtitle h3 {
        font-size: 35px;
        font-weight: normal;
        text-align: center;
        margin-top: 6%;
    }

    .content2 .content2-subtitle h3::after {
        content: '';
        background-color: white;
        width: 27%;
        margin: 0 auto;
        display: block;
        height: 2px;
        margin-top: 0.5%;
    }

    .member {
        display: flex;
        justify-items: center;
        align-items: center;
        margin-top: 7%;
        margin-bottom: 5%;
    }

    .member .member-list {
        margin: 0 2%;
        background-color: rgb(25, 25, 25);
        border-radius: 3% 3% 0 0;
    }

    .member .member-list h2 {
        text-align: center;
        font-size: 26px;
    }

    .member .member-list h2::after {
        content: '';
        background-color: white;
        width: 36%;
        margin: 0 auto;
        display: block;
        height: 1px;
    }

    .member .member-list p {
        margin-top: 6%;
        padding-left:10px;
        padding-right:10px;
        padding-bottom:10px;
        font-size: 17px;
        font-weight: normal;
        text-align: justify;
        text-justify: inter-word;
    }

    .member .member-list img {
        width: 100%;
        height: 100%;
        border-radius: 3% 3% 0 0;
    }

    .content3 {
        margin-left: 8%;
        margin-right: 8%;
        padding-top: 4%;
        padding-bottom:4%;
    }

    .content3 .title-and-map {
        display: flex;
        justify-content: space-between;
        flex-direction: row-reverse;
    }

    .content3-title {
        color: white;
        width: 50%;
    }

    .content3-title h1 {
        font-size: 60px;
        text-align: center;
    }

    .content3-title h1::after {
        content: '';
        display: block;
        background-color: white;
        height: 3px;
        width: 52.5%;
        margin: 0 auto; /* always in middle*/
    }

    .content3-title .content3-subtitle  {
        width: 90%;
        padding-left: 23%;
        margin-top: 5%;
    }

    .content3-title .content3-subtitle p {
        font-size: 32px;
    }

    .contact-us {
        margin-top: 2%;
    }

    .content3-subtitle .contact-us a {
        margin: 2%;
        text-decoration: none;
        color: white;
        font-weight: normal;
        display:inline-block;
        font-size: 18px;
    }

    .content3-subtitle .contact-us a::after {
        content: '';
        display: block;
        width: 0%;
        height: 3px;
        transition: 0.47s;
        margin-top: 1%;
    }

    .content3-subtitle .contact-us a:hover::after {
        width: 64%;
        background-color: rgb(19, 78, 144);
    }

    .content3-subtitle .contact-us i {
        margin-top: 4%;
    }

    .map {
        width: 50%;
        text-align: center;
    }

    .map iframe {
        border-radius: 11%;
        border: none;
    }

    .content4 {
        margin-right: 8%;
        margin-left: 8%;
        margin-top:3%;
        margin-bottom:3%;
    }

    .content4-title {
        background: url('image/about-us.jpg') no-repeat;
        background-position: right;
        background-size: 40% 100%;
        height: 85vh;
        position: relative;
    }

    .content4-title h1 {
        font-size: 50px;
        color: white;
        position: absolute;
        top: 25%;
        border-bottom: 2px white solid;
    }

    .content4-title button {
        position: absolute;
        top: 50%;
        padding: 1.5% ;
        border-radius: 22px;
        border: 2px white solid;
        background: transparent;
        cursor: pointer;
        overflow: hidden;
    }

    .content4-title a {
        text-decoration: none;
        color: white;
        font-size: 20px;
    }

    .content4-title span {
        background-color: rgb(5, 29, 65);
        height: 100%;
        width: 0;
        border-radius: 22px;
        position: absolute;
        left: 0;
        bottom: 0;
        z-index: -1;
        transition: 0.5s;
    }

    .content4-title button:hover span {
        width: 100%;
    }

    /*top button*/
    #topbtn {
        display: none; /* Hidden by default */
        position: fixed;
        bottom: 100px;
        right: 35px;
        z-index: 99; /* Make sure it does not overlap */
        border: none; /* Remove borders */
        outline: none; /* Remove outline */
        background-color: transparent;
        color: white;
        cursor: pointer; /* Add a mouse pointer on hover */
        padding: 10px;
        border-radius: 75%;
        transition: all 0.5s ease;
    }

    #topbtn:hover{
        padding-bottom:25px;
    }

    /*down button*/
    #downbtn {
        transform:rotate(180deg);
        display: none; /* Hidden by default */
        position: fixed;
        bottom: 45px;
        right: 35px;
        z-index: 99; /* Make sure it does not overlap */
        border: none; /* Remove borders */
        outline: none; /* Remove outline */
        background-color: transparent;
        color: white;
        cursor: pointer; /* Add a mouse pointer on hover */
        padding: 10px;
        border-radius: 75%;
        transition: all 0.5s ease;
        padding-top:20px;
    }

    #downbtn:hover{
        padding-top:0px;
    }

    #arrow {
        font-size:30px;
    }

</style>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Gameternal | Next Generation of E-Sport</title>
        <link rel="icon" type="image/x-icon" href="image/logo2.ico"/>
        <script src="https://kit.fontawesome.com/bfb46dc9da.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <?php
            include 'visitorNav.php';
            ?>
        </header>
        <button onclick="topFunction()" id="topbtn"> <i id="arrow" class="fa-solid fa-chevron-up"></i> </button>
        <button onclick="downFunction()" id="downbtn"> <i id="arrow" class="fa-solid fa-chevron-up"></i></button>
        <div class="content">
            <div class="content-background">
                <div class="content1">
                    <div class="content-title">
                        <div class="main-title">
                            <h1>Play Game Everyday.</h1>
                            <h1>Always Be Winner.</h1>
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis assumenda quas suscipit eaque excepturi 
                                incidunt voluptates exercitationem aliquid architecto odio, officia, perferendis ipsum earum eveniet iure 
                                accusantium ad fugiat porro.Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content2">
                <div class="content2-title">
                    <h1>We Are Not Just Society,</h1>
                    <h1>But We Are Family</h1>
                </div>
                <div class="content2-subtitle">
                    <h3>Actually, Who We Are ?</h3>
                </div>
                <div class="member">
                    <div class="member-list">
                        <img src="image/member1.jpg" alt="Member1"/>
                        <h2>Ng Chong Jian</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                            irure dolor in reprehenderit in voluptate velit esse cillum 
                            dolore eu fugiat nulla pariatur.Lorem ipsum dolor, sit amet consectetur adipisicing elit.

                        </p>
                    </div>
                    <div class="member-list">
                        <img src="image/member2.jpg" alt="Member2"/>
                        <h2>Law Guan Wen</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                            irure dolor in reprehenderit in voluptate velit esse cillum 
                            dolore eu fugiat nulla pariatur.Lorem ipsum dolor, sit amet consectetur adipisicing elit.                        </p>
                    </div>
                    <div class="member-list">
                        <img src="image/member3.jpg" alt="Member3"/>
                        <h2>Tang Qiao Ling</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                            irure dolor in reprehenderit in voluptate velit esse cillum 
                            dolore eu fugiat nulla pariatur.Lorem ipsum dolor, sit amet consectetur adipisicing elit.                        </p>
                    </div>
                    <div class="member-list">
                        <img src="image/member4.jpg" alt="Member4"/>
                        <h2>Wong Bao Yi</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                            irure dolor in reprehenderit in voluptate velit esse cillum 
                            dolore eu fugiat nulla pariatur.Lorem ipsum dolor, sit amet consectetur adipisicing elit.                        </p>
                    </div>
                </div>
            </div>
            <div class="content-background">
                <div class="content3">
                    <div class="title-and-map">
                        <div class="content3-title">
                            <h1>Find Us Here</h1>
                            <div class="content3-subtitle">
                                <p>Contact Us Now :</p>
                                <div class="contact-us">
                                    <i class="fa-solid fa-envelope"></i>
                                    <a href="mailto:gameternalofficial@gmail.com">gameternalofficial@gmail.com</a>
                                    <br>
                                    <i class="fa-solid fa-phone"></i>
                                    <a href="tel:+60149034682">+60149034682</a>
                                </div>
                            </div>
                        </div>
                        <div class="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1254.7362970560062!2d101.72766104472474!3d3.214909704189882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc3843bfb6a031%3A0x2dc5e067aae3ab84!2sTunku%20Abdul%20Rahman%20University%20College%20(TAR%20UC)!5e0!3m2!1sen!2smy!4v1660827650587!5m2!1sen!2smy" 
                                    width="425" height="425" style="" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content4">
                <div class="content4-title">
                    <h1>Want know more about us ?</h1>
                    <button type="button">
                        <a href="visitorAboutUs.php" class="about-us-link"><span></span>Click Here</a>
                    </button>
                </div>
            </div>
        </div>
    </body>
    <?php
    include 'visitorFooter.php';
    ?>
    <script type="text/javascript">
        window.addEventListener("scroll", function () {
            var header = document.querySelector('.nav-bar');
            header.classList.toggle("sticky", window.scrollY > 0);
        });
        window.addEventListener("scroll", function () {
            var header2 = document.querySelector('.nav-link');
            header2.classList.toggle("hover-effect", window.scrollY > 0);
        });

        var topbtn = document.getElementById("topbtn");
        var downbtn = document.getElementById("downbtn");

        window.onscroll = function () {
            scrollFunction();
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                topbtn.style.display = "block";
                downbtn.style.display = "block";
            } else {
                topbtn.style.display = "none";
                downbtn.style.display = "none";
            }
            
            if (document.body.scrollTop > 3000 || document.documentElement.scrollTop > 3000) {
                topbtn.style.display = "block";
                downbtn.style.display = "none";
            } else {
                topbtn.style.display = "block";
                downbtn.style.display = "block";
            }
            
            
        }

        function topFunction() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        }

        function downFunction() {
            window.scrollTo({top: 7000, behavior: 'smooth'});
        }


    </script>
</html>