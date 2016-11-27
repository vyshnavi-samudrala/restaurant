<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]--><head>

   <!--- basic page needs
   ================================================== -->
   <meta charset="utf-8">
	<title>FIND RESTAURANTS</title>


   <!-- mobile specific metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

 	<!-- CSS
   ================================================== -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/main.css">     
	<link rel="stylesheet" href="css/rating.css">     

   <!-- script
   ================================================== -->
	<script src="js/modernizr.js"></script>
    <script src="js/jquery-1.11.3.min.js"></script>

   <!-- favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

	<!-- header
   ================================================== -->
   <header id="main-header" style="position:absolute">

   	<div class="row">

	      <div class="logo">
	         <a href="index.html">Restaurant Finder</a>
	      </div>

	      <nav id="nav-wrap">         
	         
	         <a class="mobile-btn" href="#nav-wrap" title="Show navigation">
	         	<span class="menu-icon">Menu</span>
	         </a>
         	<a class="mobile-btn" href="#" title="Hide navigation">
         		<span class="menu-icon">Menu</span>
         	</a>            

	      </nav> <!-- end #nav-wrap -->
       
          </div>

   </header> <!-- end header -->


   <!-- homepage hero
   ================================================== -->
   <section id="hero" style="min-height:80px;">	
   	  
 	  <div class="hero-content" id="search_bar_container" style="z-index:9999;">
		<div class="container">
			<div class="search_bar">
        <form action="index.php" method="get" id="nav_form" style="margin:0;">
				<select title="Search in" class="searchSelect" id="searchDropdownBox" name="search_city">
                    <option <?php if($_GET['search_city']=='Chennai') echo "selected='selected'";?> value="Chennai"  title="Chennai">Chennai</option>
                    <option <?php if($_GET['search_city']=='Hyderabad') echo "selected='selected'";?> value="Hyderabad" title="Hyderabad">Hyderabad</option>
                    <option <?php if($_GET['search_city']=='Mumbai') echo "selected='selected'";?> value="Mumbai" title="Mumbai">Mumbai</option>
                    <option <?php if($_GET['search_city']=='Delhi') echo "selected='selected'";?> value="Delhi" title="Delhi">Delhi</option>
                    <option <?php if($_GET['search_city']=='Bangalore') echo "selected='selected'";?> value="Bangalore" title="Bangalore">Bangalore</option>
				</select>
                
				<div class="nav-searchfield-outer">
				<input type="text" autocomplete="off" value="<?php echo $_GET['search_rstrnt'];?>" style="padding-left:130px; background-color:#fff;" name="search_rstrnt" placeholder="Find Restaurants...">
				</div>
				<div class="nav-submit-button">
				<input type="submit" id="submit_nav_form" onClick="this.form.submit();" value="Search">
				</div>
		</form>
			</div><!-- End search_bar-->
		</div><!-- End Container-->
	</div><!-- /search_barcontainer-->

   </section> <!-- end homepage hero -->
   

   
     <!-- About us
   ================================================== -->
   <section id="about">
   <div class="container">
	<div class="content">
<?php 
include "inc/config.php";
include "inc/mysqli_funs.php";


$url = $_GET['restaurant'];
$url = explode("-", $url);


$index = array_search("in",$url);
$restaurant = array_slice($url, 0, $index);
end($url);
$key = key($url);
$locality = array_slice($url, $index+1, $key);

$restaurant = join(" ", $restaurant);
$locality = join(" ", $locality);


	$fetcher_obj = new fetcher();
	$rest = "SELECT * FROM restaurant.restaurants WHERE r_name=? and r_locality=?";
	$rest_stmt = $mysqli->prepare($rest);

	if (!$rest_stmt->bind_param("ss", $restaurant, $locality) || !$rest_stmt->execute()) {
		throw new Exception("Database error:". $rest_stmt->errno - $rest_stmt->error);
	}
	$results = $fetcher_obj->fetch_assoc_stmt($rest_stmt);
	$rest_stmt->close();
	//print_r($results);
	
	foreach($results as $result) {
		?>

<div style="width:750px; height:450px; float:left; vertical-align:middle; margin-right:1.2em"><img style="width:100%; height:100%;" src="<?php echo $result['r_picture'];?>"></div>
			<div style="float:left; display:inline-block; vertical-align:top;">                    
                <a href="javascript:void(0);" class="rstrnt_link" style="display:block; font-size:34px">
                    <?php echo $result['r_name']?>
                </a>
			<div class="row" style="display:flex; float:left">  
                <div style="margin-right:2em;">
                    <?php echo $result['r_city'];?>
                </div>
                <div style="display:inline-table">
                    <?php echo $result['r_locality'];?>
                </div>
			</div>
            <div class="row" style="width:100%;">
				<div style="float:left">Overall Rating: &nbsp;</div>
                		<div class="rating" style="font-size:24px">
                                 <?php if($result['overall_rating']==0) { ?>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1
								   elseif($result['overall_rating']==0.5) { ?>
                                    <i class="fa fa-star-half-empty voted"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1
								   elseif($result['overall_rating']==1) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1 
								   elseif($result['overall_rating']==1.5) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-half-empty voted"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1 ?>
                                    
                                 <?php if($result['overall_rating']==2) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1 
								   elseif($result['overall_rating']==2.5) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-half-empty voted"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1 ?>
                                    
                                 <?php if($result['overall_rating']==3) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1 
								  elseif($result['overall_rating']==3.5) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-half-empty voted"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1 ?>
                                    
                                 <?php if($result['overall_rating']==4) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-o"></i>
                                  <?php }//if 1 ?>
                                    
                                 <?php if($result['overall_rating']==4.5) { ?>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star voted"></i>
                                    <i class="fa fa-star-half-empty voted"></i>
                                  <?php }//if 1 ?>
                                    
                                 <?php if($result['overall_rating']==5) { ?>
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
		</div>
        <?php
		$r_id = $result['r_id']; 
	}
?>  
  
  
    </div> <!--End of container -->
</section> <!-- end section about us -->

<?php 
	$feedback = "SELECT * FROM restaurant.reviews_table WHERE r_id=?";
	$feedback_stmt = $mysqli->prepare($feedback);

	if (!$feedback_stmt->bind_param("s", $r_id) || !$feedback_stmt->execute()) {
		throw new Exception("Database error:". $feedback_stmt->errno - $feedback_stmt->error);
	}
	$feedback_results = $fetcher_obj->fetch_assoc_stmt($feedback_stmt);
	$feedback_stmt->close();
?>
<section id="feedback">
   <div class="container">
    <div class="row section-head">

   		<div class="twelve columns">

	         <h1>Reviews<span>.</span></h1>

	         <hr />	        

	      </div>

      </div> <!-- end section-head -->
<div class="row">
<div class="col-md-7 col-md-offset-1" id="reviews_div_sec">
<?php 
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
<?php }//foreach?>
</div>
</div>
<div class="col-md-7 col-md-offset-1" id="leave_feedback">
<?php if(count($feedback_results)) {?>
<hr />
<?php }//display only if there are some feedbacks to differentiate the form?>
	<h4> Leave us a feedback: </h4>
    <form name="reviews_form" id="reviews_form" method="post" action="">
    <input id="rating_stars" name="rating_stars" class="rating" data-size="xs" data-show-clear="false" data-show-caption="false">

        <textarea style="height:50px !important" name="review_text" id="review_text" title="review_text" rows="5"></textarea>

    	<input type="hidden" value="<?php echo $r_id;?>" name="r_id" id="r_id">
        <input type="submit" id="submit_review">
    </form>
</div>

</section>

   <!-- Footer
   ================================================== -->
   <footer>

      <div class="row">  

      	<div class="twelve columns content group">
      		
				<ul class="social-links">
               <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
               <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
               <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>               
            </ul>
      	</div>           

         <div id="go-top">
            <a class="smoothscroll" title="Back to Top" href="#hero">Back to Top<i class="fa fa-angle-up"></i></a>
         </div>

      </div> <!-- end row -->

   </footer> <!-- end footer -->

   <!-- Java Script
   ================================================== --> 
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>


   <script src="js/jquery-1.11.3.min.js"></script>
   <script src="js/rating_stars.js"></script>
<script type="text/javascript">
$(function() {
	$('#submit_review').on('click', function (event) {
		event.preventDefault();
		//var da = $("#reviews_form").find('input, select, textarea, button').serialize();
//alert($('textarea#review_text').text());

		$.ajax({
			async: true,
            type: 'post',
            url: 'rating.php',
			data: $("#reviews_form").find('input, select, textarea, button').serialize(),
			//data: {r_id: $('#r_id').val(),review_text: $('textarea#review_text').val(),rating_stars: $('#rating_stars').val()},
 		error: function(req, err){ console.log('my message ' + err); },
	    success: function (data) {
               // alert('form was submitted');
			   $("#reviews_form")[0].reset();
			   //$("#leave_feedback").html("Thank you for leaving us feedback");
			   
				$('#reviews_div_sec').append( data );
				console.log(data);
            },
      complete: function(){
       // $('#loading').hide();
      }
          });
		  
	 });
});
</script>

<script type="text/javascript">
$( ".nav-submit-button" ).click(function() {
	$("#nav_form").submit();
});
</script>

<script>
$(function() {
	$("#rating_stars").rating();
});
</script>
</body>

</html>