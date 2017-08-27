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
            padding: 10px 50px;
            column-width: 350px;
            column-gap: 70px;
            width: 500px;
            text-align: left;
        }
        
        table#details td {
            padding: 0px 0px 0px 20px;
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
            document.getElementById("Keywordvalue").value = "";
        }

        function validateForm() {
            var CDB = 0;
            var KV = 0;
            var x = document.forms["CongressInformationSearch"]["CongressDB"].value;
            if (x == null || x.trim() == "") {
                CDB = 1;
            }
            var y = document.forms["CongressInformationSearch"]["Keywordvalue"].value;
            if (y == null || y.trim() == "") {
                KV = 1;
            }
            if (CDB == 1 && KV == 1) {
                alert("local host says: \n Please enter the following missing information:Congress Database,Keyword");
                return false;
            } else if (CDB == 1 && KV == 0) {
                alert("local host says: \n Please enter the following missing information:Congress Database");
                return false;
            } else if (CDB == 0 && KV == 1) {
                alert("local host says: \n Please enter the following missing information:Keyword");
                return false;
            }
        }

        function resetLabel() {
            var KeywordElement = document.getElementById("Keyword");
            KeywordElement.innerHTML = "Keyword*";

        }

        function viewDetails(detailsTag) {

            var Detailstext = '<br/><br/><br/><table id="details"><tr><td colspan="2" style=\"text-align:center;\"><img src=\"' + 'https://theunitedstates.io/images/congress/225x275/' + detailsTag.getAttribute("data-Details") + '.jpg\"/>' +
                '</td></tr>';

            Detailstext += "<tr><td>Full Name</td><td>" + detailsTag.getAttribute("data-Name") + "</td></tr>";

            Detailstext += "<tr><td>Term ends on</td><td>" + detailsTag.getAttribute("data-term") + "</td></tr>";

            Detailstext += '<tr><td>Website</td><td><a href="' + detailsTag.getAttribute("data-website") + '" target="_blank">' + detailsTag.getAttribute("data-website") + '</a></td></tr>';

            Detailstext += "<tr><td>office</td><td>" + detailsTag.getAttribute("data-office") + "</td></tr>";
            if (detailsTag.getAttribute("data-FB") == "NA") {

                Detailstext += '<tr><td>Facebook</td><td>NA</td></tr>';
            } else {

                Detailstext += "<tr><td>Facebook</td><td><a href=\"https://www.facebook.com/" + detailsTag.getAttribute("data-FB") + '" target="_blank">' + detailsTag.getAttribute("data-fullName") + '</a></td></tr>';
            }


            if (detailsTag.getAttribute("data-twitter") == "NA") {

                Detailstext += "<tr><td>Twitter</td><td>NA</td></tr>";
            } else {

                Detailstext += "<tr><td>Twitter</td><td><a href=\"https://twitter.com/" + detailsTag.getAttribute("data-twitter") + "\" target=\"_blank\">" + detailsTag.getAttribute("data-fullName") + "</a></td></tr>";
            }

            Detailstext += '</table>';


            document.getElementById("results").innerHTML = Detailstext;
        }


        function billDetails(BillDetails) {


            var Detailstext = '<br/><br/><br/><table id="details">';

            Detailstext += "<tr><td>Bill ID</td><td>" + BillDetails.getAttribute("data-ID") + "</td></tr>";

            Detailstext += "<tr><td>Bill Title</td><td>" + BillDetails.getAttribute("data-title") + "</td></tr>";

            Detailstext += "<tr><td>Sponsor</td><td>" + BillDetails.getAttribute("data-sponsor") + "</td></tr>";

            Detailstext += "<tr><td>Introduced On</td><td>" + BillDetails.getAttribute("data-Introduced") + "</td></tr>";

            Detailstext += "<tr><td>Last action with date</td><td>" + BillDetails.getAttribute("data-Last") + "</td></tr>";

            if (BillDetails.getAttribute("data-title") == "") {

                Detailstext += "<tr><td>Bill URL</td><td><a href=\"" + BillDetails.getAttribute("data-URL") + "\" target=\"_blank\">" + BillDetails.getAttribute("data-ID") + "</a></td></tr>";
            } else {
                Detailstext += "<tr><td>Bill URL</td><td><a href=\"" + BillDetails.getAttribute("data-URL") + "\" target=\"_blank\">" + BillDetails.getAttribute("data-title") + "</a></td></tr>";
            }

            Detailstext += "</table>";


            document.getElementById("results").innerHTML = Detailstext;
        }

        function onBodyLoad() {
            <?php 
            if(isset($_POST["submit"])){
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
                                {   $keywords=strtolower(trim($_POST["Keywordvalue"]));
                                    $names = explode(" ", ucwords($keywords));
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
                                  $tName=$results[$x]["title"]." ".$results[$x]["first_name"]." ".$results[$x]["last_name"];
                                  $term=$results[$x]["term_end"];
                                  array_key_exists("website", $results[$x])?$website=$results[$x]["website"]:$website="NA";
                                  $office=$results[$x]["office"];
                                  if(!array_key_exists("facebook_id", $results[$x]) || $results[$x]["facebook_id"]==null)
                                    {
                                      $FB="NA";
                                    }else{
                                      $FB=$results[$x]["facebook_id"];
                                     }
                                  if(!array_key_exists("twitter_id", $results[$x]) || $results[$x]["twitter_id"] == null)
                                  {
                                      $twitter="NA";
                                  }else{
                                       $twitter=$results[$x]["twitter_id"];
                                     }
                                $Tabletext.="<tr><td style=\"text-align:left;\">$Name</td><td>$State</td><td>$Chamber</td><td><a href=\"JavaScript:void();\" onclick=\"viewDetails(this);\" data-Name=\"$tName\" data-Details=\"$Details\" data-term=\"$term\" data-website=\"$website\" data-office=\"$office\" data-FB=\"$FB\" data-fullName=\"$Name\" data-twitter=\"$twitter\" >View Details</a></td></tr>";
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
                                  $title=$results[$x]["short_title"] ;
                                  $sponsor=$results[$x]["sponsor"]["title"]." ".$results[$x]["sponsor"]["first_name"]." ".$results[$x]["sponsor"]["last_name"];
                                  $Introduced=$results[$x]["introduced_on"];
                                  $Last=$results[$x]["last_version"]["version_name"].", ".$results[$x]["last_action_at"];
                                  $URL=$results[$x]["last_version"]["urls"]["pdf"];
                                  
                                  $Tabletext.="<tr><td>$ID</td><td>$Name</td><td>$Chamber</td><td><a href=\"JavaScript:void();\" onclick=\"billDetails(this);\" data-ID=\"$ID\" data-name=\"$Name\" data-chamber=\"$Chamber\" data-title=\"$title\" data-sponsor=\"$sponsor\" data-Introduced=\"$Introduced\" data-Last=\"$Last\" data-URL=\"$URL\"   >View Details</a></td></tr>";
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
          

   
  ?>
        }

    </script>
</head>




<body style="text-align:center;width:500px;vertical-align: middle;display: block;margin:auto;" onload="onBodyLoad();">
    <h1>Congress Information Search</h1>
    <form method="post" id="CongressInformationSearch" name="CongressInformationSearch" style="padding-left:100px;" action="/Assignments/CongressHW/Congress.php" onsubmit="return validateForm()">
        <table style="border:1px solid black;width:300px;">
            <tr>
                <td>
                    <label for="CongressDB">Congress Database</label></td>
                <td>
                    <select id="CongressDB" name="CongressDB" onchange="changeKeyword();">
                        <option value="" <?php if(isset($_POST[ "submit"]) && $_POST[ 'CongressDB']=="" ) echo ' selected= "selected"' ; ?> >
                            Select your option
                        </option>
                        <option value="Legislators" <?php if(isset($_POST[ "submit"]) && $_POST[ 'CongressDB']=='Legislators') echo ' selected= "selected"' ; ?> >
                            Legislators
                        </option>
                        <option value="Committees" <?php if(isset($_POST[ "submit"]) && $_POST[ 'CongressDB']=='Committees' ) echo ' selected= "selected"' ; ?> >
                            Committees
                        </option>
                        <option value="Bills" <?php if(isset($_POST[ "submit"]) && $_POST[ 'CongressDB']=='Bills') echo ' selected= "selected"' ; ?> >
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
                    <input type="radio" id="chamber1" name="Chamber" value="senate" <?php if((!isset($_POST[ "submit"]))||$_POST[ 'Chamber']=='senate' ) echo ' checked="checked"';?> />
                    <label>Senate</label>
                    <input type="radio" id="chamber2" name="Chamber" value="house" <?php if(isset($_POST[ "submit"]) && $_POST[ 'Chamber']=='house' ) echo ' checked="checked"' ; ?> />
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
                    <input type="text" name="Keywordvalue" id="Keywordvalue" value="<?php if(isset($_POST['Keywordvalue'])){echo $_POST['Keywordvalue'];} else{ echo '';}?>" />
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
    <noscript></noscript>
</body>

</html>
