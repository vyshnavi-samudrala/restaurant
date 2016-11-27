<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

   <!--- basic page needs
   ================================================== -->
   <meta charset="utf-8">
	<title>FIND RESTAURANTS</title>


   <!-- mobile specific metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

 	<!-- CSS
   ================================================== -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/main.css">     

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
   <section id="hero">	
   	  
 	  <div class="hero-content" id="search_bar_container" style="z-index:9999;">
		<div class="container">
			<div class="search_bar">
        <form action="" method="get" id="nav_form" style="margin:0;">
				<select title="Search in" class="searchSelect" id="searchDropdownBox" name="search_city">
                    <option hidden selected>Select City</option>
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
    <div class="row section-head">

   		<div class="twelve columns">

	         <h1>Restaurants<span>.</span></h1>

	         <hr />	        

	      </div>

      </div> <!-- end section-head -->
	<div class="content">
<?php 
include "inc/config.php";
include "inc/mysqli_funs.php";


$city = $_GET['search_city'];
$restaurant = $_GET['search_rstrnt'];


	$fetcher_obj = new fetcher();
if($city!=''){
	$rest = "SELECT * FROM restaurant.restaurants WHERE r_city=?";
	$rest_stmt = $mysqli->prepare($rest);

	if (!$rest_stmt->bind_param("s", $city) || !$rest_stmt->execute()) {
		throw new Exception("Database error:". $rest_stmt->errno - $rest_stmt->error);
	}
}
else {
	$rest = "SELECT * FROM restaurant.restaurants";
	$rest_stmt = $mysqli->prepare($rest);

	if (!$rest_stmt->execute()) {
		throw new Exception("Database error:". $rest_stmt->errno - $rest_stmt->error);
	}
}
	$results = $fetcher_obj->fetch_assoc_stmt($rest_stmt);
	$rest_stmt->close();
	//print_r($results);
	
	foreach($results as $result) {
		$url = strtolower(str_replace(" ", "-", $result['r_name']))."-in-".strtolower(str_replace(" ", "-", $result['r_locality']));
		?>

		<div class="col-md-7 col-md-offset-1">
			<div class="panel panel-default rstrnts_div">
			<div class="panel-heading" style="background-color:transparent; border:none; display:inline-block; position:relative">
                    <div style="width:250px; height:150px; float:left; vertical-align:middle; margin-right:1.2em"><img style="width:100%; height:100%;" src="<?php echo $result['r_picture'];?>"></div>
			<div style="float:left; display:inline-block; vertical-align:top;">                    
                <a href="restaurant.php?restaurant=<?php echo $url;?>" class="rstrnt_link" style="display:block">
                    <?php echo $result['r_name']?>
                </a>
			<div class="row" style="display:flex">  
                <div style="margin-right:2em;">
                    <?php echo $result['r_city'];?>
                </div>
                <div style="display:inline-table">
                    <?php echo $result['r_locality'];?>
                </div>
			</div>
            <div class="row" style="display:flex">
				<div class="rating">
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
			</div>
		</div>
        <?php
	}
?>  
  
    </div>
    </div> <!--End of container -->
</section> <!-- end section about us -->


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
   <script src="js/jquery-1.11.3.min.js"></script>
   <script src="js/jquery-migrate-1.2.1.min.js"></script>
   <script src="js/jquery.flexslider-min.js"></script>
   <script src="js/jquery.waypoints.min.js"></script>
   <script src="js/jquery.validate.min.js"></script>
   <script src="js/jquery.fittext.js"></script>
   <script src="js/jquery.placeholder.min.js"></script>


<script type="text/javascript">
$( ".nav-submit-button" ).click(function() {
	$("#nav_form").submit();
});
</script>
</body>

</html>