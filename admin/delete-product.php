<?php 

include "includes/header.php" ;


if(isset($_SESSION['userid'])){
    if($_SESSION['role'] == 1){
        $id = $_GET['id'];

        $sql = "DELETE FROM products WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if($result){
            // header("Location: products.php?delete_success=true");
            echo "<script>location.href = 'products.php?delete_success=true'</script>";
        }else{
            echo "<script>location.href = 'products.php?delete_success=false'</script>";
            // header("Location: products.php?delete_success=false");
        }
    }else{
        header("Location: ../index.php");;
    }
}

?>