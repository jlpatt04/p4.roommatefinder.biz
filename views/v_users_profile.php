<html>
<head>
	<link rel="stylesheet" href="/css/main.css" type="text/css">
	<img src="/css/images/smiley.jpg" alt="Smiley face" height="150" width="150">
<br>
	<?php 
		echo $userInfo["first_name"]. "'s Profile"."<br>";
		echo "Email: ".$userInfo["email"]."<br>";
		echo "Rent: ".$preferencesData["rent"]."<br>";
		echo "Age:  ".$preferencesData["age"]."<br>";
		echo "Cleanliness:  ".$preferencesData["cleanliness"]."<br>";

	if($preferencesData["smoker"] == 0)	{
		echo "Smoker: No" . "<br>";
	} else {
		echo "Smoker: Yes" . "<br>";
	}

		echo "Party Preference: ".$preferencesData["partyPreference"]."<br>";
		echo "Gender: ".$preferencesData["gender"]."<br>";
		echo "Gender Preference: ".$preferencesData["genderPreference"]."<br>";

	echo "Interests: ";
	for($i = 0; $i < sizeof($interestsData); $i++){
		echo $interestsData[$i]["interest_name"]. "<br>";
	}

	echo "Neighborhoods: ";
	for($i = 0; $i < sizeof($neighborhoodData); $i++){
		echo $neighborhoodData[$i]["neighborhood_name"]. "<br>";
	} 
	echo "<br>";
	?>

</head>
<body>

<p> Best results based on same rent and at least 1 common neighborhood </p>

	<?php
		echo "There are ".sizeof($rentNeighborhoodData). " results." ."<br><br>";

	for($i = 0; $i < sizeof($rentNeighborhoodData); $i++){
		echo "Name: ".$rentNeighborhoodData[$i]["first_name"]."<br>";
		echo "Email: ".$rentNeighborhoodData[$i]["email"]."<br>";
		echo "Age:  ".$rentNeighborhoodData[$i]["age"]."<br>";
		echo "Cleanliness:  ".$rentNeighborhoodData[$i]["cleanliness"]."<br>";

	if($rentData[$i]["smoker"] == 0){
		echo "Smoker: No" . "<br>";
	} else {
		echo "Smoker: Yes" . "<br>";
	}	

		echo "Party Preference: ".$rentNeighborhoodData[$i]["partyPreference"]."<br>";
		echo "Gender: ".$rentNeighborhoodData[$i]["gender"]."<br>";
		echo "<br><br>";
	}
	?>

</body>

<footer>
	<button type="button" class ='Home'>Home</button>
	<button type="button" class ='Logout2'>Logout</button>
</footer>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="/js/profile.js"></script>
</html>