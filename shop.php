<?php 
  include_once 'header.php';
  
 
?>


<div class="about-home col-12  text-center">
    <div class="content  ">
        <h1>All Product</h1>
        <p>All What you want in your apartment is with us</p>
    </div>
</div>
<?php
    include_once "Product.php";
    $pro = new Product;
    if ($_GET) {
        if (isset($_GET['sub'])) {
            //         // get all products iniside this sub
            $pro->setSubCategoryId($_GET['sub']);
            $resultp = $pro->selectPorductsSub();
        }
    } else {
        $resultp = $pro->selectAllData();
    }
    if ($resultp) {
        $products = $resultp->fetch_all(MYSQLI_ASSOC);
     ?>
<div class="row products col-12 mx-auto   ">
    <?php   foreach ($products as $key => $value) {
    ?> 
    <div class="card col-10  col-lg-5   ">
        <img class="img-fluid" data-mdb-ripple-color="light" src="images/<?php echo $value['photo']?>" alt="">
        <div class="content p-2">
            <h3 class="">
                  <?php echo $value['name_en'] ?>
            </h3>
            <a class="btn " href="product_details.php?pro=<?php echo $value['id'] ?>">More Details</a>
        </div>

    </div>
    <?php
    }
} else {
    echo "<div  class = 'alert alert-warning'> No Products Found </div>";
}

?>
</div>



<?php include_once 'footer.php';?>