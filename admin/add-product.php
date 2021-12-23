<?php 

include "includes/header.php" ;
require("../function.php");

if(isset($_POST['submit-product'])){
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $img_name = rand().$_FILES['product_image']['name'];
    $img_tmp_name = $_FILES['product_image']['tmp_name'];
    $img_size = $_FILES['product_image']['size'];

    if($img_size > 5242880){ //batas 5 mb
        sweetAlert("Error", "Woops! Image is too big, maximum image size is 5Mb ", "error");
    }else{
        $sql = "INSERT INTO products (product_name, product_price, product_image) value 
        ('$name', '$price', 'image/$img_name');";
        $result = mysqli_query($conn, $sql);
        if($result){
            move_uploaded_file($img_tmp_name, "../image/".$img_name);
            sweetAlert("Succes", "Products has been successfully added", "success");
        }else{
            sweetAlert("Error", "Woops! Something is kleru", "error");
        }
    }

    
}

?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-8 col-12 mx-auto bg-white shadow p-4">
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Add Product</h1>

                <form action="" method="POST" enctype="multipart/form-data">                    
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" name="product_name" class="form-control" id="product_name" aria-describedby="emailHelp" placeholder="Enter product name" required>           
                    </div>
                    <div class="form-group">
                        <label for="product_price">Product Price</label>
                        <input type="number" name="product_price" class="form-control" id="product_price" aria-describedby="emailHelp" placeholder="Enter product price" required>
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>        
                    <div class="form-group">
                        <label for="product_image">Image</label>
                        <input type="file" accept="image/*" name="product_image" class="form-control-file" id="product_image" required>
                    </div>   
                     
                    <button type="submit" name="submit-product"  class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->

<?php include "includes/footer.php" ?>