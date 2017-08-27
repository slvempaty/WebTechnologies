<!Doctype html>
<html style="display: table;
            width: 100%;">

<head>
    <style type="text/css">
        table#result,
        table#result th,
        table#result td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        
        table#result {
            margin: auto;
        }
        
        table#details {
            margin: auto;
            border: 1px solid black;
            padding: 10px 70px;
        }
        
        table#details td {
            width: 350px;
        }

    </style>
    <script type="text/javascript">
        function resetForm() {
            resetLabel();
            document.getElementById("CongressDB").selectedIndex = 0;

            document.getElementById("chamber1").checked = true;
            document.getElementById("Keywordvalue").value = "";
            document.getElementById("results").innerHTML = "";
        }

        function changeKeyword() {
            var selectedDatabase = document.getElementById("CongressDB").value;
            var KeywordElement = document.getElementById("Keyword");
            if (selectedDatabase === "Legislators") {
                KeywordElement.innerHTML = "State/representative*";
            } else if (selectedDatabase === "Committees") {
                KeywordElement.innerHTML = "Comittee ID*";
            } else if (selectedDatabase === "Bills") {
                KeywordElement.innerHTML = "Bill ID*";
            } else if (selectedDatabase === "Amendments") {
                KeywordElement.innerHTML = "Amendment ID*";
            } else {
                KeywordElement.innerHTML = "Keyword*";
            }
        }

        function resetLabel() {
            var KeywordElement = document.getElementById("Keyword");
            KeywordElement.innerHTML = "Keyword*";

        }

        function onBodyLoad() {
            <?php 
             
             if(isset($_GET["bio"]))
            {
               if($_GET["CongressDB"] == "legislators")
                        {
                     
                            $StateArray= array(

                                    "ALABAMA"         =>	"AL",
                                    "ALASKA"          =>	"AK",
                                    "ARIZONA"	      =>    "AZ",
                                    "ARKANSAS"	      =>    "AR",
                                    "CALIFORNIA"	  =>    "CA",
                                    "COLORADO"	      =>    "CO",
                                    "CONNECTICUT"     =>    "CT",
                                    "DELAWARE"	      =>    "DE",
                                    "DISTRICT OF COLUMBIA" => "ND",
                                    "FLORIDA"	      =>    "FL",
                                    "GEORGIA"	      =>    "GA",
                                    "HAWAII"	      =>    "HI",
                                    "IDAHO"	          =>    "ID",
                                    "ILLINOIS"	      =>    "IL",
                                    "INDIANA"	      =>    "IN",
                                    "IOWA"	          =>    "IA",
                                    "KANSAS"	      =>    "KS",
                                    "KENTUCKY"	      =>    "KY",
                                    "LOUISIANA"	      =>    "LA",
                                    "MAINE"	          =>    "ME",
                                    "MARYLAND"	      =>    "MD",
                                    "MASSACHUSETTS"   =>    "MA",
                                    "MICHIGAN"        =>    "MI",        	
                                    "MINNESOTA"	      =>    "MN",        
                                    "MISSISSIPPI"     =>    "MS",         	          
                                    "MISSOURI"	      =>    "MO",     
                                    "MONTANA"	      =>    "MT",      
                                    "NEBRASKA"	      =>    "NE",     
                                    "NEVADA"	      =>    "NV",       
                                    "NEW HAMPSHIRE"   =>    "NH",
                                    "NEW JERSEY"	  =>    "NJ",
                                    "NEW MEXICO"	  =>    "NM",
                                    "NEW YORK"	      =>    "NY",                            
                                    "NORTH CAROLINA"  =>    "NC",                                 
                                    "NORTH DAKOTA"	  =>    "ND",                                   
                                    "OHIO"	          =>    "OH",                    
                                    "OKLAHOMA"	      =>    "OK",                        
                                    "OREGON"	      =>    "OR",                      
                                    "PENNSYLVANIA"	  =>    "PA",                                   
                                    "RHODE ISLAND"	  =>    "RI",                                   
                                    "SOUTH CAROLINA"  =>    "SC",                                 
                                    "SOUTH DAKOTA"	  =>    "SD",                                   
                                    "TENNESSEE"	      =>    "TN",                       
                                    "TEXAS"	          =>    "TX",                   
                                    "UTAH"	          =>    "UT",                    
                                    "VERMONT"	      =>    "VT",                         
                                    "VIRGINIA"	      =>    "VA",                        
                                    "WASHINGTON"	  =>    "WA",              
                                    "WEST VIRGINIA"	  =>    "WV",                
                                    "WISCONSIN"       =>    "WI",            	
                                    "WYOMING"	      =>    "WY",                
                                 
                                    );
            
                          
                             
                           $Chamber=$_GET["chamber"];
                          
                           $arrContextOptions=array(
                                                      "ssl"=>array(
                                                                      "verify_peer"=>false,
                                                                      "verify_peer_name"=>false,
                                                                  ),
                                                  );  
                          $context = stream_context_create($arrContextOptions);
                            
                          if(isset( $StateArray[strtoupper($_GET["keyword"])])){
                               $StateID=$StateArray[strtoupper($_GET["keyword"])];
                          
                          $RestURL="http://congress.api.sunlightfoundation.com/legislators?per_page=all&chamber=".$Chamber."&state=".$StateID."&apikey=d49fbc4e14b84390987ebed9dd3dec05";}
                            else{
                                 if ( preg_match('/\s/',$_GET["keyword"]))
                                {
                                    $names = explode(" ", $_GET["keyword"]);
                                    $first= $names[0]; 
                                    $last= $names[1];
                                      $RestURL="http://congress.api.sunlightfoundation.com/legislators?per_page=all&chamber=".$Chamber."&first_name=".$first."&last_name=".$last."&apikey=d49fbc4e14b84390987ebed9dd3dec05";
                                }
                                else{
                                $RestURL="http://congress.api.sunlightfoundation.com/legislators?per_page=all&chamber=".$Chamber."&query=".$_GET["keyword"]."&apikey=d49fbc4e14b84390987ebed9dd3dec05";
                                }
                            }
                          
                          $response = json_decode(file_get_contents($RestURL,false,$context),true);
                             $results=$response["results"];
                          for($y=0;$y<$response["count"];$y++)
                             {
                             
                                 if($results[$y]["bioguide_id"]== $_GET["bio"])
                                 {
                                     $Tabletext='<table id="details"><tr><td colspan="2"><img src="'.'https://theunitedstates.io/images/congress/225x275/'.$_GET["bio"].'.jpg"/>'.'</td></tr>';
                                      $Name=$results[$y]["title"]." ".$results[$y]["first_name"]." ".$results[$y]["last_name"];
                                     $Tabletext.="<tr><td>Full Name</td><td>$Name</td></tr>";
                                     $term=$results[$y]["term_end"];
                                      $Tabletext.="<tr><td>Term ends on</td><td>$term</td></tr>";
                                     $website=$results[$y]["website"];
                                      $Tabletext.="<tr><td>Website</td><td><a href=\"$website\" target=\"_blank\">$website</a></td></tr>";
                                     $office=$results[$y]["office"];
                                     $Tabletext.="<tr><td>office</td><td>$office</td></tr>";
                                     $FB="https://www.facebook.com/".$results[$y]["facebook_id"];
                                     $Fullname=$results[$y]["first_name"]." ".$results[$y]["last_name"];
                                     if($results[$y]["facebook_id"] == null){
                                          $Tabletext.="<tr><td>Facebook</td><td>NA</td></tr>";
                                     }else{
                                          $Tabletext.="<tr><td>Facebook</td><td><a href=\"$FB\" target=\"_blank\">$Fullname</a></td></tr>";
                                     }
                                     
                                     $twitter="https://twitter.com/".$results[$y]["twitter_id"];
                                     if($results[$y]["twitter_id"] == null){
                                          $Tabletext.="<tr><td>Twitter</td><td>NA</td></tr>";
                                     }else{
                                          $Tabletext.="<tr><td>Twitter</td><td><a href=\"$twitter\" target=\"_blank\">$Fullname</a></td></tr>";
                                     }
                                     
                                    $Tabletext.="</table>";
                                  echo "document.getElementById(\"results\").innerHTML='<br/><br/><br/>$Tabletext';"; 
                                     break;
                                 }
                             }
                       
               }
                
                 else if($_GET["CongressDB"] == "bills")
                 {
                        $Bill=$_GET["keyword"];
                             
                        $Chamber=$_GET["chamber"];
                            
                        $arrContextOptions=array(
                                                      "ssl"=>array(
                                                                      "verify_peer"=>false,
                                                                      "verify_peer_name"=>false,
                                                                  ),
                                                  );  
                          $context = stream_context_create($arrContextOptions);
                          
                          $RestURL="http://congress.api.sunlightfoundation.com/bills?bill_id=".$Bill."&chamber=".$Chamber."&apikey=d49fbc4e14b84390987ebed9dd3dec05";
                          
                          $response = json_decode(file_get_contents($RestURL,false,$context),true);
                         
                          $results=$response["results"];
                         for($y=0;$y<$response["count"];$y++)
                             {
                             
                                 if($results[$y]["bill_id"]== $_GET["keyword"])
                                 {
                                 $Tabletext='<table id="details">';
                                      $BillID=$results[$y]["bill_id"];
                                     $Tabletext.="<tr><td>Bill ID</td><td>$BillID</td></tr>";
                                     $title=$results[$y]["short_title"] ;
                                      $Tabletext.="<tr><td>Bill Title</td><td>$title</td></tr>";
                                     $sponsor=$results[$y]["sponsor"]["title"]." ".$results[$y]["sponsor"]["first_name"]." ".$results[$y]["sponsor"]["last_name"];
                                      $Tabletext.="<tr><td>Sponsor</td><td>$sponsor</td></tr>";
                                     $Introduced=$results[$y]["introduced_on"];
                                     $Tabletext.="<tr><td>Introduced On</td><td>$Introduced</td></tr>";
                                     $Last=$results[$y]["last_version"]["version_name"].$results[$y]["last_action_at"];
                                     $Tabletext.="<tr><td>Last action with date</td><td>$Last</td></tr>";
                                        $URL=$results[$y]["last_version"]["urls"]["pdf"];
                                     if($title== null){
                                          $Tabletext.="<tr><td>Bill URL</td><td><a href=\"$URL\" target=\"_blank\">$BillID</a></td></tr>"; 
                                     }else{
                                         $Tabletext.="<tr><td>Bill URL</td><td><a href=\"$URL\" target=\"_blank\">$title</a></td></tr>"; 
                                     }
                                    
                                    $Tabletext.="</table>";
                                  echo "document.getElementById(\"results\").innerHTML='<br/><br/><br/>$Tabletext';"; 
                                     break;
                              }
                         }
                 }
                 
            
            }
    else if(isset($_POST["submit"]))
{ $Alerttext="local host says: \\nPlease enter the following missing information:";
        $Error=false;
        
    if(!isset($_POST["CongressDB"]) || $_POST["CongressDB"] == "")
    {
     $Alerttext.="Congress Database,";
     $Error=true;
       
    }
        if (!isset($_POST["Keywordvalue"]) || trim($_POST["Keywordvalue"]) == '')
        {
            $Alerttext.="Keyword";
             $Error=true;
           
        }
        if($Error == true){
         echo 'alert("'.$Alerttext.'");';
         }
        else{
       if($_POST["CongressDB"] == "Legislators")
                        {
                            $StateArray= array(

                                    "ALABAMA"         =>	"AL",
                                    "ALASKA"          =>	"AK",
                                    "ARIZONA"	      =>    "AZ",
                                    "ARKANSAS"	      =>    "AR",
                                    "CALIFORNIA"	  =>    "CA",
                                    "COLORADO"	      =>    "CO",
                                    "CONNECTICUT"     =>    "CT",
                                    "DELAWARE"	      =>    "DE",
                                    "DISTRICT OF COLUMBIA" => "ND",
                                    "FLORIDA"	      =>    "FL",
                                    "GEORGIA"	      =>    "GA",
                                    "HAWAII"	      =>    "HI",
                                    "IDAHO"	          =>    "ID",
                                    "ILLINOIS"	      =>    "IL",
                                    "INDIANA"	      =>    "IN",
                                    "IOWA"	          =>    "IA",
                                    "KANSAS"	      =>    "KS",
                                    "KENTUCKY"	      =>    "KY",
                                    "LOUISIANA"	      =>    "LA",
                                    "MAINE"	          =>    "ME",
                                    "MARYLAND"	      =>    "MD",
                                    "MASSACHUSETTS"   =>    "MA",
                                    "MICHIGAN"        =>    "MI",        	
                                    "MINNESOTA"	      =>    "MN",        
                                    "MISSISSIPPI"     =>    "MS",         	          
                                    "MISSOURI"	      =>    "MO",     
                                    "MONTANA"	      =>    "MT",      
                                    "NEBRASKA"	      =>    "NE",     
                                    "NEVADA"	      =>    "NV",       
                                    "NEW HAMPSHIRE"   =>    "NH",
                                    "NEW JERSEY"	  =>    "NJ",
                                    "NEW MEXICO"	  =>    "NM",
                                    "NEW YORK"	      =>    "NY",                            
                                    "NORTH CAROLINA"  =>    "NC",                                 
                                    "NORTH DAKOTA"	  =>    "ND",                                   
                                    "OHIO"	          =>    "OH",                    
                                    "OKLAHOMA"	      =>    "OK",                        
                                    "OREGON"	      =>    "OR",                      
                                    "PENNSYLVANIA"	  =>    "PA",                                   
                                    "RHODE ISLAND"	  =>    "RI",                                   
                                    "SOUTH CAROLINA"  =>    "SC",                                 
                                    "SOUTH DAKOTA"	  =>    "SD",                                   
                                    "TENNESSEE"	      =>    "TN",                       
                                    "TEXAS"	          =>    "TX",                   
                                    "UTAH"	          =>    "UT",                    
                                    "VERMONT"	      =>    "VT",                         
                                    "VIRGINIA"	      =>    "VA",                        
                                    "WASHINGTON"	  =>    "WA",              
                                    "WEST VIRGINIA"	  =>    "WV",                
                                    "WISCONSIN"       =>    "WI",            	
                                    "WYOMING"	      =>    "WY",                
                                 
                                    );
            
                          
                             
                           $Chamber=$_POST["Chamber"];
                          
                           $arrContextOptions=array(
                                                      "ssl"=>array(
                                                                      "verify_peer"=>false,
                                                                      "verify_peer_name"=>false,
                                                                  ),
                                                  );  
                          $context = stream_context_create($arrContextOptions);
                            
                          if(isset(  $StateArray[strtoupper(trim($_POST["Keywordvalue"]))])){
                               $StateID=$StateArray[strtoupper(trim($_POST["Keywordvalue"]))];
                          
                          $RestURL="http://congress.api.sunlightfoundation.com/legislators?per_page=all&chamber=".$Chamber."&state=".$StateID."&apikey=d49fbc4e14b84390987ebed9dd3dec05";}
                            else{
                                if ( preg_match('/\s/',trim($_POST["Keywordvalue"])))
                                {
                                    $names = explode(" ", trim($_POST["Keywordvalue"]));
                                    $first= $names[0]; 
                                    $last= $names[1];
                                      $RestURL="http://congress.api.sunlightfoundation.com/legislators?per_page=all&chamber=".$Chamber."&first_name=".$first."&last_name=".$last."&apikey=d49fbc4e14b84390987ebed9dd3dec05";
                                }
                                else
                                {
                                $RestURL="http://congress.api.sunlightfoundation.com/legislators?per_page=all&chamber=".$Chamber."&query=".strtoupper(trim($_POST["Keywordvalue"]))."&apikey=d49fbc4e14b84390987ebed9dd3dec05";
                                }
                            }
                          
                          $response = json_decode(file_get_contents($RestURL,false,$context),true);
                             $results=$response["results"];
                        if($response["count"] == 0)
                          {
                            echo "document.getElementById(\"results\").innerHTML=\"<p> The API returned Zero results for the request </p>\";";  
                          }
                          else{
                              $keywordvalue=trim($_POST["Keywordvalue"]);
                              $Tabletext='<table id="result"><tr><th>Name</th><th>State</th><th>Chamber</th><th>Details</th></tr>';
                                                        
                              for($x=0;$x<$response["count"];$x++)
                              {
                                  $Name=$results[$x]["first_name"]." ".$results[$x]["last_name"];
                                  $State=$results[$x]["state_name"];
                                  $Chamber=$results[$x]["chamber"];
                                  $Details=$results[$x]["bioguide_id"];
                                  $Tabletext.="<tr><td style=\"text-align:left;\">$Name</td><td>$State</td><td>$Chamber</td><td><a href=\"\?bio=$Details&CongressDB=legislators&chamber=$Chamber&keyword=$keywordvalue\">View Details</a></td></tr>";
                              }
                            $Tabletext.="</table>";
                          echo "document.getElementById(\"results\").innerHTML='<br/><br/><br/>$Tabletext';"; 
                          }
                            
                            
                        }
                        else  if($_POST["CongressDB"]=="Committees"){
                            
                            $Committee=strtoupper(trim($_POST["Keywordvalue"]));
                             
                            $Chamber=$_POST["Chamber"];
                            
                            $arrContextOptions=array(
                                                      "ssl"=>array(
                                                                      "verify_peer"=>false,
                                                                      "verify_peer_name"=>false,
                                                                  ),
                                                  );  
                          $context = stream_context_create($arrContextOptions);
                          
                          $RestURL="http://congress.api.sunlightfoundation.com/committees?committee_id=".$Committee."&chamber=".$Chamber."&apikey=d49fbc4e14b84390987ebed9dd3dec05";
                          
                          $response = json_decode(file_get_contents($RestURL,false,$context),true);
                         
                          if($response["count"] == 0)
                          {
                            echo "document.getElementById(\"results\").innerHTML=\"<p> The API returned Zero results for the request </p>\";";  
                          }
                          else{
                              $Tabletext='<table id="result"><tr><th>Committee ID</th><th>Committee Name</th><th>Chamber</th></tr>';
                                  $results=$response["results"];
                       
                              for($x=0;$x<$response["count"];$x++)
                              {
                                  $ID=$results[$x]["committee_id"];
                                  $Name=$results[$x]["name"];
                                  $Chamber=$results[$x]["chamber"];
                                 
                                  $Tabletext.="<tr><td>$ID</td><td>$Name</td><td>$Chamber</td></tr>";
                              }
                            $Tabletext.="</table>";
                          echo "document.getElementById(\"results\").innerHTML='<br/><br/><br/>$Tabletext';"; 
                          }
                            
                
                        }
                      else  if($_POST["CongressDB"]=="Bills"){
                             $Bill=trim($_POST["Keywordvalue"]);
                             
                            $Chamber=$_POST["Chamber"];
                            
                            $arrContextOptions=array(
                                                      "ssl"=>array(
                                                                      "verify_peer"=>false,
                                                                      "verify_peer_name"=>false,
                                                                  ),
                                                  );  
                          $context = stream_context_create($arrContextOptions);
                          
                          $RestURL="http://congress.api.sunlightfoundation.com/bills?bill_id=".$Bill."&chamber=".$Chamber."&apikey=d49fbc4e14b84390987ebed9dd3dec05";
                          
                          $response = json_decode(file_get_contents($RestURL,false,$context),true);
                         
                          if($response["count"] == 0)
                          {
                            echo "document.getElementById(\"results\").innerHTML=\"<p> The API returned Zero results for the request </p>\";";  
                          }
                          else{
                              $Tabletext='<table id="result"><tr><th>Bill ID</th><th>Short Title</th><th>Chamber</th><th>Details</th></tr>';
                                  $results=$response["results"];
                       
                              for($x=0;$x<$response["count"];$x++)
                              {
                                  $ID=$results[$x]["bill_id"];
                                  $Name=$results[$x]["short_title"];
                                  $Chamber=$results[$x]["chamber"];
                                 
                                  $Tabletext.="<tr><td>$ID</td><td>$Name</td><td>$Chamber</td><td><a href=\"\?bio=$ID&CongressDB=bills&chamber=$Chamber&keyword=$Bill\">View Details</a></td></tr>";
                              }
                            $Tabletext.="</table>";
                          echo "document.getElementById(\"results\").innerHTML='<br/><br/><br/>$Tabletext';"; 
                
                        }}
           else  if($_POST["CongressDB"]=="Amendments"){
                            
                             $Amendment
                                 =trim($_POST["Keywordvalue"]);
                             
                            $Chamber=$_POST["Chamber"];
                            
                            $arrContextOptions=array(
                                                      "ssl"=>array(
                                                                      "verify_peer"=>false,
                                                                      "verify_peer_name"=>false,
                                                                  ),
                                                  );  
                          $context = stream_context_create($arrContextOptions);
                          
                          $RestURL="http://congress.api.sunlightfoundation.com/amendments?amendment_id=".$Amendment."&chamber=".$Chamber."&apikey=d49fbc4e14b84390987ebed9dd3dec05";
                          
                          $response = json_decode(file_get_contents($RestURL,false,$context),true);
                         
                          if($response["count"] == 0)
                          {
                            echo "document.getElementById(\"results\").innerHTML=\"<p> The API returned Zero results for the request </p>\";";  
                          }
                          else{
                              $Tabletext='<table id="result"><tr><th>Amendment ID</th><th>Amendment Type</th><th>Chamber</th><th>Introduced on</th></tr>';
                                  $results=$response["results"];
                       
                              for($x=0;$x<$response["count"];$x++)
                              {
                                  $ID=$results[$x]["amendment_id"];
                                  $Type=$results[$x]["amendment_type"];
                                  $Chamber=$results[$x]["chamber"];
                                  $Introduced=$results[$x]["introduced_on"];
                                 
                                  $Tabletext.="<tr><td>$ID</td><td>$Type</td><td>$Chamber</td><td>$Introduced</td></tr>";
                              }
                            $Tabletext.="</table>";
                          echo "document.getElementById(\"results\").innerHTML='<br/><br/><br/>$Tabletext';"; 
                
                        }
                    }   
        
        }

    }
          

   
  ?>
        }

    </script>
</head>




<body style="text-align:center;width:500px;vertical-align: middle;display: block;margin:auto;" onload="onBodyLoad();">
    <h1>Congress Information Search</h1>
    <form method="post" name="CongressInformationSearch" style="padding-left:100px;" action="/Assignments/CongressHW/Congress-withGET.php">
        <table style="border:1px solid black;width:300px;">
            <tr>
                <td>
                    <label for="CongressDB">Congress Database</label></td>
                <td>
                    <select id="CongressDB" name="CongressDB" onchange="changeKeyword();">
                        <option value="" <?php if(isset($_POST[ "submit"]) && $_POST[ 'CongressDB']=="" ) echo ' selected= "selected"' ; ?> >
                            Select your option
                        </option>
                        <option value="Legislators" <?php if((isset($_POST[ "submit"]) && $_POST[ 'CongressDB']=='Legislators')||(isset($_GET["bio"]) && $_GET[ 'CongressDB']=='legislators') ) echo ' selected= "selected"' ; ?> >
                            Legislators
                        </option>
                        <option value="Committees" <?php if(isset($_POST[ "submit"]) && $_POST[ 'CongressDB']=='Committees' ) echo ' selected= "selected"' ; ?> >
                            Committees
                        </option>
                        <option value="Bills" <?php if((isset($_POST[ "submit"]) && $_POST[ 'CongressDB']=='Bills')||(isset($_GET["bio"]) && $_GET[ 'CongressDB']=='bills')  ) echo ' selected= "selected"' ; ?> >
                            Bills
                        </option>   
                        <option value="Amendments" <?php if(isset($_POST[ "submit"]) && $_POST[ 'CongressDB']=='Amendments' ) echo ' selected= "selected"' ; ?> >
                            Amendments
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="Chamber">Chamber</label>
                </td>
                <td>
                    <input type="radio" id="chamber1" name="Chamber" value="senate" <?php if(((!isset($_POST[ "submit"]))||$_POST[ 'Chamber']=='senate' ) ||(isset($_GET[ "bio"]) && $_GET[ 'chamber']=='senate' ))echo ' checked="checked"';?> />
                    <label>Senate</label>
                    <input type="radio" id="chamber2" name="Chamber" value="house" <?php if((isset($_POST[ "submit"]) && $_POST[ 'Chamber']=='house' )|| (isset($_GET[ "bio"]) && $_GET[ 'chamber']=='house' )) echo ' checked="checked"' ; ?> />
                    <label>House</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="Keyword" id="Keyword">
                        <?php echo "<script type='text/javascript'>changeKeyword();</script>"?>
                    </label>
                </td>
                <td>
                    <input type="text" name="Keywordvalue" id="Keywordvalue" value="<?php if(isset($_POST['Keywordvalue'])){echo $_POST['Keywordvalue'];} else if(isset($_GET['bio'])){echo $_GET['keyword'];} else{ echo '';}?>" />
                </td>
                <tr>
                    <td colspan="2">

                        <input type="submit" value="Search" name="submit" />
                        <input type="button" name="reset" value="Clear" onclick="resetForm();" />

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="http://sunlightfoundation.com/" target="_blank"><u>Powered by Sunlight Foundation</u></a>
                    </td>
                </tr>
        </table>
    </form>
    <div id="results">
    </div>
</body>

</html>
