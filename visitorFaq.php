<!DOCTYPE html>

<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }
    
     @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    body{
        font-family:"kanit";
        background:black;
        color:#fff;
        animation:3s fadeIn;
    }

    section{
        min-height:100vh;
        width:80%;
        margin:0 auto;
        display:flex;
        flex-direction:column;
        align-items:center;
    }

    .title{
        font-size:3rem;
        margin:2rem 0rem;
    }

    .faq{
        max-width:800px;
        margin-top:2rem;
        padding-bottom:1rem;
        border-bottom:2px solid #fff;
        cursor:pointer;
    }

    .question {
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .question h3{
        font-size:1.8rem;
         transition:all 0.5s ;
    }

    .answer{
        max-height:0;
        overflow:hidden;
        transition:max-height 1.4s ease;
    }

    .answer p{
        padding-top:1rem;
        line-height:1.6;
        font-size:20px;
    }
    
    .faq.active .question h3{
         transition:all 0.5s ;
        color:blue;
    }

    .faq.active .answer{
        max-height:300px;
        animation:fade 1s ease-in-out;
    }

    .faq.active svg{
        transform:rotate(180deg);
    }
    
    svg{
        transition:transform 0.5s ease-in;
    }

    @keyframes fade{
        from{
            opacity:0;
            transform: translateY(-10px);
        }
    }

</style>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Gameternal | Next Generation of E-Sport</title>
        <link rel="icon" type="image/x-icon" href="logo2.png"/>
        <script src="https://kit.fontawesome.com/bfb46dc9da.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    </head>
    <body>
        <header>
            <?php
            include 'visitorNav.php';
            ?>
        </header>
        <section>
            <h2 class="title">FAQs</h2>

            <div class="faq">
                <div class="question">
                    <h3>What is JavaScript ?</h3>
                    <svg width="15" height="10" viewBox="0 0 42 25">
                    <path d="M3 3L21 21L39 3" stroke="white" stroke-width="7" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="answer">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
            </div>

            <div class="faq">
                <div class="question">
                    <h3>What is Java?</h3>
                    <svg width="15" height="10" viewBox="0 0 42 25">
                    <path d="M3 3L21 21L39 3" stroke="white" stroke-width="7" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="answer">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
            </div>

            <div class="faq">
                <div class="question">
                    <h3>What is php ?</h3>
                    <svg width="15" height="10" viewBox="0 0 42 25">
                    <path d="M3 3L21 21L39 3" stroke="white" stroke-width="7" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="answer">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
            </div>
            
            <div class="faq">
                <div class="question">
                    <h3>What is League Of Legends ?</h3>
                    <svg width="15" height="10" viewBox="0 0 42 25">
                    <path d="M3 3L21 21L39 3" stroke="white" stroke-width="7" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="answer">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
            </div>
            
            <div class="faq">
                <div class="question">
                    <h3>What is Valorant ?</h3>
                    <svg width="15" height="10" viewBox="0 0 42 25">
                    <path d="M3 3L21 21L39 3" stroke="white" stroke-width="7" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="answer">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
            </div>
        </section>





    </body>
    <?php
    include 'visitorFooter.php';
    ?>

    <script>
        const faqs = document.querySelectorAll(".faq");

        faqs.forEach(faq => {
            faq.addEventListener("click", () => {
                faq.classList.toggle("active");
            })
        })
    </script>

</html>
