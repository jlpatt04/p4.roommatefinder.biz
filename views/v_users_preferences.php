
<link href="/css/template.css" rel="stylesheet" typ="text/css">
<h1>Welcome to Boston, <?php if($user) echo $user->first_name; ?></h1>
<p> What time of roommate are you? And your preferences?</p>
<div id = 'templateWrapper'>
<form method='POST' action='/users/p_preferences'>
<div id = 'columnOneProfile'>
<span>Select two neighborhoods:</span>
<br>
<input type ="checkbox" name = "neighborhood[0]" value ="1">Cambridge<br>
<input type ="checkbox" name = "neighborhood[1]" value ="2">Somerville<br>
<input type ="checkbox" name = "neighborhood[2]" value ="3">Jamaica Plain<br>
<input type ="checkbox" name = "neighborhood[3]" value ="4">East Boston<br>
<input type ="checkbox" name = "neighborhood[4]" value ="5">Boston<br>
<input type ="checkbox" name = "neighborhood[5]" value ="6">Brookline<br>
<input type ="checkbox" name = "neighborhood[6]" value ="7">Allston<br>
<input type ="checkbox" name = "neighborhood[7]" value ="8">Charlestown<br>
<input type ="checkbox" name = "neighborhood[8]" value ="9">Dorchester<br>
<input type ="checkbox" name = "neighborhood[9]" value ="10">West Roxbury<br>
<br>

<span>Rent per person:</span>
<br>
<input type ="radio" name = "rent" value ="500-599">$500-$599<br>
<input type ="radio" name = "rent" value ="601-699">$600-$699<br>
<input type ="radio" name = "rent" value ="700-799">$700-$799<br>
<input type ="radio" name = "rent" value ="800-899">$800-$899<br>
<input type ="radio" name = "rent" value ="900-999">$900-$999<br>
<input type ="radio" name = "rent" value ="1000-1200">$1000-$1200<br>
<input type ="radio" name = "rent" value ="1200-1400">$1200-$1400<br>
<input type ="radio" name = "rent" value ="1400-1600">$1400-$1600<br>
<br>


<span>Age:</span>
<br>
<input type ="radio" name = "age" value ="18-22">18-22<br>
<input type ="radio" name = "age" value ="23-26">23-26<br>
<input type ="radio" name = "age" value ="27-30">27-30<br>
<input type ="radio" name = "age" value ="30+">30+<br>
<br>

<span>Smoker:</span>
<br>
<input type ="radio" name = "smoker" value ="1">Yes<br>
<input type ="radio" name = "smoker" value ="0">No<br>
</div>

<div id = 'columnTwoProfile'>
<span>Interests:</span>
<br>
<input type ="checkbox" name = "interests[0]" value ="1">being active<br>
<input type ="checkbox" name = "interests[1]" value ="2">reading<br>
<input type ="checkbox" name = "interests[2]" value ="3">traveling<br>
<input type ="checkbox" name = "interests[3]" value ="4">cooking<br>
<input type ="checkbox" name = "interests[4]" value ="5">play sports<br>
<input type ="checkbox" name = "interests[5]" value ="6">watch sports<br>
<input type ="checkbox" name = "interests[6]" value ="7">current events<br>
<br>

<span>Cleanliness:</span>
<br>
<input type ="radio" name = "cleanliness" value ="very clean">very clean<br>
<input type ="radio" name = "cleanliness" value ="moderate">moderate<br>
<input type ="radio" name = "cleanliness" value ="disorganized">disorganized<br>
<input type ="radio" name = "cleanliness" value ="little dirty">a little dirty<br>
<input type ="radio" name = "cleanliness" value ="slob">slob<br>
<br>

<span>Party Preference:</span>
<br>
<input type ="radio" name = "partyPreference" value ="3+/week"> 3+/week<br>
<input type ="radio" name = "partyPreference" value ="weekends">weekends<br>
<input type ="radio" name = "partyPreference" value ="light drinker">light drinker<br>
<input type ="radio" name = "partyPreference" value ="no drinking">no drinking<br>
<br>

<span>Gender:</span>
<br>
<input type ="radio" name = "gender" value ="female">female<br>
<input type ="radio" name = "gender" value ="male">male<br>
<br>

<span>Gender Preference:</span>
<br>
<input type ="radio" name = "genderPreference" value ="female">female<br>
<input type ="radio" name = "genderPreference" value ="male">male<br>
<input type ="radio" name = "genderPreference" value ="noPreference">doesn't matter<br>
<br><br>

<button type="submit" class ='submit'>submit</button>
</div>
<br>
<br>
</form>
</div>