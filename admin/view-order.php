<?php 

include "includes/header.php" ;
require("../function.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header("Location: index.php");;
}

$sql = "SELECT products.product_image, products.product_name ,products.product_price, costumer_order_products.quantity FROM `costumer_order_products`INNER JOIN `products` ON products.id = costumer_order_products.product_id WHERE costumer_order_products.order_id = $id;";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Order Details</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3 d-flex justify-content-between">
    <?php 
    $previous_page = $_GET['prev'];
    ?>
    <h6 class="m-0 font-weight-bold text-primary d-inline"><span id="count"><?php echo $num ?></span>  Items </h6>
    <a href="<?php echo $previous_page ?>" class="btn btn-info">Back</a>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Product Price</th>                                                                                                      
                </tr>
            </thead>                    
            <tbody>
                <?php                             
                if( $num > 0){
                    while($row = mysqli_fetch_assoc($result)){                            
                ?>                                            
                <tr>
                    <td> <img style="height: 4rem;" src="..\<?php echo $row['product_image'] ?>" alt="iki gambar" /></td>
                    <td><?php echo $row['product_name'] ?></td>
                    <td><?php echo $row['quantity'] ?></td>
                    <td><?php echo rupiah($row['product_price']) ?></td>
                    <!-- <td>
                        <a href="process-order.php?id=<?php echo $row['order_id'] ?>" class="btn btn-primary">Process now</a>
                        <a href="view-order.php?id=<?php echo $row['order_id'] ?>" class="btn btn-info">View Order</a>
                    </td> -->
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