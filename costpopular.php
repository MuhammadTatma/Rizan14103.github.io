<!-- popular section starts  -->

<section class="popular" id="popular">
        <div class="heading">
            <span>popular food</span>
            <h3>our special dishes</h3>
        </div>

        <div class="box-container">
            <?php 
            $sql = "SELECT *FROM products WHERE id > 4";

            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    food_popular($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
                }
            }
            ?>
        </div>
    </section>

    <!-- popular section ends -->