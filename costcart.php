<?php 

include "costheader.php";


$arrayku = array();
// $arr_order= array();
// $_SESSION['array_order'] = $arr_order;



?>

<!-- shopping-cart section  -->
<script>    
    var arr = [];        
</script>
<section class="shopping-cart-container">
        <div class="products-container">
            <h3 class="title">your products</h3>

            <div class="box-container">
                
                <?php 
                $total = 0 ;
                $result = getCart($conn, $_SESSION['userid']);                
                // var_dump($result->num_rows > 0);    
                // var_dump($result->num_rows);                  
                if($result->num_rows > 0){
                    // $product_id = array_column($_SESSION['cart'],'product_id');    
                    $_SESSION['array_order'] = array();
                    while($row = mysqli_fetch_assoc($result)){
                        food_keranjang($row['product_name'], $row['product_price'],$row['product_image'], $row['id']);
                        $total = $total+(int)$row['product_price'];

                        $id = $row['id'];
                        $satuan = $row['product_price'];
                        $jumlahAwal = 1;
                        // echo $id;
                        // $_SESSION['array_order'] += array($id => $jumlahAwal);
                        echo "
                            <script>
                                var temp = {
                                    \"productID\": $id,
                                    \"satuan\": $satuan,
                                    \"jumlah\": $jumlahAwal
                                };
                                arr.push(temp);                                
                            </script>
                        ";                        
                        
                    }                    
                }else{
                        echo "<h3 style=\"text-align:center;\">Cart is Empty</h3>";
                }
                                
                ?>
                <script>                    
                    console.log(arr);
                    
                </script>
            </div>
        </div>        

        <div class="cart-total">
            <h3 class="title">cart total</h3>

            <div class="box">
                <h3 class="subtotal">Delivery : <span> Rp.- </span></h3>
                <h3 class="total">total : <?php 
                $temp = rupiah($total);
                echo "<span id=\"total\">$temp</span>";
                ?></h3>

                <span id="checkout"  class="btn">proceed to checkout</span>
                <input type="hidden" id="totalhidden" value="<?php echo $total ?>">
            </div>
        </div>        
    </section>
    <script>
        const format_rupiah = (number)=>{
            return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR"
            }).format(number);
        };

        function updateArr(arr, id , plusOrmin){
            //cari indeksnya
            indexnya = arr.findIndex((obj => obj.productID == id));
            // console.log("sebelum update: ", arr[indexnya])


            if(plusOrmin == "plus"){
                arr[indexnya].jumlah += 1; 
            }else{
                arr[indexnya].jumlah -= 1;
            }

            // console.log("setelah update: ", arr[indexnya])
        }
        $(document).ready(function(){            
            $("#checkout").click(function(){
                $.post("checkout.php", {pesenan: JSON.stringify(arr)}, function(data,status){
                    console.log("Data: " + data + "\nStatus: " + status);
                    if(status == "success"){
                        setTimeout(function () { new swal("Berhasil","Pesanan Berhasil Masuk Antrian","success");}, 1000);
                        $(".box-container").html('<h3 style=\"text-align:center;\">Cart is Empty</h3>');
                        $(".total").html('Rp. 0,00');
                    }else{
                        setTimeout(function () { new swal("Error","Ada yang salah","error");}, 1000);
                    }

                }) 
                
            });
            
        });
        

        var tombolKurang = document.getElementsByClassName('kurang');
        var tombolTambah = document.getElementsByClassName('tambah');        
        var totalSpan = document.getElementById('total');
        var totalPrice = document.getElementById('totalhidden');
        var totalPriceValue = totalPrice.value;
        var current = totalPriceValue;

        for(var i = 0 ; i < tombolKurang.length; i++){
            var button = tombolKurang[i];
            button.addEventListener('click', function(event){

                var buttonClicked = event.target;        
                var input = buttonClicked.parentElement.children[2];
                var price = buttonClicked.parentElement.children[4];
                var idproduk = buttonClicked.parentElement.children[5].value;
                var inputValue = input.value;
                var priceValue = price.value;
                var newInputValue = parseInt(inputValue) - 1;
                if(newInputValue == 0 ){
                    newInputValue = 1;
                }else{
                    input.value = newInputValue;
                    newTotalValue = parseInt(current) - parseInt(priceValue);
                    current = newTotalValue;
                    totalSpan.innerText = format_rupiah(newTotalValue);
                    updateArr(arr, idproduk , "min");                    
                }        
                
                console.log(arr);
                console.log('<?php echo json_encode($arrayku); ?>');
                                
            });
        };

        for(var i = 0 ; i < tombolTambah.length; i++){
            var button = tombolTambah[i];
            button.addEventListener('click', function(event){        
                var buttonClicked = event.target;
                var input = buttonClicked.parentElement.children[2];
                var price = buttonClicked.parentElement.children[4];
                var idproduk = buttonClicked.parentElement.children[5].value;
                var inputValue = input.value;
                var priceValue = price.value;
                var newInputValue = parseInt(inputValue) + 1;
                input.value = newInputValue;
                newTotalValue = parseInt(current) + parseInt(priceValue);
                current = newTotalValue;
                totalSpan.innerText = format_rupiah(newTotalValue);
                updateArr(arr, idproduk , "plus");
                console.log(arr);
            });
        };

        
    </script>

    <?php include "costfooter.php" ?>  