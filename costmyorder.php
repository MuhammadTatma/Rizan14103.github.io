<?php 

include "costheader.php";
?>

<!-- shopping-cart section  -->
<section class="shopping-cart-container">
    
        <div style="width: 100%;" class="products-container">
            <h3 class="title">your Order</h3>  

            <div class="card m-4">
                <div class="card-header">
                    <h4>Today's Order</h4>
                </div>
                <?php 
                $date = date("Y-m-d");
                // var_dump($date);
                $id = $_SESSION['userid'];                
                $sql = "SELECT 
                    order_id, users.username, 
                    date_created, 
                    total_order_price,
                    order_status 
                FROM `costumer_order` 
                    INNER JOIN `users` on costumer_id = users.id
                WHERE date_created = \"$date\" AND users.id = $id;";
                $result = mysqli_query($conn, $sql);  
                if($result->num_rows > 0){
                    // $product_id = array_column($_SESSION['cart'],'product_id');    
                    while($row = mysqli_fetch_assoc($result)){                        
                        $order_id = $row['order_id'];
                        $username = $row['username'];
                        $date_created = $row['date_created'];
                        $total_order_price = $row['total_order_price'];
                        $order_status = $row['order_status'];      
                ?>                  
                        <!-- rangkuman order  -->                
                        <div class="card-body bg-white px-5 pt-5 w-100 mb-0 ">
                            <div class="row ">
                                <div class="col-lg-2 pl-0">
                                    <h5>Order Number :</h5>                        
                                </div>
                                <div class="col-lg pl-0">
                                    <p><?php echo $order_id ?></p>
                                </div>
                                <div class="col-lg-1 pl-0">
                                    <h5>Status :</h5>                        
                                </div>
                                <div class="col-lg pl-0">
                                    <p class="badge badge-info" style="font-size:12px;"><?php echo $order_status ?></p>                            
                                </div>
                                <div class="w-100"></div>
                                <div class="col-lg-2 pl-0">
                                    <h5>Costumer Name:</h5>                        
                                </div>
                                <div class="col-lg pl-0">
                                    <p><?php echo $username ?></p>
                                </div>
                                <div class="col-lg-1 pl-0">
                                    <h5>Total :</h5>                        
                                </div>
                                <div class="col-lg pl-0">
                                    <p class="col-lg p-0"><?php echo rupiah($total_order_price) ?></p>                            
                                </div>
                                <div class="w-100"></div>
                                <div class="col-lg-2 pl-0">
                                    <h5>Tanggal :</h5>                        
                                </div>
                                <div class="col-lg pl-0">
                                    <p><?php echo $date_created ?></p>
                                </div>
                            </div>            
                        </div>          
                        <!-- end of rangkuman order  -->
                        <!-- detailed order  -->
                        <div class="card-body">
                            <h5 class="card-title">Your special request</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a class="btn btn-sm btn-primary" data-toggle="collapse" href="#collapseExample<?php echo $order_id ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?php echo $order_id ?>">Details</a>
                            <div class="collapse" id="collapseExample<?php echo $order_id ?>">
                                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Description</th>                    
                                            <th>Quantity</th>         
                                            <th>Unit Price</th>                                               
                                            <th>Total Price</th>                             
                                        </tr>
                                    </thead>                    
                                    <tbody>                                                          
                                        
                                        <?php 
                                        $id = $_SESSION['userid'];
                                        $sqlku = "SELECT 
                                        costumer_order.costumer_id,
                                        products.product_name,
                                        quantity, 
                                        harga_satuan 
                                    FROM `costumer_order_products` 
                                        INNER JOIN `products` ON costumer_order_products.product_id = products.id
                                        INNER JOIN 	`costumer_order` ON costumer_order_products.order_id = costumer_order.order_id
                                    WHERE costumer_order_products.order_id = $order_id;";
                                        $resultku = mysqli_query($conn, $sqlku);                
                                        if($resultku->num_rows > 0){
                                            // $product_id = array_column($_SESSION['cart'],'product_id');    
                                            while($row = mysqli_fetch_assoc($resultku)){                        
                                                $nama = $row['product_name'];
                                                $tmpSatuan = $row['harga_satuan'];
                                                $jumlah = $row['quantity'];
                                                $total = rupiah($jumlah * $tmpSatuan);
                                                $satuan = rupiah($tmpSatuan);
                                                echo "<tr>
                                                        <td>$nama</td>
                                                        <td>$jumlah</td>
                                                        <td>$satuan</td>
                                                        <td>$total</td>
                                                    </tr>
                                                    ";
                                            }                    
                                        }              
                                        ?>                             
                                        </tr>                    
                                    </tbody>
                                </table>
                            </div>
                        </div>           
                        <hr>
                        <!-- end detailed order  -->
                        
                <?php                     
                    }                    
                }else{
                        echo "<h3 style=\"text-align:center;\">Empty</h3>";
                        // echo mysqli_error($conn);
                }   
                ?>                            
                           
        </div>        
        
        
    </section>
    

<?php     include "costfooter.php"; ?>