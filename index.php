<?php 

include 'config.php';

session_start();

error_reporting(0);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- =====BOX ICONS===== -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet" />

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="landing/css/styles.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

    <title>Restoran Binjai</title>
</head>

<body>
    <!--===== HEADER =====-->
    <header class="l-header">
        <nav class="nav bd-grid">
            <div>
                <h2><a href="#" class="nav__logo">Restoran Binjai</a></h2>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class="bx bx-menu"></i>
            </div>

            <div class="nav__menu" id="nav-menu">
                <div class="nav__close" id="nav-close">
                    <i class="bx bx-x"></i>
                </div>

                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="#home" class="nav__link active"></a>
                    </li>
                    <li class="nav__item">
                        <a href="#about" class="nav__link"></a>
                    </li>
                    <li class="nav__item">
                        <a href="#skills" class="nav__link"></a>
                    </li>
                    <li class="nav__item">
                        <a href="#contact" class="nav__link"></a>
                    </li>
                </ul>
            </div>
            <div>
                <button style="margin-right:1rem;" class="cta cta1"><a href="login.php">Log In</a></button>
                <button class="cta cta2"><a href="register.php">Sign Up</a></button>
            </div>
            
        </nav>
    </header>

    <main class="l-main">
        <!--===== HOME =====-->
        <section class="home" id="home">
            <div class="home__container bd-grid">
                <div class="home__img">
                    <img src="landing/img/img1.png" alt="" data-speed="-2" class="move" />
                    <img src="landing/img/img2.png" alt="" data-speed="2" class="move" />
                    <img src="landing/img/img3.png" alt="" data-speed="2" class="move" />
                    <img src="landing/img/img4.png" alt="" data-speed="-2" class="move" />
                    <img src="landing/img/img5.png" alt="" data-speed="-2" class="move" />
                    <img src="landing/img/img6.png" alt="" data-speed="2" class="move" />
                </div>

                <div class="home__data">
                    <h1 class="home__title">Restoran<br />Binjai</h1>
                    <p class="home__description">
                        Menikmati indahnya cita rasa masakan<br />
                        Binjai.
                    </p>
                    <a href="login.php" class="home__button">Get Started</a>
                </div>
            </div>
        </section>
    </main>

    <!--===== GSAP =====-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>

    <!--===== MAIN JS =====-->
    <script src="landing/js/main.js"></script>
</body>

</html>