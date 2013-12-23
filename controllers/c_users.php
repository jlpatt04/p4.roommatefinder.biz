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

        # Search the db for this email and password
        # Retrieve the token if it's available
         $q = "SELECT token FROM users WHERE email = '".$_POST['email']."' AND password = '".$_POST['password']."'";

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
    
        #Render template
        echo $this->template;


       }
    }
    

    public function login() {
        # Setup view
        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";

        #Pass data to view
        $this->template->content->error = $error;
        
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
        Router::redirect("/");

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

        #Send them back to the main index.
        Router::redirect("/");
        
    }

    public function preferences($user_name = NULL) {
        #Set up view
        $this ->template->content= View::instance('v_users_preferences');
        $this->template->title = "Preferences";

        #Pass the data to the view
        $this->template->content->user_name=$user_name;

        #Display the view
        echo $this->template;
    }

    public function p_preferences(){

        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Make user_id stored in a variable for each sql insert
        $user_id = $this->user->user_id;
    
        #Inserting neighborhood array into database
        $neighborhood = $_POST['neighborhood'];
        
        if(empty($neighborhood)) {
            echo("You didn't select any neighborhood.");
        } else {
            foreach ($neighborhood as $value) {
                $userNeighborhoods = Array("neighborhood_id" => $value, "user_id" => $user_id);
                $neighborhood = DB::instance(DB_NAME)->insert('neighborhood_user',$userNeighborhoods);
            }
        }

        #Inserting interests array into database
        $interests = $_POST['interests'];

        if(empty($interests)) {
            echo("You didn't select any interests.");
        } else {
            foreach ($interests as $value) {
                $userInterests = Array("interest_id" => $value, "user_id" => $user_id);
                $interests = DB::instance(DB_NAME)->insert('interest_user',$userInterests);
            }
        } 
        
        #Inserting preferences array into database
        $rent = $_POST['rent'];
        $age = $_POST['age'];
        $cleanliness = $_POST['cleanliness'];
        $smoker = $_POST['smoker'];
        $partyPreference = $_POST['partyPreference'];
        $gender = $_POST['gender'];
        $genderPreference = $_POST['genderPreference'];
        //$_POST['user_id'] = $this->user->user_id;

        $userPreferences = Array("rent" => $rent,"age" => $age, "cleanliness" => $cleanliness, "smoker" => $smoker, "partyPreference" => $partyPreference, "gender" => $gender, "genderPreference" => $genderPreference, "user_id" => $user_id);
     
        #Insert this profile info into the database
        $preferences = DB::instance(DB_NAME)->insert('preferences', $userPreferences);

         #Send them back to the main index.
        Router::redirect("/users/profile");

        }

        public function profile($user_name = NULL) {
    
        # If user is blank, they're not logged in; redirect them to the login page
        if(!$this->user) {
        Router::redirect('/');
        }

        #Build query to select info from preference's table
        $q='SELECT
            users.first_name,
            users.email
        FROM users
        WHERE user_id = '.$this->user->user_id;

        #Run the Query
        $userInfo = DB::instance(DB_NAME)->select_row($q);
 
        #Build query to select info from preference's table
        $q='SELECT
            p.age,
            p.rent,
            p.cleanliness,
            p.smoker,
            p.partyPreference,
            p.gender,
            p.genderPreference
        FROM preferences AS p
        WHERE user_id = '.$this->user->user_id;

        #Run the Query
        $preferencesData = DB::instance(DB_NAME)->select_row($q);

        #Build query to select info from interest_user table
        $q= 'SELECT 
            interest.interest_name
        FROM interest
        INNER JOIN interest_user
            ON interest_user.interest_id = interest.interest_id
        WHERE user_id = '.$this->user->user_id;

        #Run the query
        $interestsData = DB::instance(DB_NAME)->select_rows($q);

        #Build query to select info from neighborhood_users table
        $q= 'SELECT 
            neighborhood.neighborhood_name,
            neighborhood.neighborhood_id
        FROM neighborhood
        INNER JOIN neighborhood_user
            ON neighborhood.neighborhood_id = neighborhood_user.neighborhood_id
        WHERE user_id = '.$this->user->user_id;

        #Run the query
        $neighborhoodData = DB::instance(DB_NAME)->select_rows($q);

        #Building the query for best result based on rent and at least 1 common neighborhood   
            $querySubstitute = "(";
           for($i=0;$i<sizeof($neighborhoodData);$i++){
                $querySubstitute = $querySubstitute.$neighborhoodData[$i]["neighborhood_id"];
                if($i<sizeof($neighborhoodData)-1){
                    $querySubstitute = $querySubstitute.",";    
                }
           } 
           $querySubstitute = $querySubstitute.")";

         $q= 'SELECT DISTINCT users.first_name, 
             users.email,
            users.user_id,
            p.rent,
            p.age,
            p.cleanliness,
            p.smoker,
            p.partyPreference,
            p.gender
        FROM users
        INNER JOIN preferences AS p
            ON p.user_id = users.user_id
        INNER JOIN neighborhood_user
            ON users.user_id = neighborhood_user.user_id
        INNER JOIN neighborhood
            ON neighborhood.neighborhood_id = neighborhood_user.neighborhood_id
        WHERE (neighborhood.neighborhood_id IN '.$querySubstitute.
        ')   AND users.user_id <> '.$this->user->user_id.
        ' AND p.rent LIKE "'.$preferencesData["rent"].'"';

        #Run the query
        $rentNeighborhoodData= DB::instance(DB_NAME)->select_rows($q);

        #Set up view
        $this ->template->content= View::instance('v_users_profile');
        $this->template->title = "Profile";

        #Pass the data to the view
        $this->template->content->userInfo=$userInfo;
        $this->template->content->preferencesData = $preferencesData;
        $this->template->content->interestsData =$interestsData;
        $this->template->content->neighborhoodData =$neighborhoodData;
        $this->template->content->rentNeighborhoodData =$rentNeighborhoodData;

        #Display the view
        echo $this->template;
    }

    public function testData() {

//     $file = file_get_contents('./names.txt', FILE_USE_INCLUDE_PATH);
//     $names = explode("\n",$file);
//     $users = Array();

// for($i = 0 ; $i< sizeof($names); $i++){
    
//     $components = explode(" ",$names[$i]);
//     $fName = $components[0];
//     $lName = $components[1];
//     if(sizeof($components)<2)continue;
//     $email = strtolower($fName."_".$lName."@gmail.com");
//     $password = $lName;
    
//     $user = Array();
//     $user["first_name"] = $fName;
//     $user["last_name"] = $lName;
//     $user["email"] = $email;
//     $user["password"] = $password;
    
//     array_push($users,$user);
// }

// for($i = 2 ; $i< sizeof($users) ; $i++){

//     $user=$users[$i];

//     //First insert user into users table
//     $userEntry = Array();
      
//     $userEntry["first_name"] = $user["first_name"];
//     $userEntry["last_name"] = $user["last_name"];
//     $userEntry["email"] = $user["email"];
//     $userEntry["password"] = sha1(PASSWORD_SALT.$user['password']);
//     $userEntry["modified"] = Time::now();
//     $userEntry["created"] = Time::now();
//     $userEntry["token"] = sha1(TOKEN_SALT.$user['email'].Utils::generate_random_string());

//     var_dump($userEntry);
//     echo "\n";

//     $user_id = DB::instance(DB_NAME)->insert('users',$userEntry);

//     //Create a neighborhood preferences
//     $noOfNeighborhoods = rand(2,5);
//     for($j=0;$j<$noOfNeighborhoods;$j++){
//         $neighborhoodId = rand(1,10);
//         $neighborhood = Array("user_id"=>$user_id,"neighborhood_id"=>$neighborhoodId);
//         var_dump($neighborhood);
//         echo "\n";
//         $neighborhoodP = DB::instance(DB_NAME)->insert('neighborhood_user',$neighborhood);
//     }
    
//     //Create interests
//      $noOfInterests = rand(2,5);
//     for($j=0;$j<$noOfInterests;$j++){
//         $interestId = rand(1,7);
//         $interestDict = Array("user_id"=>$user_id,"interest_id"=>$interestId);

//         var_dump($interestDict);
//         echo "\n";

//         $interestP = DB::instance(DB_NAME)->insert('interest_user',$interestDict);
//     }
    
//     //Create preferences
//     $rentValues = Array("500-599","601-699","700-799","800-899","900-999","1000-1200","1200-1400","1400-1600");
//     $ageValues = Array("18-22","23-26","27-30","30+");
//     $smokerValues = Array(0,1);
//     $cleanlinessValues = Array("very clean","moderate","disorganized","little dirty","slob");
//     $partyPrefs = Array("3+/week","weekends","light drinker","no drinking");
//     $gender = Array("female","male");
//     $genderPref = Array("female","male","noPreference");
//     $prefs = Array();
//     $prefs["genderPreference"] = $genderPref[rand(0,sizeof($genderPref)-1)];
//     $prefs["gender"] = $gender[rand(0,sizeof($gender)-1)];
//     $prefs["partyPreference"] = $partyPrefs[rand(0,sizeof($partyPrefs)-1)];
//     $prefs["rent"] = $rentValues[rand(0,sizeof($rentValues)-1)];
//     $prefs["age"] = $ageValues[rand(0,sizeof($ageValues)-1)];
//     $prefs["smoker"] = $smokerValues[rand(0,sizeof($smokerValues)-1)];
//     $prefs["cleanliness"] = $cleanlinessValues[rand(0,sizeof($cleanlinessValues)-1)];
//     $prefs["user_id"] = $user_id;

//     var_dump($prefs);
//     echo "\n";

//     $preferences = DB::instance(DB_NAME)->insert('preferences', $prefs);
    
//     }

 }


} # end of the class