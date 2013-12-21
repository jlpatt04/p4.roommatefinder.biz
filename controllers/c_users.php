<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {
        # Setup view
        $this->template->content = View::instance('v_users_signup');
        $this->template->title   = "Sign Up";

        #Pass data to the view
        //$this->template->content->error = $error;

        #CSS file for Login
        //$client_files_head = Array('/css/images/main.css');

        #Pass the date to the view
        //$this->template->client_files_head = Utils::load_client_files($client_files_head);
        
        # Render template
        echo $this->template;
    }

    public function p_signup() {

        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $q = "SELECT email FROM users WHERE email = '".$_POST['email']."'" ;

        $emailResult = DB::instance(DB_NAME)->select_field($q);  

        if(isset($emailResult)) {

             Router::redirect("/users/signup/emailResult");
         }

        else if(empty($first_name) || empty($last_name) || empty($email) || empty($password)) {

            Router::redirect("/users/signup/blank-field");
        }
        else {
        #More data we want stored with the user
        $_POST['created'] = Time::now();
        $_POST['modified'] = Time::now();
         
         #Encrypt the password
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
         
         #Create an encrypted token via their email address and a random string
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

        #Insert this user into the database
        $user_id = DB::instance(DB_NAME)->insert('users',$_POST);

        /*# Search the db for this email and password
        # Retrieve the token if it's available
         $q = "SELECT token 
            FROM users 
            WHERE email = '".$_POST['email']."' 
            AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);   

        # If we didn't get a token back, it means login failed
        if(!$token) {

        # Send them back to the login page
        Router::redirect("/users/login/error");

        # But if we did, login succeeded! 
        } else {
*/
    
        /*Store this token in a cookie using setcookie()
        Important Note: *Nothing* else can echo to the page before setcookie is called
        Not even one single white space.
        param 1 = name of the cookie
        param 2 = the value of the cookie
        param 3 = when to expire
        param 4 = the path of the cooke (a single forward slash sets it for the entire domain) */
        /*
        setcookie("token", $token, strtotime('+2 weeks'), '/');

        # Send them to the main page - or whever you want them to go
        Router::redirect("/"); 
       */

        #Setup view
        $this->template->content = View::instance("v_users_p_signup");
        $this->template->title = "Account Created";
    
        #Render template
        echo $this->template;


       }
    }
    

    public function login() {
        # Setup view
        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";

        # Render template
        echo $this->template;
    }

    public function p_login() {

        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Hash submitted password so we can compare it against one in the db
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Search the db for this email and password
        # Retrieve the token if it's available
         $q = "SELECT token 
            FROM users 
            WHERE email = '".$_POST['email']."' 
            AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);   

        # If we didn't get a token back, it means login failed
        if(!$token) {

        # Send them back to the login page
        Router::redirect("/users/login/error");

        # But if we did, login succeeded! 
        } else {

        /* 
        Store this token in a cookie using setcookie()
        Important Note: *Nothing* else can echo to the page before setcookie is called
        Not even one single white space.
        param 1 = name of the cookie
        param 2 = the value of the cookie
        param 3 = when to expire
        param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
        */
        setcookie("token", $token, strtotime('+2 weeks'), '/');

        # Send them to the main page - or whever you want them to go
        Router::redirect("/");

        }

    }
    

    public function logout() {
        #Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("token" => $new_token);

        #Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        #Delete their token cookie by setting it to a date in the past - effectively logging them out
        setcookie("token", "", strtotime('-1 year'), '/');

        echo "This is the logout page";

        #Send them back to the main index.
        Router::redirect("/");
        
    }

    public function profile($user_name = NULL) {
        #Set up view
        $this ->template->content= View::instance('v_users_profile');
        $this->template->title = "Profile";

        #Pass the data to the view
        $this->template->content->user_name=$user_name;

        #Display the view
        echo $this->template;
    }

    public function p_profile(){

        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);
   
        /*
        $neighborhood = $_POST['neighborhood'];
        #Insert this user into the database
        $neighborhood = DB::instance(DB_NAME)->insert('neighborhood_user',$_POST['neighborhood']);
        
        $interests = $_POST['interests'];
        #Insert this user into the database
        $interests = DB::instance(DB_NAME)->insert('interest_user',$_POST['interests']);
        */

        
        $rent = $_POST['rent'];
        $age = $_POST['age'];
        $cleanliness = $_POST['cleanliness'];
        $smoker = $_POST['smoker'];
        $partyPreference = $_POST['partyPreference'];
        $gender = $_POST['gender'];
        $genderPreference = $_POST['genderPreference'];
        //$user_id = $_POST['$this->user->user_id'];  //how do i get ahold of the user id?

        #Insert this profile info into the database
        $preferences = DB::instance(DB_NAME)->insert('preferences', $_POST, "WHERE user_id = '".$this->user->user_id."'");
        //$preferences = DB::instance(DB_NAME)->insert('preferences',$_POST);

     /*if(isset($_POST['age'])) {
        echo ("Smoker: " . $smoking . "<br>");
    } 

     if(isset($_POST['age'])) {
        echo ("Age: " . $age . "<br>");
    }

    if(isset($_POST['rent'])) {
        echo ("Rent: " . $rent . "<br>");
    }
    //prints checked neighborhoods
        if(empty($neighborhood)) {
            echo("You didn't select any neighborhood.");
        } else {
            foreach ($neighborhood as $value) {
                echo("Neighborhood:  " . $value . " " . "<br>");
            }
        }

    //prints checked interests
        if(empty($interests)) {
            echo("You didn't select any interests.");
        } else {
            foreach ($interests as $value) {
                echo("Interest:  " . $value . " " . "<br>");
            }
        } */

        #Setup view
        $this->template->content = View::instance("v_users_p_profile");
        $this->template->title = "Preferences Noted.";
    
        #Render template
        echo $this->template;

    }

} # end of the class