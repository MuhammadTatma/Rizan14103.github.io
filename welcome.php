<?php include "costheader.php" ?>
    <!-- header section ends  -->

    <!-- search-form  -->

    <section class="search-form-container">
        <form action="">
            <input type="search" name="" placeholder="search here..." id="search-box" />
            <label for="search-box" class="fas fa-search"></label>
        </form>
    </section>
    
    

    <!-- home section starts  -->

    <!-- home section ends  -->
    
    

<!-- home section 2 start-->
<section class="home" id="home">
        <div class="swiper-container home-slider">
            <div class="swiper-wrapper wrapper">
                <form method="POST" class="swiper-slide slide">
                    <div class="content">
                        <span>our special dish</span>
                        <h3>spicy noodles</h3>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit
                            natus dolor cumque?
                        </p>
                        <button type="submit" class="btn" name="addtocart">order now</button>                        
                    </div>
                    <div class="image">
                        <img src="image/home-img-1.png" alt="" />
                    </div>
                    <input type="hidden" name="product_id" value=1>
                </form>

                <form method="POST" class="swiper-slide slide">
                    <div class="content">
                        <span>our special dish</span>
                        <h3>fried chicken</h3>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit
                            natus dolor cumque?
                        </p>
                        <button type="submit" class="btn" name="addtocart">order now</button>  
                    </div>
                    <div class="image">
                        <img src="image/home-img-2.png" alt="" />
                    </div>
                    <input type="hidden" name="product_id" value=2>
                </form>

                <form method="POST" class="swiper-slide slide">
                    <div class="content">
                        <span>our special dish</span>
                        <h3>hot pizza</h3>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit
                            natus dolor cumque?
                        </p>
                        <button type="submit" class="btn" name="addtocart">order now</button>  
                    </div>
                    <div class="image">
                        <img src="image/home-img-3.png" alt="" />
                    </div>
                    <input type="hidden" name="product_id" value=3>
                </form>
            </div>

            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- home section 2 end-->

    
<!-- category section starts  -->

<section class="category">
        <a href="#" class="box">
            <img src="image/cat-1.png" alt="" />
            <h3>Paketan</h3>
        </a>

        <a href="#" class="box">
            <img src="image/cat-2.png" alt="" />
            <h3>Italian food</h3>
        </a>

        <a href="#" class="box">
            <img src="image/cat-3.png" alt="" />
            <h3>Fast food</h3>
        </a>

        <a href="#" class="box">
            <img src="image/cat-4.png" alt="" />
            <h3>Ayam goyeng</h3>
        </a>

        <a href="#" class="box">
            <img src="image/cat-5.png" alt="" />
            <h3>Homemade food</h3>
        </a>

        <a href="#" class="box">
            <img src="image/cat-6.png" alt="" />
            <h3>coffee</h3>
        </a>
    </section>

    <!-- category section ends --> 
    <!-- about section starts  -->

    <section class="about" id="about">
        <div class="image">
            <img src="image/about-img.png" alt="" />
        </div>

        <div class="content">
            <span>why choose us?</span>
            <h3 class="title">what's make our food delicious!</h3>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos ut
                explicabo, numquam iusto est a ipsum assumenda tempore esse corporis?
            </p>
            <a href="#" class="btn">read more</a>
            <div class="icons-container">
                <div class="icons">
                    <img src="image/serv-1.png" alt="" />
                    <h3>fast delivery</h3>
                </div>
                <div class="icons">
                    <img src="image/serv-2.png" alt="" />
                    <h3>fresh food</h3>
                </div>
                <div class="icons">
                    <img src="image/serv-3.png" alt="" />
                    <h3>best quality</h3>
                </div>
                <div class="icons">
                    <img src="image/serv-4.png" alt="" />
                    <h3>24/7 support</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- about section ends --> 
    <!-- start of popular -->
    <?php include "costpopular.php" ?>  
    <!-- end popular  -->
    
    <!-- banner section starts  -->
    <section class="banner">
        <div class="row-banner">
            <form method="POST" class="content">
                <span>double cheese</span>
                <h3>burger</h3>
                <p>with cococola and fries</p>
                <button href="#" name="addtocart" class="btn">order now</button>
                <input type="hidden" name="product_id" value=4>
        </form>
        </div>

        <div class="grid-banner">
            <div class="grid">
                <img src="image/banner-1.png" alt="" />
                <div class="content">
                    <span>special offer</span>
                    <h3>upto 50% off</h3>
                    <a href="#" class="btn">order now</a>
                </div>
            </div>
            <div class="grid">
                <img src="image/banner-2.png" alt="" />
                <div class="content center">
                    <span>special offer</span>
                    <h3>upto 25% extra</h3>
                    <a href="#" class="btn">order now</a>
                </div>
            </div>
            <div class="grid">
                <img src="image/banner-3.png" alt="" />
                <div class="content">
                    <span>limited offer</span>
                    <h3>100% cashback</h3>
                    <a href="#" class="btn">order now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- banner section ends -->
    
    <!-- menu section starts  -->
    <section class="menu" id="menu">
        <div class="heading">
            <span>our menu</span>
            <h3>our top dishes</h3>
        </div>

        <div class="box-container">
            <a href="#" class="box">
                <img src="image/menu-1.png" alt="" />
                <div class="content">
                    <h3>delicious food</h3>
                    <div class="price">Rp.40.000</div>
                </div>
            </a>

            <a href="#" class="box">
                <img src="image/menu-2.png" alt="" />
                <div class="content">
                    <h3>delicious food</h3>
                    <div class="price">Rp.40.000</div>
                </div>
            </a>

            <a href="#" class="box">
                <img src="image/menu-3.png" alt="" />
                <div class="content">
                    <h3>delicious food</h3>
                    <div class="price">Rp.40.000</div>
                </div>
            </a>

            <a href="#" class="box">
                <img src="image/menu-4.png" alt="" />
                <div class="content">
                    <h3>delicious food</h3>
                    <div class="price">Rp.40.000</div>
                </div>
            </a>

            <a href="#" class="box">
                <img src="image/menu-5.png" alt="" />
                <div class="content">
                    <h3>delicious food</h3>
                    <div class="price">Rp.40.000</div>
                </div>
            </a>

            <a href="#" class="box">
                <img src="image/menu-6.png" alt="" />
                <div class="content">
                    <h3>delicious food</h3>
                    <div class="price">Rp.40.000</div>
                </div>
            </a>
        </div>
    </section>

    <!-- menu section ends -->
    <?php include "costorder.php" ?>  
    
    <!-- blogs section starts  -->
    <section class="blogs" id="blogs">
        <div class="heading">
            <span>our blogs</span>
            <h3>our daily stories</h3>
        </div>

        <div class="box-container">
            <div class="box">
                <div class="image">
                    <h3><i class="fas fa-calendar"></i> 21st may, 2021</h3>
                    <img src="image/blog-1.jpg" alt="" />
                </div>
                <div class="content">
                    <div class="tags">
                        <a href="#"> <i class="fas fa-tag"></i> food / </a>
                        <a href="#"> <i class="fas fa-tag"></i> burger / </a>
                        <a href="#"> <i class="fas fa-tag"></i> pizza </a>
                    </div>
                    <h3>blog title goes here...</h3>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem,
                        earum.
                    </p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <h3><i class="fas fa-calendar"></i> 21st may, 2021</h3>
                    <img src="image/blog-2.jpg" alt="" />
                </div>
                <div class="content">
                    <div class="tags">
                        <a href="#"> <i class="fas fa-tag"></i> food / </a>
                        <a href="#"> <i class="fas fa-tag"></i> burger / </a>
                        <a href="#"> <i class="fas fa-tag"></i> pizza </a>
                    </div>
                    <h3>blog title goes here...</h3>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem,
                        earum.
                    </p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <h3><i class="fas fa-calendar"></i> 21st may, 2021</h3>
                    <img src="image/blog-3.jpg" alt="" />
                </div>
                <div class="content">
                    <div class="tags">
                        <a href="#"> <i class="fas fa-tag"></i> food / </a>
                        <a href="#"> <i class="fas fa-tag"></i> burger / </a>
                        <a href="#"> <i class="fas fa-tag"></i> pizza </a>
                    </div>
                    <h3>blog title goes here...</h3>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem,
                        earum.
                    </p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>
        </div>
    </section>

    <!-- blogs section ends -->
    <!-- order section ends -->
    <h1>Our Teams</h1>
    <section class="container">
        <div class="card">
            <div class="bg-image">
                <img src="image/5574041.jpg" alt="" />
            </div>
            <div class="pic">
                <img src="image/rizan.jpg" alt="" />
            </div>
            <div class="info">
                <h3>Rizan Qardafil</h3>
                <span><i class="fas fa-code"></i> Project Manager</span>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam
                </p>
                <div class="icons">
                    <a href="https://www.facebook.com/rizan.qardafil.7" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="https://www.instagram.com/rizanqardafil_/" class="fab fa-instagram"></a>
                    <a href="https://github.com/Rizan14103" class="fab fa-github"></a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="bg-image">
                <img src="image/5574041.jpg" alt="" />
            </div>
            <div class="pic">
                <img src="image/image4.jpg" alt="" />
            </div>
            <div class="info">
                <h3>Agam Fajar Kusuma</h3>
                <span><i class="fas fa-laptop"></i> Web Developer</span>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam
                </p>
                <div class="icons">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="https://www.instagram.com/agam.kusuma/" class="fab fa-instagram"></a>
                    <a href="https://github.com/AgamKusuma" class="fab fa-github"></a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="bg-image">
                <img src="image/5574041.jpg" alt="" />
            </div>
            <div class="pic">
                <img src="image/tatma.JPG" alt="" />
            </div>
            <div class="info">
                <h3>Tatmainul Quluub</h3>
                <span><i class="fas fa-laptop"></i> Web Developer</span>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam
                </p>
                <div class="icons">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="https://www.instagram.com/tatmainnulq/" class="fab fa-instagram"></a>
                    <a href="https://github.com/MuhammadTatma" class="fab fa-github"></a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="bg-image">
                <img src="image/5574041.jpg" alt="" />
            </div>
            <div class="pic">
                <img src="image/wulan1.JPG" alt="" />
            </div>
            <div class="info">
                <h3>Syanides Wulan S</h3>
                <span><i class="fas fa-paint-brush"></i> UI/UX</span>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam
                </p>
                <div class="icons">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="https://www.instagram.com/wulansyafni/" class="fab fa-instagram"></a>
                    <a href="https://github.com/SyafnidesWulanS" class="fab fa-github"></a>
                </div>
            </div>
        </div>
    </section>  

    
    <!-- footer section starts  -->
    <section class="footer">
        <div class="newsletter">
            <h3>newsletter</h3>
            <form action="">
                <input type="email" name="" placeholder="enter your email" id="" />
                <input type="submit" value="subscribe" />
            </form>
        </div>

        <div class="bottom">
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
                <a href="#" class="fab fa-pinterest"></a>
            </div>

            <div class="credit">
                created <span>Tidak Bisa Ngoding Company</span> | Informatika 2021
            </div>
        </div>
    </section>

    <!-- footer section ends -->


    <?php include "costfooter.php" ?>  

    

    

    

        

    

    

    

    
    