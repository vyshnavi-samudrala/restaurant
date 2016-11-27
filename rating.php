<?php 
include "inc/config.php";
include "inc/mysqli_funs.php";


$review = $_POST['review_text'];
//echo "<br>";
$r_id = json_decode($_POST['r_id'], true);
$stars = json_decode($_POST['rating_stars'], true);

	$feedback = "INSERT INTO restaurant.reviews_table (r_id, stars, reviews_text) VALUES (?, ?, ?)";
	$feedback_stmt = $mysqli->prepare($feedback);

//print_r($feedback_stmt);
	if (!$feedback_stmt->bind_param("ids", $r_id, $stars, $review) || !$feedback_stmt->execute()) {
		throw new Exception("Database error:". $feedback_stmt->errno - $feedback_stmt->error);
	}

	$last_id = $feedback_stmt->insert_id;
	$feedback_stmt->close();
	
	



	$fetcher_obj = new fetcher();
	$new_feedback = "SELECT * FROM restaurant.reviews_table where rev_id = ?";
	$new_feedback_stmt = $mysqli->prepare($new_feedback);

//print_r($feedback_stmt);
	if (!$new_feedback_stmt->bind_param("i", $last_id) || !$new_feedback_stmt->execute()) {
		throw new Exception("Database error:". $new_feedback_stmt->errno - $new_feedback_stmt->error);
	}
	
	$feedback_results = $fetcher_obj->fetch_assoc_stmt($new_feedback_stmt);
	$new_feedback_stmt->close();
//print_r($feedback_results);

	foreach($feedback_results as $feedback) {
?>

<div class="panel" style="border:1px solid #BCBCBC">
	<div class="panel-heading" style="background-color:#15191d; width:100%;">
    	"<?php echo $feedback['reviews_text'];?>"
		<div class="rating" style="float:right; font-size:18px;">
                                 <?php if($feedback['stars']==0) { ?>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1
								   elseif($feedback['stars']==0.5) { ?>
                                    <i class="fa fa-star-half-empty voted"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1
								   elseif($feedback['stars']==1) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1 
								   elseif($feedback['stars']==1.5) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-half-empty voted"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1 ?>
                                    
                                 <?php if($feedback['stars']==2) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1 
								   elseif($feedback['stars']==2.5) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-half-empty voted"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1 ?>
                                    
                                 <?php if($feedback['stars']==3) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1 
								  elseif($feedback['stars']==3.5) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-half-empty voted"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1 ?>
                                    
                                 <?php if($feedback['stars']==4) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1 ?>
                                    
                                 <?php if($feedback['stars']==4.5) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-half-empty voted"></i>
                                  <?php }//if 1 ?>
                                    
                                 <?php if($feedback['stars']==5) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                  <?php }//if 1 ?>
                                    
                                    <small></small>
                                </div>                
    </div>
</div>

<?php			
		} 
?>
