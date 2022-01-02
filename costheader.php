<?php 
date_default_timezone_set("Asia/Jakarta");

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

if(isset($_GET['checkout_success'])){
    if($_GET['checkout_success']==true){
        sweetAlert("Success!","Berhasil masuk antrian!","success");
    }else{
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
    <link href="admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>

<body>

    <header class="header">
        <a href="#" class="logo"> <i class="fas fa-utensils"></i> food </a>

        <nav class="navbar">
            <a href="welcome.php#home">home</a>
            <a href="welcome.php#about">about</a>
            <a href="welcome.php#popular">popular</a>
            <a href="welcome.php#menu">menu</a>
            <a href="welcome.php#order">order</a>
            <a href="welcome.php#blogs">blogs</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="search-btn" class="fas fa-search"></div>
            <script>
                function gotocart(){
                    location.href = 'costcart.php';
                }
            </script>
            <div id="cart-btn" class="fas fa-shopping-cart" onclick="gotocart()">
            <?php                 
                $result = getCart($conn, $_SESSION['userid']);
                $count = $result->num_rows;
                echo "<span id=\"cart-count\">$count</span>";
                ?>
            </div>
            <div id="login-btn" class="fas fa-user">
                <ul>
                    <li><a href="costpropil.php">My Profile</a></li>
                    <li><a href="costmyorder.php">My Order</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>

        </div>

    </header>