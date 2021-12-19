<?php 

include "includes/header.php" ;
require("../function.php");

if(isset($_GET['id'])){
    $productID = $_GET['id'];
}

if(isset($_POST['submit-product'])){
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $img_name = rand().$_FILES['product_image']['name'];
    $img_tmp_name = $_FILES['product_image']['tmp_name'];
    $img_size = $_FILES['product_image']['size'];
    $old_img = $_POST['old_img'];

    if($img_size > 5242880){ //batas 5 mb
        sweetAlert("Error", "Woops! Image is too big, maximum image size is 5Mb ", "error");
    }else if($_FILES['product_image']['name']!=""){
        $sql = "UPDATE products SET product_name = '$name',
        product_price = '$price', 
        product_image =  'image/$img_name' WHERE id = $productID;";        
        $result = mysqli_query($conn, $sql);
        if($result){
            move_uploaded_file($img_tmp_name, "../image/".$img_name);
            sweetAlert("Succes", "Products has been successfully updated", "success");
        }else{
            sweetAlert("Error", "Woops! Something is kleru", "error");
        }
    }else{
        $sql = "UPDATE products SET product_name = '$name',
        product_price = '$price', 
        product_image =  '$old_img' WHERE id = $productID;";        
        $result = mysqli_query($conn, $sql);
        if($result){            
            sweetAlert("Succes", "Products has been successfully updated", "success");
        }else{
            sweetAlert("Error", "Woops! Something is kleru", "error");
        }
    }    
}

if(isset($_POST['cancel'])){
    // echo "<script>location.href = 'products.php?'</script>";
    echo "<script>
                    setTimeout(function () { new swal({
                        title: \"Are you sure ?\",                        
                        icon: \"question\",
                        confirmButtonText: \"Back\",
                        denyButtonText: \"Yes\",     
                        showDenyButton: true,                      
                    }).then((result)=>{
                        if (result.isDenied){                                                        
                            window.location = \"products.php\";
                        }
                    });}, 1000);
                </script>";
}

?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-8 col-12 mx-auto bg-white shadow p-4">
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Edit Product</h1>

                <form action="" method="POST" enctype="multipart/form-data">
                    <?php                         
                        $sql = "SELECT * FROM products WHERE id=$productID";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result)                                                       
                    ?>  
                    <div class="form-group">
                    <img style="height: 8rem; margin-bottom:1.5rem;" id="output" src="..\<?php echo $row['product_image'] ?>" alt="iki gambar" />
                        <label for="product_image"></label>
                        <input type="file" accept="image/*" name="product_image" class="form-control-file" id="product_image" onchange="loadFile(event)" >
                        <input type="hidden" name="old_img" value="<?php echo $row['product_image'] ?>">
                        <script>
                        var loadFile = function(event){
                            var output = document.getElementById('output');
                            output.src = URL.createObjectURL(event.target.files[0]);
                            output.onload = function() {
                            URL.revokeObjectURL(output.src) // free memory
                            }
                        };
                        </script>
                    </div>   
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" name="product_name" value="<?php echo $row['product_name'] ?>" class="form-control" id="product_name" aria-describedby="emailHelp" placeholder="Enter product name" required>           
                    </div>
                    <div class="form-group">
                        <label for="product_price">Product Price</label>
                        <input type="number" name="product_price" value="<?php echo $row['product_price'] ?>" class="form-control" id="product_price" aria-describedby="emailHelp" placeholder="Enter product price" required>
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>        
                     
                    <button type="submit" name="submit-product"  class="btn btn-primary">update Product</button>
                    <button type="submit" name="cancel"  class="btn btn-danger">cancel</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->

<?php include "includes/footer.php" ?>