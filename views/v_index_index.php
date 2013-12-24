
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/> 
        <title>Roommate Finder</title>
       <!-- <link rel="shortcut icon" href="../favicon.ico"> !-->
        <link rel="stylesheet" type="text/css" href="/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="/css/style1.css" />
        <link rel="stylesheet" href="/css/main.css" type="text/css"/>
 
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
                <form class = "cmxform" id = "signupForm2" method="POST" action="/users/p_signup">
                    <fieldset>
        <p>
        <label for = "first_name">First Name</label>
            <input id = "first_name" type="text" name="first_name" minlength = "3" required />
        </p>
        <p>
        <label for = "last_name">Last Name</label>
            <input id = "last_name" type="text" name="last_name" minlength = "3" required />
        </p>
        <p>
        <label for = "email">Email</label>
            <input id = "email" type="text" name="email" minlength = "3" required />
        </p>
                <!--<?php if(isset($error) && $error == 'emailResult'): ?>
                    <div class='error'>
                        *We already have a user registered with that email. Please sign in or use a different email.
                    </div>
                <?php endif; ?> !-->
        <p>
        <label for = "password">Password</label>
            <input id ="password" type="password" name="password" minlength = "3" required/>
       <p>
        <input class = "submit" type="submit" value = "Sign up">
        </fieldset>
        </form>
                <?php if(isset($error) && $error == 'blank-field'): ?>
                    <div class='error'>
                        *All fields must be filled out.
                    </div>
                <?php endif; ?> 
        </div>

        <div id = 'loginForm'>
                <form class = "cmxform" id="loginForm" method='POST' action='/users/p_login'>
        <p>
        <label for = "email">Email</label>
            <input id = "email" type="text" name="email" minlength = "3" required />
        </p>
        <p>
        <label for = "password">Password</label>
            <input id ="password" type="password" name="password" minlength = "3" required/>
       </p>
                        <div class='error' id="loginFailedErrorDiv">
                                    Login failed. Please double check your email and password.
                        </div>

        <input class = 'submit' type='submit' value='Log in'>
        </form>
        </div> 
        <div id='wrapper2'>
        <h1>Welcome to Boston <?php echo APP_NAME;?><?php if($user) echo ', '.$user->first_name; ?></h1>
        <br><br>
        <p> We know how difficult it can be to find a compatible roommate. Let us help you find a roommate with similar interests, location preference, and age. </p>
        <br><br>

        <?php if(isset($loginFailed) && $loginFailed =="false"):?>
                <p>Click Preferences below so we can learn about you and find you a roommate!</p>
                <br><br>
                <button type="button" class ='Preferences'>Preferences</button>
                <button type="button" class ='Profile'>Profile</button>
                <button type="button" class ='Logout'>Logout</button>

        <?php else: ?>
                <button type="button" class ='SignUp'>Signup</button>
                <button type="button" class ='Login'>Login</button>
        <?php endif; ?>
        
        </div>
        </div>

                <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                <script type="text/javascript" src="/js/modernizr.custom.86080.js"></script>
                <script type="text/javascript" src="/js/jquery.js"></script>
                <script type="text/javascript" src="/js/jquery.validate.js"></script>
                <script type="text/javascript" src="/js/main.js"></script>

            
                <script>
                var userHasPreferences = false;
                <?php if(isset($preferencesEntered)): ?>
                userHasPreferences = <?php echo $preferencesEntered.";" ?>
                <?php endif; ?>

                var userLoginFailed = false;
                <?php if(isset($loginFailed)): ?>
                userLoginFailed = <?php echo $loginFailed.";" ?>
                <?php endif; ?>

                </script>

                
</body>
</html>