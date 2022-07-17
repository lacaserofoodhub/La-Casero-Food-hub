<?php 
	session_start();

	$name = "";
	$gender = "";
	$address = "";
	$contact = "";
	$email = "";
	$errors = array();

	$db = new mysqli('localhost', 'root', '', 'dbms');

	if (isset($_POST['register']))
	{
		$name = mysqli_real_escape_string($db, $_POST['name']);
		$gender = mysqli_real_escape_string($db, $_POST['gender']);
		$address = mysqli_real_escape_string($db, $_POST['address']);
		$contact = mysqli_real_escape_string($db, $_POST['contact']);
		$email = mysqli_real_escape_string($db, $_POST['email']);

		if (empty($name)) {
			array_push($errors, "Name is required");
		}

		if (empty($gender)) {
			array_push($errors, "Gender is required");
		}

		if (empty($address)) {
			array_push($errors, "Address is required");
		}

		if (empty($contact)) {
			array_push($errors, "Contact no. is required");
		}

		if (empty($email)) {
			array_push($errors, "Email is required");
		}

		if (count($errors) == 0) {
			$sql = "INSERT Into applicants (name, gender, address, contact, email) 
					VALUES ('$name', '$gender', '$address', '$contact', '$email')";
			mysqli_query($db, $sql);
				$_SESSION['name'] = $name;
				$_SESSION['success'] = "Your infos has been recorded!";
				header('location: index.php');
		}
	}

	if (isset($_POST['login']))
	{
		$name = mysqli_real_escape_string($db, $_POST['name']);
		$gender = mysqli_real_escape_string($db, $_POST['gender']);
		$address = mysqli_real_escape_string($db, $_POST['address']);
		$contact = mysqli_real_escape_string($db, $_POST['contact']);
		$email = mysqli_real_escape_string($db, $_POST['email']);

		if (empty($name)) {
			array_push($errors, "Name is required");
		}

		if (empty($gender)) {
			array_push($errors, "Gender is required");
		}

		if (empty($address)) {
			array_push($errors, "Address is required");
		}

		if (empty($contact)) {
			array_push($errors, "Contact no. is required");
		}

		if (empty($email)) {
			array_push($errors, "Email is required");
		}

		if (count($errors) == 0) {
			$query = "SELECT * FROM applicants WHERE name = '$name' AND gender = '$gender' AND address = '$address' AND contact = '$contact' AND email = '$email'";
			$result = mysqli_query($db, $query);
		}
			if (mysqli_num_rows($result) == 1) {
				$_SESSION['name'] = $name;
				$_SESSION['success'] = "Your infos has been recorded!";
				header('location: index.php');
			} else {
				array_push($errors, "The combination of information doesn't match");
			}
		
		

		if (count($errors) == 0) {
			$sql = "INSERT Into applicants (name, gender, address, contact, email) 
					VALUES ('$name', '$gender', '$address', '$contact', '$email')";
			mysqli_query($db, $sql);
				$_SESSION['name'] = $name;
				$_SESSION['success'] = "Your infos has been recorded!";
				header('location: index.php');
		}
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['name']);
		header('location: register.php');

	}


 ?>