<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Admin | Blog Site</title>

	<?php include('./header.php'); ?>
	<?php
	session_start();
	if (isset($_SESSION['login_id']))
		header("location:index.php?page=home");
	?>

	<style>
		/* Background */
		.login-container {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			background-color: #f5f5f5;
			/* Light gray background */
			margin: 0;
		}

		/* Login card */
		.login-card {
			background-color: #ffffff;
			/* White background for the card */
			padding: 2rem;
			border-radius: 8px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
			text-align: center;
			width: 300px;
		}

		/* Logo */
		.logo {
			max-width: 100px;
			/* Adjust size for responsiveness */
			margin-bottom: 1rem;
		}

		/* Form heading */
		h2 {
			font-size: 1.5rem;
			color: #00a9c6;
			/* Blue from the logo */
			margin-bottom: 1.5rem;
		}

		/* Input fields */
		.input-field {
			width: 100%;
			padding: 0.8rem;
			margin: 0.5rem 0;
			border: 1px solid #b0b0b0;
			/* Gray border */
			border-radius: 4px;
			font-size: 1rem;
			color: #333333;
			box-sizing: border-box;
		}

		.input-field:focus {
			outline: none;
			border-color: #00a9c6;
			/* Blue focus border */
			box-shadow: 0 0 5px rgba(0, 169, 198, 0.5);
		}

		/* Submit button */
		.submit-button {
			width: 100%;
			padding: 0.8rem;
			background-color: #00a9c6;
			/* Blue button */
			border: none;
			border-radius: 4px;
			font-size: 1rem;
			color: white;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}

		.submit-button:hover {
			background-color: #008b9c;
			/* Darker blue for hover */
		}

		.submit-button:active {
			background-color: #006a76;
			/* Even darker blue for active */
		}

		.error-alert {
			color: #d9534f;
			/* Red for error */
			background-color: #f8d7da;
			border: 1px solid #f5c6cb;
			padding: 10px;
			margin-bottom: 1rem;
			border-radius: 4px;
			text-align: center;
		}
	</style>

</head>

<body>
	<div class="login-container">
		<div class="login-card">
			<div class="logo">
				<img src="./assets/cmc.png" alt="Logo">
			</div>
			<h2>File Management System</h2>
			<form id="login-form">
				<div class="form-group">
					<input type="text" id="username" name="username" class="input-field" placeholder="Username">
				</div>
				<div class="form-group">
					<input type="password" id="password" name="password" class="input-field" placeholder="Password">
				</div>
				<button type="submit" class="submit-button">Login</button>
				<div id="error-message" class="error-alert" style="display: none;">Username or password is incorrect.</div>
			</form>
		</div>
	</div>

	<script>
		$('#login-form').submit(function(e) {
			e.preventDefault();
			const button = $(this).find('.submit-button');
			button.attr('disabled', true).text('Logging in...');

			if ($(this).find('.error-alert').length > 0)
				$(this).find('.error-alert').hide();

			$.ajax({
				url: 'ajax.php?action=login',
				method: 'POST',
				data: $(this).serialize(),
				error: err => {
					console.log(err);
					button.removeAttr('disabled').text('Login');
				},
				success: function(resp) {
					if (resp == 1) {
						location.reload('index.php?page=home');
					} else {
						$('#error-message').show();
						button.removeAttr('disabled').text('Login');
					}
				}
			});
		});
	</script>
</body>

</html>