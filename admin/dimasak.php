<?php 

include "includes/header.php" ;
require("../function.php");
if(isset($_GET['move_success'])){
    if($_GET['move_success']=="true"){
        sweetAlert("Success" ,"Product marked as finished order", "success");
    }else{
        sweetAlert("Error" ,"Something went wrong", "error");
    }
}

$sql = "SELECT costumer_order.order_id, users.username, users.email, users.no_telpon FROM `costumer_order` INNER JOIN `users` ON costumer_order.costumer_id = users.id WHERE costumer_order.order_status = 'ongoing';";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Ongoing Order</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
    
    <h6 class="m-0 font-weight-bold text-primary"><span id="count"><?php echo $num ?></span>  Ongoing order</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Costumer Name</th>
                    <th>Costumer Email</th>         
                    <th>Costumer Phone</th>                             
                    <th>Action</th>                            
                </tr>
            </thead>                    
            <tbody>
                <?php                             
                if( $num > 0){
                    while($row = mysqli_fetch_assoc($result)){                            
                ?>                                            
                <tr>
                    <td><?php echo $row['order_id'] ?></td>
                    <td><?php echo $row['username'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['no_telpon'] ?></td>
                    <td>
                        <a href="view-order.php?id=<?php echo $row['order_id'] ?>&prev=dimasak.php" class="btn btn-info">View Order</a>    
                        <a href="finish-order.php?id=<?php echo $row['order_id'] ?>" class="btn btn-primary">Mark as Finished</a>                        
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