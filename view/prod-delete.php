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
} elseif(isset($prodInfo['categoryId'])){
    if($category['categoryId'] === $prodInfo['categoryId']){
     $productList .= ' selected ';
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
                <h1 class="padding"><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?></h1>
                <p>Confirm Product Deletion. The delete is permanent.</p>


                <form method="POST" action="/acme/products/">

                   <label class="block" for="invName">Product Name
                        <input class="block" type="text" name="invName" id="invName" title="Inventory Name" readonly 
                        <?php if(isset($prodInfo['invName'])){ echo "value='$prodInfo[invName]'"; }?>>
                   </label>
                   <label>&nbsp;</label>
                   <label class="block">Product Description
                        <textarea class="block"  name="invDescription" id="invDescription" title=" Inventory Description" rows="10" readonly > 
                            <?php if(isset($prodInfo['invDescription'])){ echo $prodInfo['invDescription']; }?>
                        </textarea>
                  
                        <input class="block" type="submit" name="submit" value="Delete Product">
                        <input type="hidden" name="action" value="deleteProduct">
                        <input type="hidden" name="invId" 
                        value=" <?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} ?>">
                </form>
            
                    
            </main>
            <hr class="footer">
  
       
                <?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/footer.php'?>