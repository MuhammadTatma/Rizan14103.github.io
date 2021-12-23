<?php 

include "includes/header.php" ;


if(isset($_SESSION['userid'])){
    if($_SESSION['role'] == 1){
        $id = $_GET['id'];
        $sql = "UPDATE costumer_order SET order_status = 'finished' WHERE order_id = $id";                
        $result = mysqli_query($conn, $sql);
        if($result){
            // header("Location: products.php?delete_success=true");
            echo "<script>location.href = 'dimasak.php?move_success=true'</script>";
        }else{
            echo "<script>location.href = 'dimasak.php?move_success=false'</script>";
            // header("Location: products.php?delete_success=false");
        }
    }else{
        header("Location: ../index.php");;
    }
}

?>