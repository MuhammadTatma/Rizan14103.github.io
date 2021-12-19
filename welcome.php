<?php 

include 'php/config.php';
require("function.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

if(isset($_POST['addtocart'])){
    $result = cekCart($conn, $_SESSION['userid'], $_POST['product_id']);
    // var_dump($result);
    if($result->num_rows > 0){ //jika udah ada        
        sweetAlert("Woww !😁", "Produk sudah ada di cart!","info");
    }else{        
        $result = addCart($conn, $_SESSION['userid'], $_POST['product_id']);    
        sweetAlert("Success", "produk berhasil ditambahkan", "success");
    }
}

if(isset($_POST['remove'])){
    // print_r($_GET['id']);
    $result = removeCart($conn, $_SESSION['userid'], $_GET['id']);
    $effected = mysqli_affected_rows($conn);
    // var_dump($effected);
    if($effected >0 ){
        // echo "<script>alert('Product has been removed...!')</script>";        
        sweetAlert("Yeay!","Berhasil menghapus!","success");
    }else{
        // echo "<script>alert('Something went kleru...!')</script>";        
        sweetAlert("Error!","Ada yang salah !","error");
    }
}

if(isset($_POST['simpanProfile'])){    
    $result = updateProfile($conn, $_SESSION['userid'], $_POST['username'], $_POST['email'], $_POST['phone'],$_POST['kelamin'],$_POST['birthday']);
    $effected = mysqli_affected_rows($conn);
    // var_dump($_SESSION['userid']);
    // var_dump($_POST['kelamin']);
    if($effected >0 ){
        // echo "<script>alert('berhasil di simpan...!')</script>";        
        sweetAlert("Success!","Berhasil di simpan!","success");
    }else{
        // echo "<script>alert('Something went kleru...!')</script>";       
        sweetAlert("Error!","ada yang salah!","error");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Restorant Salam dari Binjai</title>
    <!--Swiper-->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

    <header class="header">
        <a href="#" class="logo"> <i class="fas fa-utensils"></i> food </a>

        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="#popular">popular</a>
            <a href="#menu">menu</a>
            <a href="#order">order</a>
            <a href="#blogs">blogs</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="search-btn" class="fas fa-search"></div>
            <div id="cart-btn" class="fas fa-shopping-cart">
            <?php                 
                $result = getCart($conn, $_SESSION['userid']);
                $count = $result->num_rows;
                echo "<span id=\"cart-count\">$count</span>";
                ?>
            </div>
            <div id="login-btn" class="fas fa-user">
                <ul>
                    <li><a href="#">My Profile</a></li>
                    <li><a href="chat.php">Chat</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>

        </div>

    </header>

    <!-- header section ends  -->

    <!-- search-form  -->

    <section class="search-form-container">
        <form action="">
            <input type="search" name="" placeholder="search here..." id="search-box" />
            <label for="search-box" class="fas fa-search"></label>
        </form>
    </section>

    <!-- shopping-cart section  -->

    <section class="shopping-cart-container">
        <div class="products-container">
            <h3 class="title">your products</h3>

            <div class="box-container">
                <?php 
                $total = 0 ;
                $result = getCart($conn, $_SESSION['userid']);                
                // var_dump($result->num_rows > 0);    
                // var_dump($result->num_rows);                  
                if($result->num_rows > 0){
                    // $product_id = array_column($_SESSION['cart'],'product_id');    
                    while($row = mysqli_fetch_assoc($result)){
                        food_keranjang($row['product_name'], $row['product_price'],$row['product_image'], $row['id']);
                        $total = $total+(int)$row['product_price'];
                    }                    
                }else{
                        echo "<h3 style=\"text-align:center;\">Cart is Empty</h3>";
                }
                
                ?>
            </div>
        </div>        

        <div class="cart-total">
            <h3 class="title">cart total</h3>

            <div class="box">
                <h3 class="subtotal">Delivery : <span> Rp.- </span></h3>
                <h3 class="total">total : <?php 
                $temp = rupiah($total);
                echo "<span>$temp</span>";
                ?></h3>

                <a href="#" class="btn">proceed to checkout</a>
            </div>
        </div>
    </section>

    <!-- Profile -->

    <section class="profile-cart-container">
        <div class="profile-container">
            <header>
                <h3 class="title">Profile Saya</h3>
            </header>
            <main>
                <?php 
                $result = getProfile($conn, $_SESSION['userid']);
                $row = $result->fetch_assoc();
                $username = $row['username'];
                $email = $row['email'];                
                $hape = $row['no_telpon'];
                $kelamin = $row['jenis_kelamin'];
                $birthday = $row['tanggal_lahir'];
                ?>
                <form action="welcome.php" method="POST">
                    <div class="input-group">
                        <label class="input-label" for="name">Username</label>
                        <input type="text" name="username" id="name" placeholder="costumer's username" value=<?=  $username ?> required>
                    </div>

                    <div class="input-group">
                        <label class="input-label" for="email">Email</label>
                        <input type="email" class="form-control" readonly name="email" id="email" placeholder="costumer's email" value=<?=  $email ?> required>
                    </div>

                    <div class="input-group">
                        <label class="input-label" class="input-label" for="phone">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" placeholder="costumer's phone number" value=<?= $hape ?>>
                    </div>

                    <div class="input-group">
                        <p class="input-label">Jenis Kelamin</p>
                        <div class="input-radio">
                            <label ><input type="radio" name="kelamin"
                                    id="laki-laki" value="L" <?php echo ($kelamin =='L')? 'checked':'' ?> >Laki-Laki</label>
                            <label ><input type="radio" name="kelamin"
                                    id="perempuan" value="P" <?php echo ($kelamin =='P')? 'checked':'' ?> >Perempuan</label>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="input-label" class="input-label" for="birthday">Tanggal Lahir</label>
                        <div class="input-date">
                            <input type="date" name="birthday" id="birthday" value=<?=  $birthday ?>>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="input-label"></label>
                        <button type="submit" name="simpanProfile" class="btn">simpan</button>
                    </div>
                    <aside>
                    <div class="image-card">
                        <img src="image/image4.jpg" alt="Photo Profile" />
                        <input type="file" id="file" accept="image/*">
                        <label for="file">
                            Choose a Photo
                        </label>
                        <caption>Ukuran gambar: maks. 1 MB</caption>
                    </div>
                </aside>
                </form>

                
            </main>
        </div>
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

    <!-- popular section starts  -->

    <section class="popular" id="popular">
        <div class="heading">
            <span>popular food</span>
            <h3>our special dishes</h3>
        </div>

        <div class="box-container">
            <?php 
            $sql = "SELECT *FROM products WHERE id > 4";

            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    food_popular($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
                }
            }
            ?>
        </div>
    </section>

    <!-- popular section ends -->

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

    <!-- order section starts  -->

    <section class="order" id="order">
        <div class="heading">
            <span>order now</span>
            <h3>fastest home delivery</h3>
        </div>

        <div class="icons-container">
            <div class="icons">
                <img src="image/icon-1.png" alt="" />
                <h3>7:00am to 10:30pm</h3>
            </div>

            <div class="icons">
                <img src="image/icon-2.png" alt="" />
                <h3>+6281365144092</h3>
            </div>

            <div class="icons">
                <img src="image/icon-3.png" alt="" />
                <h3>Jl Kaliuran, Sleman, Yogyakarta</h3>
            </div>
        </div>

        <form action="">
            <div class="flex">
                <div class="inputBox">
                    <span>your name</span>
                    <input type="text" placeholder="customer's name" name="" id="" />
                </div>
                <div class="inputBox">
                    <span>your number</span>
                    <input type="number" placeholder="customer's number" name="" id="" />
                </div>
            </div>

            <div class="flex">
                <div class="inputBox">
                    <span>your order</span>
                    <input type="text" placeholder="food you want" name="" id="" />
                </div>
                <div class="inputBox">
                    <span>how much</span>
                    <input type="number" placeholder="number or orders" name="" id="" />
                </div>
            </div>

            <div class="flex">
                <div class="inputBox">
                    <span>your details</span>
                    <input type="text" placeholder="your message" name="" id="" />
                </div>
                <div class="inputBox">
                    <span>pick up time</span>
                    <input type="datetime-local" />
                </div>
            </div>

            <div class="flex">
                <div class="inputBox">
                    <textarea placeholder="your address" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="inputBox">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13299.483041490883!2d110.41560513804825!3d-7.68744567537153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5f7542c55a05%3A0x2d2f71d030269379!2sResto%20Taman%20Luku!5e0!3m2!1sen!2sid!4v1635666433594!5m2!1sen!2sid"
                        width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <input type="submit" value="proceed to order" class="btn" />
        </form>
    </section>

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

    <!-- custom js file link  -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/sweetalert/sweetalert2.all.min.js"></script>
</body>

</html>