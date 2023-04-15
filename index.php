<?php include('partials-front/menu.php');?>

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

            <?php
                if(isset($_SESSION['order']))
                {
                    echo $_SESSION['order'];
                    unset ($_SESSION['order']);
                }
            ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //create query to display categories from db
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count > 0)
                {
                    while ($row = mysqli_fetch_assoc($res)) 
                    {
                        //get id
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                //check if image is available
                                if($image_name=="")
                                {
                                    echo "<div class='error'>Image not Available</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                    <?php

                                }
                                ?>

                                <h3 class="float-text"><?php echo $title;?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu" style="background-color:#1c1924">
        <div class="container" style="background-color:#1c1924">
            <h2 class="text-center">Food Menu</h2>

            <?php

                //Get foods from db
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2 > 0)
                {
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];
                        ?>

                        <div class="food-menu-box">
                                        <div class="food-menu-img" style="background-color:transparent;">
                                        <?php 
                                            //check image availability
                                            if($image_name=="")
                                            {
                                                echo "<div class='error'>Image not Available</div>";
                                            }
                                            else
                                            {
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name ?>" class="img-responsive img-curve">
                                                <?php
                                            }
                                        
                                        ?>
                                           
                                        </div>

                                        <div class="food-menu-desc">
                                            <h4 style="background-color:transparent; color:#1c1924"><?php echo $title; ?></h4>
                                            <p style="background-color:transparent; color:#1c1924" class="food-price"><?php echo $price; ?>/=</p>
                                            <p style="background-color:transparent; color:#1c1924" class="food-detail">
                                            <?php echo $description; ?>
                                            </p>
                                            <br>

                                            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id ?>" class="order-link">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                {
                    echo "<div class='error'>.</div>";
                }

            ?>


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center" style="margin-top: 20px">
            <a href="#" class="see">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

 <?php include('partials-front/footer.php'); ?>