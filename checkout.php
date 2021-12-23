<?php 

include 'php/config.php';
session_start();

if(isset($_SESSION['userid'])){
    $total = 0 ;
    $date = date("Y-m-d");    
    $costumer_id = $_SESSION['userid'];    
    $sql = "SELECT user_id , products.id, product_name, product_price, product_image 
    FROM `products` 
    INNER JOIN cart ON cart.product_id = products.id
    WHERE user_id = $costumer_id;";
    $result = mysqli_query($conn, $sql); 
    $arr = array();       
    // var_dump("test") ;                      
    if($result->num_rows > 0){           
        while($row = mysqli_fetch_assoc($result)){
            $product_id = $row['id'];          
            array_push($arr,$product_id);
            $total = $total+(int)$row['product_price'];
        }                 
        // var_dump($total);
        $sqlInsert = "INSERT INTO  costumer_order (costumer_id,date_created,total_order_price,order_status) VALUES ($costumer_id, '$date', $total, 'Waiting')";
        $result = mysqli_query($conn, $sqlInsert);         
        $sql = "SELECT  MAX(order_id) FROM costumer_order where costumer_id = $costumer_id AND DATE(date_created) = '$date' ;";
        $result = mysqli_query($conn, $sql);         
        if($result){            
            $row = mysqli_fetch_assoc($result);
            $order_id = $row['MAX(order_id)'];
            var_dump($arr);
            for ($i=0; $i < count($arr) ; $i++) { 
                $temp = $arr[$i];
                $sql = "INSERT INTO costumer_order_products (order_id,product_id) VALUES ($order_id,$temp);";
                mysqli_query($conn,$sql);
            }
            $sql = "DELETE FROM cart WHERE user_id = $costumer_id";
            mysqli_query($conn,$sql);
            echo "<script>location.href = 'welcome.php?checkout_success=true'</script>";
        }else{
            var_dump(mysqli_error($conn));
            echo "<script>location.href = 'welcome.php?checkout_success=false'</script>";            
        }
       
    }else{
        // echo "<script>location.href = 'welcome.php?checkout_success=false'</script>";
    }    
}else{
    var_dump($_SESSION['userid']) ; 
}

?>