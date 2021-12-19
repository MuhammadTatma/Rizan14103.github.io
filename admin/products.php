
<?php 
include "includes/header.php" ;
require("../function.php");
if(isset($_GET['delete_success'])){
    if($_GET['delete_success']=="true"){
        sweetAlert("Success" ,"Product has been removed", "success");
    }else{
        sweetAlert("Error" ,"Something went wrong", "error");
    }
}
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Products</h1>

        <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Products</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Price</th>                            
                            <th>Action</th>                            
                        </tr>
                    </thead>                    
                    <tbody>
                        <?php 
                        
                        $sql = "SELECT * FROM products";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){                            
                        ?>                                            
                        <tr>
                            <td> <img style="height: 4rem;" src="..\<?php echo $row['product_image'] ?>" alt="iki gambar" /></td>
                            <td><?php echo $row['product_name'] ?></td>
                            <td><?php echo rupiah($row['product_price']) ?></td>
                            <td>
                                <a href="edit-product.php?id=<?php echo $row['id'] ?>" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></i></i></a>
                                <a href="delete-product.php?id=<?php echo $row['id'] ?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>    
                        <?php 
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->

<?php include "includes/footer.php" ?>
           