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
    

    public function login() {
        # Setup view
        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";

        # Render template
        echo $this->template;
    }

    public function logout() {
        echo "This is the logout page";
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

} # end of the class