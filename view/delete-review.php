
            <?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/header.php'?>
          <nav class="bg_red"><?php echo $navigation; ?></nav>
            <main>

            <?php if(isset($message)){echo$message;}?>

                <form  action="/acme/reviews/index.php"  method="POST">
   <fieldset>
       <legend>DELETE your reviews</legend>
    <label>
    <textarea class="block" name="updateText" id="updateText" title="Review Text Box" disabled><?php if(isset($reviewArray['0']['reviewText'])){echo $reviewArray['0']['reviewText'];} ?></textarea>
    </label>
    <input class="block button" type="submit" name="submit"  value="DELETE!" >
    <input type="hidden" name="action" value="Delete">
    <input type="hidden" name="clientId" value="<?php echo$_SESSION['clientData']['clientId'];?>">
    <input type="hidden" name="reviewId" value="<?php echo $reviewArray['0']['reviewId'] ;?>">
    </fieldset>
    </form>
            
                    
            </main>
            <hr>
  
       
                <?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/footer.php'?>