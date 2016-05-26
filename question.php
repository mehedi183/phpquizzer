<?php include 'database.php' ?>
<?php session_start(); ?>
<?php 
	//set question number
$number = (int)$_GET['n'];
////*Get total number of question
//--Get question
$query = "SELECT * FROM question";

//Get the result
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

	$total = $result->num_rows;

	////*End of Get total number of question

//--Get question
$query = "SELECT * FROM `question` WHERE question_number = $number";

//Get the result
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

	$question = $result->fetch_assoc();


/*
Get choices
*/
$query = "SELECT * FROM `choices` WHERE question_number = $number";

//Get result
$choices = $mysqli->query($query) or die($mysqli->error.__LINE__);




 ?>
<!DOCTYPE html>

<html>
	<head>
		
		<!-- Website Title & Description for Search Engine purposes -->
		<title>PHP Quizzer</title>
		<meta name="description" content="">
		
		<!-- Mobile viewport optimized -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- Bootstrap CSS -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="includes/css/bootstrap-glyphicons.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="includes/css/style.css" rel="stylesheet">
		
		<!-- Include Modernizr in the head, before any other Javascript -->
		<script src="includes/js/modernizr-2.6.2.min.js"></script>
		
	</head>
	<body>
	
	<!-- Your Code Goes Here. Remember to remove this comment once you've started, you don't need it :) -->
	<header>
		<div class="container">
			<h1>PHP Quizzer</h1>
		</div>
	</header>
	<main>
		<div class="container">
			<div class="current">Question <?php echo $question['question_number']; ?> of <?php echo $total; ?></div>
			<div class="question">
				<p><strong>
					<?php echo $question['questions']; ?>
				</strong></p>
				<form method="post" action="process.php">
					<ul class="choices">
					<?php 
						while ($row = $choices->fetch_assoc()):
							# code...
					 ?>
					<li><input type="radio" name="choice" value=<?php echo $row['id']; ?> required /> <?php echo $row['text']; ?></li>

					<?php endwhile; ?>
					</ul>
					<input type="hidden" name="number" value="<?php echo $number; ?>" />
					<input type="submit" class="btn btn-default" value="Submit" name="submit" />
					
				</form>
				
			</div>
		</div>
	</main>
	<footer>
		<div class="container">
			Copyright &copy; 2016, PHP Quizzer
		</div>
	</footer>
	

	<!-- All Javascript at the bottom of the page for faster page loading -->
		
	<!-- First try for the online version of jQuery-->
	<script src="http://code.jquery.com/jquery.js"></script>
	
	<!-- If no online access, fallback to our hardcoded version of jQuery -->
	<script>window.jQuery || document.write('<script src="includes/js/jquery-1.8.2.min.js"><\/script>')</script>
	
	<!-- Bootstrap JS -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<!-- Custom JS -->
	<script src="includes/js/script.js"></script>
	
	</body>
</html>

