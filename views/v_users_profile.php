
<link href="/css/template.css" rel="stylesheet" typ="text/css">
<h1>Welcome to Boston, <?php if($user) echo $user->first_name; ?></h1>
<p> What time of roommate are you? And your preferences?</p>
<div id = 'templateWrapper'>
<form method='POST' action='/users/p_profile'>
<div id = 'columnOneProfile'>
<span>Select two neighborhoods:</span>
<br>
<input type ="checkbox" name = "neighborhood[0]" value ="Cambridge">Cambridge<br>
<input type ="checkbox" name = "neighborhood[1]" value ="Somerville">Somerville<br>
<input type ="checkbox" name = "neighborhood[2]" value ="Jamaica Plain">Jamaica Plain<br>
<input type ="checkbox" name = "neighborhood[3]" value ="East Boston">East Boston<br>
<input type ="checkbox" name = "neighborhood[4]" value ="Boston">Boston<br>
<input type ="checkbox" name = "neighborhood[5]" value ="Brookline">Brookline<br>
<input type ="checkbox" name = "neighborhood[6]" value ="Allston/Brighton">Allston<br>
<input type ="checkbox" name = "neighborhood[7]" value ="Charleston">Charlestown<br>
<input type ="checkbox" name = "neighborhood[8]" value ="Dorchester">Dorchester<br>
<input type ="checkbox" name = "neighborhood[9]" value ="West Roxbury">W.Roxbury<br>
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
<input type ="radio" name = "smoker" value ="Yes">Yes<br>
<input type ="radio" name = "smoker" value ="No">No<br>
</div>

<div id = 'columnTwoProfile'>
<span>Interests:</span>
<br>
<input type ="checkbox" name = "interests[0]" value ="being active">being active<br>
<input type ="checkbox" name = "interests[1]" value ="reading">reading<br>
<input type ="checkbox" name = "interests[2]" value ="traveling">traveling<br>
<input type ="checkbox" name = "interests[3]" value ="cooking">cooking<br>
<input type ="checkbox" name = "interests[4]" value ="play sports">playing sports<br>
<input type ="checkbox" name = "interests[5]" value ="watch sports">watching sports<br>
<input type ="checkbox" name = "interests[6]" value ="current events">current events<br>
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
