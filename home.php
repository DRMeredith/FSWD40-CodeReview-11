<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';

 // if session is not set this will redirect to login page
 if( !isset($_SESSION['myuser']) ) {
  header("Location: index.php");
  exit;
 }
 // select logged-in users detail
 $res=mysqli_query($conn, "SELECT * FROM user WHERE user_id=".$_SESSION['myuser']);
 $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
 ?>


<!DOCTYPE html>
<html>
<head>
	<style>
		.parallax {
		    background-image: url("https://images.pexels.com/photos/120049/pexels-photo-120049.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
		    min-height: 350px; 
		    background-attachment: fixed;
		    background-position: center;
		    background-repeat: no-repeat;
		    background-size: cover;
        }
        
        .maintext {
            color: white;
            margin: 80px;
            background-color: #2D616E;
            height: 55px;
            border: 5px solid white;
            border-radius: 5px;
            font-family: 'Quicksand', sans-serif;
        }

        .toptext {
            line-height: 3em !important;
            color: white !important;
            font-family: 'Quicksand', sans-serif;
        }

        #mainbod {
            background-color: #373737;
        }
        
        #aboveimg {
            background-color: #373737;
        }

        .row {
            align-items: center;
        }

        .topimgr {
            margin-right: 25px;
        }


	</style>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<script
	    src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
	    integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
	    crossorigin="anonymous"></script>   
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<meta charset="utf-8">
	<title>Welcome, <?php echo $userRow['first_name']; ?></title>
</head>
<body>

    <!-- NAVBAR -->
	<nav class="navbar navbar-fixed-top navbar-inverse" style="height: 75px;">
	  	<div class="container-fluid">
	    	<div class="navbar-header">

                <!-- BURGER -->
	      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="	#bs-example-navbar-collapse-1" aria-expanded="false">
	        		<span class="sr-only"></span>
	        		<span class="glyphicon glyphicon-menu-hamburger"></span>
	      		</button>
	      		<a class="navbar-brand" href="#"><img src="https://vectr.com/drsassy/b2HxVAotTG.svg?width=640&height=640&select=b2HxVAotTGpage0" class="brand" width="100" height="30"></a>
	    	</div>
	
	    <!-- COLLAPSED LINKS -->
	    	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      		<ul class="nav navbar-nav">
	        		<li><a href="#" data-target="#text-info-gs">Ready to Drive,  <?php echo $userRow['first_name']; ?>?<span class="sr-only">(current)</span></a></li>
	      		</ul>
	      	
  				<div class="col-lg-7" style="margin-top: 10px;">
    				<div class="input-group">
      					<span class="input-group-btn">
        					<button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
      					</span>
      					<input type="text" class="form-control" placeholder="Search for...">
    				</div>
 			 	</div>

	      	<ul class="nav navbar-nav navbar-right">
	        	<li>
	        		<a href="MAP.html"><img src="https://www.vectorlogo.zone/logos/google_maps/google_maps-card.png" width="75"></a>
	        	</li>
	        	<li>
	        		<a href="logout.php?logout">Sign Out</a>
	        	</li>
    	    </ul>
	    </div><!-- NAVBAR -->
	  </div><!-- CONTAINER-->
    </nav>
    
    <!-- HEAD -->
	<div class="container" id="aboveimg" style="margin-top: 75px;">
        <h1 class="text-center maintext" id="toptext">Welcome to Rip-Off-Rental!</h1>
        
        <!-- CANNOT GET IMAGES TO ALIGN CENTER!!!!! >:( -->
		<!-- <div class="row">
            <div class="text-center">
            <div class="col-lg-6 col-md-6 col-sm-12"><img class="topimgl rounded float-left" src="https://images.pexels.com/photos/210182/pexels-photo-210182.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" width="600" height="350"></div>
            </div>
            <div class="text-center">
			<div class="col-lg-6 col-md-6 col-sm-12"><img class="topimgr rounded float-right" src="https://images.pexels.com/photos/169677/pexels-photo-169677.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" width="600" height="350"></div>
            </div>
        </div> -->

        <!-- PARALLAX -->
        <div class="parallax"></div>
    </div>
     
        <!-- BODY -->
		<div id="mainbod" class="container">
		
        <!-- OFFICE -->
        <h1 class="maintext text-center">Office Info</h1>
		<button type="button" class="btn btn-default btn-lg center-block" data-toggle="modal" data-target="#myModal2" onclick="showofficelist()">Office List</button>
		<div>
        <hr>
        
        <!-- PARALLAX -->
        <div class="parallax"></div>

        <!-- CARS -->
		<h1 class="maintext text-center">Our Cars</h1>
		<button onclick="showcarlist()" class="btn btn-default btn-lg center-block">Car List</button>
		<p id="mod2"></p>
		</div>
        <hr>
        
        <!-- PARALLAX -->
        <div class="parallax"></div>

        <!-- RESERVATIONS -->
		<h1 class="maintext text-center">Reserved Cars</h1>
		<button onclick="locar()" class="btn btn-lg btn-default center-block">Car Locations </button>
        <hr>
        
        <!-- PARALLAX -->
        <div class="parallax"></div>
        
        
  <!-- MODAL -->
  	<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
	      <!-- CONTENT-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Office List</h4>
            </div>
            
	        <div class="modal-body">
	          	<p id="mod1"></p>
            </div>
            
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
      
    </div>
  
    </div>

	
        <p id="mod4"></p>

        <!-- LOCATIONS -->
        <h1 class="maintext text-center">Cars by Location</h1>
        <button type="button" class="btn btn-default btn-lg center-block" data-toggle="modal" data-target="#myModal1" onclick="carlocation()">View Locations </button>
        
			  <!-- MODAL STRUCTURE -->
			  <div class="modal fade" id="myModal1" role="dialog">
			    <div class="modal-dialog modal-lg">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Location</h4>
			        </div>
			        <div class="modal-body">
			          <p id="mod3"></p>
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			      </div>
			    </div>
			  </div>
	</div>
	
	<hr>

	<script>
	function showofficelist(){
        var obj, dbParam, xmlhttp;
        obj = {}; 
        dbParam = JSON.stringify(obj); 
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("mod1").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "offices.php?office=" + dbParam, true); 
        xmlhttp.send(); 
        }
        function showcarlist(){
        var obj, dbParam, xmlhttp;
        obj = {}; 
        dbParam = JSON.stringify(obj); 
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("mod2").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "cars.php?CarList=" + dbParam, true); 
        xmlhttp.send(); 
        }


        function carlocation(){
	        var obj, dbParam, xmlhttp;
	        obj = {}; 
	        dbParam = JSON.stringify(obj); 
	        xmlhttp = new XMLHttpRequest();
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("mod3").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET", "locations.php?location=" + dbParam, true); 
	        xmlhttp.send();
		}
        function locar(){
        var obj, dbParam, xmlhttp;
        obj = {}; 
        dbParam = JSON.stringify(obj); 
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("mod4").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "carmodal.php?carmodal=" + dbParam, true); 
        xmlhttp.send(); 
        }

</script>
            
      
    </body>
</html>
<?php ob_end_flush(); ?>