<?php 


function food_popular($productname, $productprice, $productimage, $product_id){
    $rupiah = rupiah($productprice);
    $element = "
    <form action=\"welcome.php\" method=\"post\" class=\"box\" >
        <a href=\"#\" class=\"fas fa-heart\"></a>
        <div class=\"image\">
            <img src=\"$productimage\" alt=\"ini gambar\" />
        </div>
        <div class=\"content\">
            <h3>$productname</h3>
            <div class=\"stars\">
                <i class=\"fas fa-star\"></i>
                <i class=\"fas fa-star\"></i>
                <i class=\"fas fa-star\"></i>
                <i class=\"fas fa-star\"></i>
                <i class=\"fas fa-star-half-alt\"></i>
                <span> (50) </span>
            </div>
            <div class=\"price\">$rupiah <span>Rp.50.000</span></div>                        
            <button type=\"submit\" class=\"btn\" name=\"addtocart\">add to cart</button>
            <input type=\"hidden\" name=\"product_id\" value=$product_id>
        </div>
    </form>    

    ";
    echo $element;
}

function food_keranjang($productname, $productprice, $productimage, $productid){
    $price = rupiah($productprice);
    $element = "
    <form action=\"costcart.php?id=$productid\" method=\"post\" class=\"box\">
        <button type=\"submit\" name=\"remove\" class=\"fas fa-times\"></button> 
        <img src=\"$productimage\" alt=\"iki gambar\" />
        <div class=\"content\">
            <h3>$productname</h3>            
            <div class=\"bungkus\">                    
                <span> quantity :  </span>                
                <i class=\"kurang fas fa-minus-square fa-2x\"></i>
                <input type=\"text\" name=\"qty\" value=\"1\" id=\"1\" disabled/>
                <i class=\"tambah fas fa-plus-square fa-2x\"></i>
                <input type=\"hidden\" id=\"satuan\" value=\"$productprice\"/>
                <input type=\"hidden\" id=\"idproduknya\" value=\"$productid\"/>
            </div>

            <br/>
            <span> price : </span>
            <span class=\"price\" >$price</span>
            
            
        </div>
        
    </form>
    ";
    echo $element;
}



function rupiah($angka){	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah; 
}


function getCart($conn, $id){
    $sql = "SELECT user_id , products.id, product_name, product_price, product_image 
    FROM `products` 
    INNER JOIN cart ON cart.product_id = products.id
    WHERE user_id = $id;";
    $result = mysqli_query($conn, $sql);
    return $result;    
}

function addCart($conn, $user_id, $product_id){
    $sql = "INSERT INTO cart (user_id, product_id) VALUES ($user_id, $product_id)";
    $result = mysqli_query($conn, $sql);
    return $result;    
}

function cekCart($conn, $user_id, $product_id){
    $sql  ="SELECT * FROM `cart` WHERE user_id = $user_id AND product_id = $product_id;";
    $result = mysqli_query($conn, $sql);
    return $result; 
}

function removeCart($conn, $user_id, $product_id){
    $sql = "DELETE FROM `cart` WHERE user_id = $user_id AND product_id = $product_id;";
    $result = mysqli_query($conn, $sql);
    return $result; 
}

function getProfile($conn, $user_id){
    $sql = "SELECT * FROM `users` WHERE id = $user_id ;";
    $result = mysqli_query($conn, $sql);
    return $result; 
}

function updateProfile($conn, $user_id, $username, $email, $hape, $kelamin, $birthday ){
    $sql = "UPDATE `users` SET username = '$username',
    email = '$email', 
    no_telpon = '$hape',
    jenis_kelamin = '$kelamin',
    tanggal_lahir = '$birthday'
    WHERE id = $user_id;";
    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn); 

}

function sweetAlert($title, $text, $type){
    $script = "
         <script>
         setTimeout(function () { new swal(\"$title\",\"$text\",\"$type\");}, 1000);
         </script>
    ";

    echo $script;
    
}

?>