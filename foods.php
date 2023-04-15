<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL;?>food-search.php" method="POST" style="width:600px; height: 50px; border-radius:20px;">
                <input type="search" name="search" placeholder="Search for Food.." required>
                
                <input type="submit" name="submit" value="Search" class="btn btn-primary" style="margin-top: 80px; width:100px; height:40px;">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>

                    <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <?php
                                        if($image_name=="")
                                        {
                                            echo"<div class='error'>Image Not Available.</div>";
                                        }
                                        else
                                        {
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" class="img-responsive img-curve">
                                            <?php
                                        }

                                        ?>
                                        
                                    </div>

                                    <div class="food-menu-desc">
                                        <h4 class="food-title"><?php echo $title;?></h4>
                                        <p class="food-price"><?php echo $price;?></p>
                                        <p class="food-detail">
                                        <?php echo $description;?>
                                        </p>
                                        <br>

                                        <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id ?>" class="order-link">Order Now</a>
                                    </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Food Not Found.</div>";
                }
            ?>

          

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>