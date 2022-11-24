<?php  
	date_default_timezone_set('Asia/Bangkok');   
   	if (isset($_POST['rev']) && $_POST['rev'] == 1) {
      	$jtotal = '{'
      	. '"stotal":"' . date('Y-m-d H:i:s') . ' "'
      	. '}' ; 
      	echo $jtotal;
      	exit();
    }
?>
<?php 
	$page_title = 'Joy Watcher';
	require_once('includes/load.php');
?>
<?php include_once('layouts/header.php');?>

<head>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Asap&family=Roboto:ital,wght@0,500;0,900;1,500&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
</head>  

<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  /*font-family: Arial;*/
}

.header {
  text-align: center;
  padding: 32px;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  padding: 0 24px;
  margin-left: 60px;
}

/* Create four equal columns that sits next to each other */
.column {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
  max-width: 25%;
  padding: 0 24px;
}

.column img {
  margin-top: 8px;
  vertical-align: middle;
  width: 70%;
}

/* Responsive layout - makes a two column-layout instead of four columns */
@media screen and (max-width: 400px) {
  .column {
    -ms-flex: 50%;
    flex: 50%;
    max-width: 50%;
  }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 200px) {
  .column {
    -ms-flex: 100%;
    flex: 100%;
    max-width: 100%;
  }
}

h1 {
	text-align: center;
	font-size: 45px;
	font-weight: 800;
	font-family: 'Roboto', sans-serif;
	color: #5418D6;
	text-transform: uppercase;
	text-shadow: 1px 1px 0px #310099,
							 1px 2px 0px #310099,
							 1px 3px 0px #310099,
							 1px 4px 0px #310099,
							 1px 5px 0px #310099,
							 1px 6px 0px #310099,
							 1px 10px 5px rgba(16, 16, 16, 0.5),
							 1px 15px 10px rgba(16, 16, 16, 0.4),
							 1px 20px 30px rgba(16, 16, 16, 0.3),
							 1px 25px 50px rgba(16, 16, 16, 0.2);
}
</style>
<body>
	<div class="header">
  		<h1>SMT-MOT MACHINE</h1>
  		<!--<p style="font-size: 18px; color: red;">Please Select Mounting M/C...</p>-->
	</div>
	<!--<section class="content">-->
		<div class="row">
			<div class="column">
				<p>
	 				<a href="A1.php">
	  					<img src="A1.jpg">
	 				</a>
				</p>
			</div>

			<div class="column">
				<p>
			 		<a href="A2.php">
			  			<img src="A2.jpg">
			 		</a>
				</p>
			</div>

			<div class="column">
				<p>
			 		<a href="production.php">
			  			<img src="A3.jpg">
			 		</a>
				</p>
			</div>

			<div class="column">
				<p>
			 		<a href="A4.php">
			  			<img src="A4.jpg">
			 		</a>
				</p>
			</div>
		</div>
		<br/>
		<br/>
		<div class="row">
			<div class="column">
				<p>
			 		<a href="A5.php">
			  			<img src="A5.jpg">
			 		</a>
				</p>
			</div>

			<div class="column">
				<p>
			 		<a href="A6.php">
			  			<img src="A6.jpg">
			 		</a>
				</p>
			</div>

			<div class="column">
				<p>
			 		<a href="A7.php">
			  			<img src="A7.jpg">
			 		</a>
				</p>
			</div>

			<div class="column">
				<p>
				 	<a href="A8.php">
				  		<img src="A8.jpg">
				 	</a>
				</p>
			</div>
		</div>
	</section>
</body>
<script>
$(function() {
   function realTime() {
      setTimeout(function(){
         $.ajax({    
            method: "POST",   
            data: { rev: 1 },
            dataType: "json"   
         }).done(function( data ) {
            $("#time").html(data.stotal); 
            $("#time").addClass("realtime");
         });
      realTime(); 
      }, 1000);  
   }
   realTime();
});
</script>
</html>
<?php include_once('layouts/footer.php'); ?>