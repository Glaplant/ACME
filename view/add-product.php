<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}
?>
<?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/header.php'?>

<?php 

//Get the array of categories
 $categories = getCategories();

// Build a dynamic drop-down list
$productList = '<select name="categoryId" id="categoryId">';
$productList .= "<option>Product Category</option>";
foreach ($categories as $category) {
$productList .= "<option value ='$category[categoryId]'"; 
    if(isset($categoryId)){

    if($category['categoryId'] === $categoryId){
        $productList .=' selected ';

    }
}
    


$productList .= ">$category[categoryName]</option>";
}
$productList .= '</select>';
?>



<nav class="bg_red"><?php echo $navigation; ?></nav>
            <main>
            <?php 
        if(isset($message)){
            echo $message;
        }
        ?>
                <h1 class="padding">Add Product</h1>
                <p> Add a new product below. All fields are required!</p>


                <form method="POST" action="/acme/products/index.php">

                   <label class="block">Product Name
                        <input class="block" type="text" name="invName" id="invName" title="Inventory Name" <?php if(isset($invName)){echo "value='$invName'";}?> required>
                   </label>
                   <label class="block">Product Description
                        <textarea class="block"  name="invDescription" id="invDescription" title=" Inventory Description" rows="10"   required><?php if(isset($invDescription)){echo "$invDescription";}?></textarea>
                   </label>
                   <label class="block">Product Image (path to image)
                       <input class="block" type="text" name="invImage" value="acme/images/no-image.png" id="invImage" title="Product Image" required>
                   </label>
                   <label class="block">Product Thumbnail (path to thumbnail)
                         <input class="block" type="text" name="invThumbnail" value="acme/images/no-image.png" id="invThumbnail" title="Product Thumbnail" required>
                   </label>
                   <label class="block">Product Price  $
                        <input class="block" type="number" name="invPrice" id="invPrice" min="0" max="99999999.99" step="0.01" title="Price in Dollars" placeholder="$0.00" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?>required>
                    </label>
                    <label class="block">Product Stock
                        <input class="block" type="number" name="invStock" id="invStock" min="0" step="1" title="Stock Number" <?php if(isset($invStock)){echo "value='$invStock'";}  ?> required>
                    </label>
                    <label class="block">Product Size
                         <input class="block" type="number" name="invSize" id="invSize" min="0" step="1" title="Product Size" <?php if(isset($invSize)){echo "value='$invSize'";}  ?> required>
                    </label>
                    <label class="block">Product Weight
                        <input class="block" type="number" name="invWeight" id="invWeight" min="0" step="1" title="Weight in pounds" <?php if(isset($invWeight)){echo "value='$invWeight'";}  ?> required>
                    </label>
                    <label class="block">Product Location
                        <input class="block" type="text" name="invLocation" id="invLocation" title="Location of Product" <?php if(isset($invLocation)){echo "value='$invLocation'";}  ?> required>
                   </label>
                   <label class="block">Product Id <?php echo $productList;?>
                   </label>
                   <label class="block">Product Vendor
                        <input class="block" type="text" name="invVendor" id="invVendor" title="Vendor's Name" <?php if(isset($invVendor)){echo "value='$invVendor'";}  ?> required>
                   </label>
                   <label class="block">Product Style
                        <input class="block" type="text" name="invStyle" id="invStyle" title="Style of Product" <?php if(isset($invStyle)){echo "value='$invStyle'";}  ?> required>
                   </label>
                        <input class="block" type="submit" name="submit" value="Add Product">
                        <input type="hidden" name="action" value="newProduct">
                </form>
            
                    
            </main>
            <hr class="footer">
  
       
                <?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/footer.php'?>