
<?php include "includes/header.php" ?>

<script>
    var tempArray= [];
</script>
<?php 
    $sql = "SELECT 
            SUM(total_order_price) AS total,
            MONTH(date_created) AS bulan,
            YEAR(date_created) AS tahun
        FROM `costumer_order`     
        WHERE order_status = 'finished' 
        GROUP BY YEAR(date_created),MONTH(date_created);";
    $result = mysqli_query($conn,$sql);
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $total = $row['total'];
            $bulan = $row['bulan'];
            $tahun = $row['tahun'];
            echo "
                <script>                                            
                    tempArray.push({
                        \"jumlah\": $total,
                        \"bulan\": $bulan,   
                        \"tahun\": $tahun   

                    });                                                                      
                </script>
            ";                                                         
        }
    }else{
        var_dump(mysqli_error($conn));
    }


    $date = date("Y-m-d");
    $sql = "SELECT 
                SUM(CASE WHEN order_status = \"finished\" THEN total_order_price ELSE 0 END) AS \"sum\",
                SUM(CASE WHEN order_status = \"Waiting\" THEN 1 ELSE 0 END) AS \"waiting\" ,
                SUM(CASE WHEN order_status = \"finished\" THEN 1 ELSE 0 END) AS \"finished\",
                SUM(CASE WHEN order_status = \"ongoing\" THEN 1 ELSE 0 END) AS \"ongoing\"
         FROM `costumer_order` WHERE date_created = '$date' ";
    $result = mysqli_query($conn,$sql);
    
    if($result){
        $row = mysqli_fetch_assoc($result);
        $sum = $row['sum'];
        $waiting = $row['waiting'];
        $finished = $row['finished'];
        $ongoing = $row['ongoing'];
        if($sum==null){$sum = 0;}
        if($waiting==null){$waiting = 0;}
        if($finished==null){$finished = 0;}
        if($ongoing==null){$ongoing = 0;}
        
        
        echo "
                <script>                                            
                    var todaySumEarning = $sum;  
                    var todayWaitingOrder = $waiting;
                    var todayFinishedOrder = $finished;
                    var todayOngoingOrder =  $ongoing;                                                              
                </script>
            ";          
    }else{
        var_dump(mysqli_error($conn));
    }

    //top product and less desirable
    $bulan = date("n");
    $year = date("Y");
    $sql = "SELECT 
                a.product_name, 
                b.total 
            FROM products  a LEFT JOIN 
                (
                        SELECT 
                            costumer_order.date_created AS date, 
                            costumer_order_products.product_id AS prodID,
                            SUM(costumer_order_products.quantity) AS total            
                        FROM `costumer_order_products` RIGHT JOIN costumer_order ON costumer_order_products.order_id = costumer_order.order_id  
                        GROUP BY YEAR(costumer_order.date_created),MONTH(costumer_order.date_created), prodID 
                        HAVING YEAR(costumer_order.date_created) = $year AND MONTH(costumer_order.date_created) = $bulan
                        ORDER BY `costumer_order`.`date_created` DESC
                ) b ON a.id = b.prodID  
            ORDER BY `b`.`total`  DESC";
    $result = mysqli_query($conn,$sql);
    
    if($result){
        $myArray = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($myArray,$row);
        }        
    }else{
        var_dump(mysqli_error($conn));
    }

    if($bulan == 1){
        $prevMonth = 12;
        $prevYear = $year-1;        
    }else{
        $prevMonth = $bulan - 1;
        $prevYear = $year;
    }
    $sql = "SELECT 
                a.product_name, 
                b.total 
            FROM products  a LEFT JOIN 
                (
                        SELECT 
                            costumer_order.date_created AS date, 
                            costumer_order_products.product_id AS prodID,
                            SUM(costumer_order_products.quantity) AS total            
                        FROM `costumer_order_products` RIGHT JOIN costumer_order ON costumer_order_products.order_id = costumer_order.order_id  
                        GROUP BY YEAR(costumer_order.date_created),MONTH(costumer_order.date_created), prodID 
                        HAVING YEAR(costumer_order.date_created) = $prevYear AND MONTH(costumer_order.date_created) = $prevMonth
                        ORDER BY `costumer_order`.`date_created` DESC
                ) b ON a.id = b.prodID  
            ORDER BY `b`.`total`  DESC";
    $result = mysqli_query($conn,$sql);
    
    if($result){
        $arrPrev = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($arrPrev,$row);
        }        
    }else{
        var_dump(mysqli_error($conn));
    }
?>  

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</button>

        <!-- Modal -->
        <div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Generate Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form action="generatePDF.php" method="GET" target="_blank" id="myform">
                        <div class="modal-body d-flex justify-content-center flex-column">
                            <div class="form-group">
                                <label for="monthpicker">Select month</label>
                                <input type="text" class="form-control w-25 text-center" name="monthpicker" id="monthpicker" aria-describedby="monthpicker"/>
                            </div>                            
                                
                            <div class="form-group">
                                <label for="insight">Insight for the period:</label>
                                <textarea class="form-control" name="insight" form="myform" rows="5" id="insight"></textarea>
                            </div> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" >Generate</button>
                        </div>
                    </form>      
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Earnings (Daily)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="earning-daily">Rp 0,00</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Earnings (Monthly)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="earning-monthly">Rp 0,00</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Orders
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="total-order">0</div>
                                </div>                                
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                On Proses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="on-proses">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                    <div class="d-flex flex-row align-items-center">
                        <input type="text" style="width:4rem;" class="form-control" name="datepicker" id="datepicker" />
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Cash On Demand
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> In Restaurant
                        </span>                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top Products</h6>
                </div>
                <div class="table-responsive px-2">
                    <table class="table table-hover " >
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Description</th>
                            <th scope="col">number of sell<th>                                                      
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            
                            $num = count($myArray);
                            // var_dump($num);
                            for ($i=0; $i < 5; $i++) { 
                                $temp = $myArray[$i];
                                $tempPrev = $arrPrev[$i];
                            ?>
                                <tr>
                                    <td><?php echo $i+1 ?></td>
                                    <td><?php echo $temp['product_name'] ?></td>
                                    <td class="d-flex justify-content-between"><?php 
                                    if($temp['total'] == null){
                                        $temp['total']=0; 
                                        echo 0;
                                    }else{
                                        echo $temp['total'];
                                    }  

                                    $selisih = $temp['total']-$tempPrev['total'];
                                    if($selisih < 0){
                                        $val = abs($selisih);
                                        echo "<small class=\"text-danger font-weight-bold\">-$val</small>";
                                    }else{
                                        echo "<small class=\"text-success font-weight-bold\">+$selisih</small>";
                                    }
                                    ?>                                    
                                </tr>

                            <?php     
                            }
                            ?>
                            
                                                        
                        </tbody>
                    </table>
                </div>
                
            </div>    
            
              
            

        </div>

        <div class="col-lg-6 mb-4">

            <!-- Less Desirable -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Less Desirable Products</h6>
                </div>
                <div class="table-responsive px-2">
                    <table class="table table-hover " >
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Description</th>
                            <th scope="col">number of sell</th>                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $num = count($myArray);
                            // var_dump($num);
                            $count = 1;
                            for ($i=$num-1 ; $i >= $num - 5; $i--) { 
                                $temp = $myArray[$i];
                                $tempPrev = $arrPrev[$i];

                            ?>
                                <tr>
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $temp['product_name'] ?></td>
                                    <td class="d-flex justify-content-between"><?php 
                                    if($temp['total'] == null){
                                        $temp['total']=0; 
                                        echo 0;
                                    }else{
                                        echo $temp['total'];
                                    }  

                                    $selisih = $temp['total']-$tempPrev['total'];
                                    if($selisih < 0){
                                        $val = abs($selisih);
                                        echo "<small class=\"text-danger font-weight-bold\">-$val</small>";
                                    }else{
                                        echo "<small class=\"text-success font-weight-bold\">+$selisih</small>";
                                    }
                                    ?> </tr>

                            <?php   
                            $count++;  
                            }
                            ?>
                            
                                                        
                        </tbody>
                    </table>
                </div>
                
            </div>              

        </div>
    </div>

</div>


</div>
<!-- End of Main Content -->

<?php include "includes/footer.php" ?>

