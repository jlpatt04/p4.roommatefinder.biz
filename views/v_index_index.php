<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Roommate Finder</title>
       <!-- <link rel="shortcut icon" href="../favicon.ico"> !-->
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style1.css" />
        <link rel="stylesheet" href="/css/main.css" type="text/css">
 
    <body id="page">
        <ul class="cb-slideshow">
            <li><span>Image 01</span><div><h3>Boston</h3></div></li>
            <li><span>Image 02</span><div><h3>Boston</h3></div></li>
            <li><span>Image 03</span><div><h3>Boston</h3></div></li>
            <li><span>Image 04</span><div><h3>Boston</h3></div></li>
            <li><span>Image 05</span><div><h3>Boston</h3></div></li>
            <li><span>Image 06</span><div><h3>Boston</h3></div></li>
        </ul>
	
	<div id = 'wrapper'>
	<div id = 'signupForm'>
		<form method='POST' action='/users/p_signup'>
    		First Name<br>
        <input type='text' name='first_name'>
        <br><br>
			Last Name<br>
        <input type='text' name='last_name'>
        <br><br>
			Email<br>
        <input type='text' name='email'>
        <br><br>
        	<?php if(isset($error) && $error == 'emailResult'): ?>
            	<div class='error'>
               		 *We already have a user registered with that email. Please sign in or use a different email.
           	    </div>
            	<br><br>
        		<?php endif; ?>
    		Password<br>
        <input type='password' name='password'>
        <br><br>
        <input type='submit' value = 'Sign up'>
		</form>
        	<?php if(isset($error) && $error == 'blank-field'): ?>
            	<div class='error'>
                	*All fields must be filled out.
            	</div>
           		<br><br>
        	<?php endif; ?>
	</div>
	<div id = 'loginForm'>
		<form method='POST' action='/users/p_login'>
    		Email<br>
        <input type='text' name='email'>
        <br><br>
    		Password<br>
        <input type='password' name='password'>
        <br><br>
    		<?php if(isset($error)): ?>
        		<div class='error'>
           			 Login failed. Please double check your email and password.
        		</div>
        <br><br>
    		<?php endif; ?>
        		<input type='submit' value='Log in'>
		</form>
	</div> 
	<div id='wrapper2'>
	<h1>Welcome to Boston!</h1>
	<br>
	<p> We know how difficult it can be to find a compatible roommate. Let us help you find a roommate with similar interests, location preference, and age. </p>
	<br>
	<button type="button" class ='SignUp'>Signup</button>
	<button type="button" class ='Login'>Login</button>
	</div>
	</div>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
		
</body>
</html>
