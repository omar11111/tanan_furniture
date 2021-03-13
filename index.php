    <?php include_once "header.php";
          include_once'Product.php';

          $product = new Product();
          $result= $product->selectAllData();
          if($result){
            echo 'done';
          }else {
            $something ='
            <div class="alert alert-danger col-10 mx-auto">
              Some Thing Went Wrong 
            </div>';
            echo $something;
          }
    ?>
    <!-- navbar start -->

    <!-- navbar end -->
    </header>
    <!-- slider -->
    <div class="slider col-12 row mx-auto   ">
      <h1 class="text-center slider-title ">TANAN HAVEN OF FURNAITURE</h1>
      <div class="col-12   images image-slider1">

        <div class="col-8 mx-auto content">

          <h1>Tanan For Furniture</h1>
          <p>The Best place for furniture</p>
        </div>
      </div>

      <div class="images image-slider2">

        <div class="col-8 mx-auto content">
          <h1>Many Products </h1>
          <p> Chairs ,Wardrobe and Beds </p>
        </div>
      </div>

      <div class="images    image-slider3">
        <div class="col-8 mx-auto content">

          <h1>Best Workers</h1>
          <p>Haveing Greate Team make Greate Products</p>
        </div>
      </div>

      <div class="images   image-slider4">
        <div class="col-8 mx-auto  content">
          <h1 class="">Bedrooms</h1>
          <p class=" "> modern bedrooms that fit your style and life</p>
        </div>
      </div>

    </div>
    <!-- end slider -->


    <!-- products -->
    <div class="row products col-12 mx-auto   ">

      <div class="card col-10  col-lg-5   ">
        <img class="img-fluid" data-mdb-ripple-color="light" src="images/product1.jpeg" alt="">
        <div class="content p-2">
          <h3 class="">title</h3>
          <p>littel description</p>
          <a class="btn " href="product_details.php?pro=1">More Details</a>
        </div>

      </div>
      
    </div>
    <!-- end card -->

    <!-- about start -->
    <div class="col-12  row about">
      <div class="  left">
        <div class=" content">
          <h1>About Us</h1>
          <p>A small village that started making
            furniture a long time ago and always strives
            to develop until it has become a destination
            for everyone who wants to buy furniture </p>

        </div>
      </div>

      <div class=" right"></div>
    </div>
    <!-- about end -->

    <?php include_once "footer.php"?>