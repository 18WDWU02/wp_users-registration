<?php 
/* Template Name: Registration Form */ 
?>
<?php
	get_header();

	global $wpdb;
				if ($_POST) {
					
				$email = $wpdb->escape($_POST['email']);
				$username = $wpdb->escape($_POST['username']);
				$password = $wpdb->escape($_POST['password']);
				$confirm = $wpdb->escape($_POST['confpwd']);
				
								
				$error = array();
				
				if (strpos($username, ' ') !== FALSE) {
					$error['username_space'] = "Username has space";
				}
				
				if (empty($username)) {
					$error['username_empty'] = "Username is empty";
				}
				
				if (username_exists($username)) {
					$error['username_exists'] = "Username exists already";
				}
				
				if (!is_email($email)) {
					$error['email_valid'] = "Not a valid email";
				}
				
				if (email_exists($email)) {
					$error['email_existence'] = "Email exists already";
				}
				
				if (strcmp($password , $confirm) !==0) {
					$error['password']="Passowrd did not match";
				}
				
				
				if (count($error) == 0) {
					wp_create_user($username,$password,$email);
					echo "User created successfully";
					exit();
				} else {
					print_r($error);

				}


	}

?>

<form method="post">
	<label for="email">Email </label>
	<input type="text" id="email" name="email" placeholder="email">

	<label for="username">Username </label>
	<input type="text" id="username" name="username" placeholder="Username">

	<label for="Password">Password </label>
	<input type="password" id="password" name="password" placeholder="Password">

	<label for="confpwd">Confirm Password </label>
	<input type="password" id="confpwd" name="confpwd" placeholder="Confirm Password">

	<input type="submit" name="submit">

</form>

<?php
	get_footer();
?>