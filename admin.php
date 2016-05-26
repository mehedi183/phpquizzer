<?php include 'database.php' ?>
<?php 
	if(isset($_POST['submit'])){
		$question_number = $_POST['question_number'];
		$question_text = $mysqli->real_escape_string($_POST['question_text']);
		
 		
		//Create Choices Array
		$choices = array();
		$choices[1] = $mysqli->real_escape_string($_POST['choice1']);
		$choices[2] = $mysqli->real_escape_string($_POST['choice2']);
		$choices[3] = $mysqli->real_escape_string($_POST['choice3']);
		$choices[4] = $mysqli->real_escape_string($_POST['choice4']);


		$correct_choice = $_POST['correct_choice'];

		$query = "INSERT INTO `question` (question_number, questions) 
					VALUES ('$question_number', '$question_text')";
		//Run query
		$insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
		//Validate insert
		if($insert_row)
		{
			foreach ($choices as $choice => $value) 
			{
				if($value != "")
				{
					if($correct_choice == $choice)
					{
						$is_correct = 1;
					}
					else{
						$is_correct = 0;
					}
					//choice query
					$query = "INSERT INTO `choices` (question_number, is_correct, text) 
					          VALUES ('$question_number', '$is_correct', '$value')";
					//Get the result
					$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

					//Validate
					if($result)
					{
						continue;
					}
					else
						die($mysqli->error.__LINE__);
				}
			}
			$message = "Question Has Been Added.";
		}

	}
 ?>
 <?php 
$query = "SELECT * FROM question";

//Get the result
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

	$total = $result->num_rows;
	$next = $total+1;
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
			<h2>Add a Question</h2>
			<?php if(isset($message))
			{
				echo '<p>'. $message . '</p>';
			}

			 ?>
			 
			<form method="post" action="admin.php">
				<p>
				<label>Question Number: </label>
				<input type="number" name="question_number" value="<?php echo $next; ?>" readonly />
				</p>
				<p>
				<label>Question Text: </label>
				<input type="text" name="question_text"/>
				</p>
				<p>
				<label>Choice #1: </label>
				<input type="text" name="choice1" />
				</p>
				<p>
				<label>Choice #2: </label>
				<input type="text" name="choice2" />
				</p>
				<p>
				<label>Choice #3: </label>
				<input type="text" name="choice3" />
				</p>
				<p>
				<label>Choice #4: </label>
				<input type="text" name="choice4" />
				</p>
				<p>
				<label>Correct Choice Number: </label>
				<input type="number" name="correct_choice" />
				</p>
				<p>
				<input type="submit" name="submit" value="Submit" class="btn btn-default" id="adbtn" />
				</p>
			</form>

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

