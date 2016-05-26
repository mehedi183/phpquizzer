<?php include 'database.php' ?>
<?php session_start(); ?>
<?php 
//check if the session is set or not
if(!isset($_SESSION['score']))
{
	$_SESSION['score'] = 0;
}
////Get total number of question
//--Get question
$query = "SELECT * FROM question";

//Get the result
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

	$total = $result->num_rows;


if(isset($_POST['submit']))
{
	 $number = (int)$_POST['number'];
	 $selected_choice = $_POST['choice'];
	 $next = $number+1;

	 //Get correct choice
	 $query = "SELECT * FROM `choices` WHERE question_number = $number AND is_correct = 1";

	 //Get result
	 $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	 //Get row
	 $row = $result->fetch_assoc();
	 //set correct choice
	 $correct_choice = $row['id'];

	 if($correct_choice == $selected_choice)
	 {
	 	//Answer is correct
	 	$_SESSION['score']++;
	 }
	
// check if last question
	 if($number == $total)
	 {
	 	header("Location: final.php");
	 	exit();
	 }
	 else{
	 	header("Location: question.php?n=".$next);
	 	
	 }


}

 ?>