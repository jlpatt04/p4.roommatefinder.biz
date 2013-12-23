<?php

class index_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
			$this->template->content = View::instance('v_index_index');
			
		# Now set the <title> tag
			$this->template->title = "Roommate Finder";
	

			$preferencesEntered = "false";

			if($this->user->user_id){

			$preferencesEntered ='SELECT
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
	        $preferencesData = DB::instance(DB_NAME)->select_row($preferencesEntered);

	        if(empty($preferencesData)){
	        	$preferencesEntered = "false";
	        } else {
	        	$preferencesEntered = "true";
	        }

			}

		# CSS/JS includes
			/*
			$client_files_head = Array("");
	    	$this->template->client_files_head = Utils::load_client_files($client_files);
	    	
	    	$client_files_body = Array("");
	    	$this->template->client_files_body = Utils::load_client_files($client_files_body);   
	    	*/

	    	#Pass data to view
			$this->template->content->preferencesEntered = $preferencesEntered;
	      					     		
		# Render the view
			echo $this->template;

	} # End of method
	
	
} # End of class
