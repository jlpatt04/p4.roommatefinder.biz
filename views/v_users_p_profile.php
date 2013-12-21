    <?php
    //prints checked neighborhoods
        if(empty($neighborhood)) {
            echo("You didn't select any neighborhood.");
      }
        else{
             $N = count($neighborhood);
         }
    for($i=0; $i < $N; $i++){
      echo($neighborhood[$i] . " ");
       }

    //prints checked interests
        if (empty($interests)) {
            echo("You didn't select any interests.");
        }
        else{
             $S = count($interests);
         }
    for($j=0; $j < $S; $j++){
        echo($interests[$j] . " ");
       } 
       ?>