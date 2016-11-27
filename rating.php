<?php 
echo $review = $_POST['review_text'];
//echo "<br>";
echo $r_id = json_decode($_POST['r_id'], true);
echo $stars = json_decode($_POST['rating_stars'], true);

/*	$feedback = "INSERT INTO restaurant.reviews_table (r_id, stars, reviews_text) VALUES (?, ?, ?)";
	$feedback_stmt = $mysqli->prepare($feedback);

	if (!$feedback_stmt->bind_param("ids", $r_id, $stars, $review) || !$feedback_stmt->execute()) {
		throw new Exception("Database error:". $feedback_stmt->errno - $feedback_stmt->error);
	}
	//$results = $fetcher_obj->fetch_assoc_stmt($feedback_stmt);
	$feedback_stmt->close();*/
	
?>

