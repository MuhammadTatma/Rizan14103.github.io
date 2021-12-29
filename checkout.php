<?php 
include "costheader.php";
$pesenan = json_decode($_POST['pesenan'],true);


// echo json_encode($pesenan);
$total = 0;
foreach($pesenan as $iter ){    
    $total += $iter['satuan']*$iter['jumlah'];
}


session_start();

if(isset($_SESSION['userid'])){
    $date = date("Y-m-d");
    $costumer_id = $_SESSION['userid'];
    $sqlInsert = "INSERT INTO  costumer_order (costumer_id,date_created,total_order_price,order_status) VALUES ($costumer_id, '$date', $total, 'Waiting')";
    $result = mysqli_query($conn, $sqlInsert);         
    $sql = "SELECT  MAX(order_id) FROM costumer_order where costumer_id = $costumer_id AND DATE(date_created) = '$date' ;";
    $result = mysqli_query($conn, $sql);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $order_id = $row['MAX(order_id)'];
        foreach($pesenan as $iter ) {             
            $tempId = $iter['productID'];
            $tempJumlah = $iter['jumlah'];
            $tempSatuan = $iter['satuan'];
            $sql = "INSERT INTO costumer_order_products (order_id,product_id,quantity,harga_satuan) VALUES ($order_id,$tempId,$tempJumlah,$tempSatuan);";
            mysqli_query($conn,$sql);
        }
        $sql = "DELETE FROM cart WHERE user_id = $costumer_id";
        mysqli_query($conn,$sql);        
    }else{        
    }
}






?>