
<?php include_once "header.php";
include_once "Product.php";
$pro = new Product;

if ($_GET) {
    if (isset($_GET['pro'])) {
        $productId = $_GET['pro'];
        $pro->setId($productId);
        $pros = $pro->getProById();
        if (!empty($pros)) {
            $product = $pros->fetch_object();
            
        } else {
            header('Location:404.php');
        }
    }
}
?>

        <div class="product-details row col-12">

            <div class="details col-12 py-xs-0 col-md-5">

                <div class="content">
                    <h2 class=""><?php echo $product->name_en ?></h2>
                    <h3 class=""> Price:- <span style="font-size: 20px;"><?php echo $product->price ?></span> </h3>
                    <label class="me-2" style="font-size: 20px;" for="quantity">Quantity</label>
                    <input class="px-2 rounded" type="number" name="quantity" id="">
                    <button class="btn  col-3 d-block my-2 ">Buy</button>
                </div>

            </div>

            <div class="image col-12 col-md-7 ">
                <img class="col-12" src="images/<?php echo $product->photo ?>" alt="" srcset="">
            </div>
        </div>


        <?php include_once "footer.php"?>

    </main>


   