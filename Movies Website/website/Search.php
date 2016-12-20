<html>

<head>
<title>CS143 Project 1B</title>
<style type="text/css">

body{
 	margin-top:50px;
 	text-align: center;
}

a:link, a:visited{
	text-decoration: none;
	color: black;
	font-size: 105%;
}

a:hover, a:active {
	text-decoration: none;
	color: purple;
	font-size: 105%;
}

.button1 {
    background-color: white; /* Green */
    border: none;
    color: black;
    border: 2px solid #4CAF50;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
    border-radius: 5px;
}

.button1:hover {
    background-color: #4CAF50;
    color: white;
}

.button2 {
    background-color: white; /* Green */
    border: none;
    color: black;
    border: 2px solid #0074D9;
    padding: 6px 14px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 3%;
}

.button2:hover {
    background-color: #0074D9;
    color: white;
}

#menuBar {
   position: fixed;
   top:0;
   left:0;
   width:100%;
   height:20%px;
   text-align: center;
   font-size: 16px;
   background-color: white;
 }

#table a
{
    display:block;
    text-decoration:none;
}

.form {
	margin: auto;
	margin-top: 1%;
    width: 60%;
    border: groove 1px solid gray;
    padding: 10px;
    text-align:center;
    display: flex;
	justify-content: center;
	align-items: center;
	box-shadow: 0px 0px 2px #888888;
	border-radius: 25px;
}

.display {
	margin: auto;
	margin-top: 4%;
	width: 60%;
	padding: 10px;
	text-align:center;
	justify-content: center;
	align-items: center;
	border: groove 1px solid gray;
	font-size: 18px;
	box-shadow: 0px 0px 2px #888888;
	border-radius: 25px;
}

.title {
	margin: auto;
	margin-top: 10%;
	width: 60%;
	padding: 10px;
	text-align:center;
	border: groove 3px solid gray;
	/*box-shadow: 0px 0px 2px #888888;*/
}

table {
    border: groove 4px solid gray;
}

td {
	padding: 5px;
}

#font1{
   	font-family: Candara, Calibri, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
   	font-size: 50px;
}

#font2{
	font-family: Candara, Calibri, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
   	font-size: 30px;
}

</style>
</head>

<body>

<div id="menuBar">

<span id="font1">MOVIES DATABASE</span>

<table id="table" style="width:100%; text-align:center;">
  <tr>
    <td width=14.3%><a href="Add_ActorsDirectors.php" class="button1">Add Actors/Directors</a></td>	
    <td width=14.3%><a href="Add_Movies.php" class="button1">Add Movies</a></td>
    <td width=14.3%><a href="Add_Comments.php" class="button1">Add Reviews</a></td>
    <td width=14.3%><a href="Add_Relations.php" class="button1">Add Relations</a></td>
    <!-- <td width=14.3%><a href="Browse_Actors.php" class="button1">Browse Actors</a></td>
    <td width=14.3%><a href="Browse_Movies.php" class="button1">Browse Movies</a></td> -->
    <td width=14.3%><a href="Search.php" class="button1">Search & Browse Actors/Movies</a></td>
  </tr>
</table>

</div>

<div class="title">
<span id="font2">Search Actors and Movies</span>
</div>

<div class="form">
<form method="GET">

<input type="text" name="search" style="width:180px;"> 

&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

<input type="submit" value="Search" class="button2" style="width: 120px">

</form>
</div>

<?php

$search = $_GET["search"];

if ($search)
{
    print '<div class="display">';

    $db_connection = mysql_connect("localhost", "cs143", "");

    if(!$db_connection) {
        $errmsg = mysql_error($db_connection);
        print "Connection failed: $errmsg <br />";
        exit(1);
    }

    mysql_select_db("CS143", $db_connection);


    $searchWords = explode(" ", $search);


    $query = 'select CONCAT(first, " ", last), dob, id from Actor';

    $result = mysql_query($query, $db_connection);

    if (!$result) {
        print "Could not run database query"; //.mysql_error();
        exit(1);
    }

    print '<strong>Actors</strong><br><br>';

    while ($row = mysql_fetch_row($result))
    {
        $include = true;

        foreach($searchWords as $word)
        {
            $pos = strpos(strtolower($row[0]), strtolower($word));

            if ($pos === false) 
            {
                $include = false;
                break;
            }
        }

        if ($include)
        {
            print '<a href="Browse_Actors.php?id='.$row[2].'">';
            print $row[0].' ('.$row[1].')';   
            print '</a><br>';    
        }
    }


    $query = 'select title, year, id from Movie';

    $result = mysql_query($query, $db_connection);

    if (!$result) {
        print "Could not run database query"; //.mysql_error();
        exit(1);
    }


    print '<hr style="margin-top: 3%; color: lightgray;"><br>';

    print '<strong>Movies</strong><br><br>';

    while ($row = mysql_fetch_row($result))
    {
        $include = true;

        foreach($searchWords as $word)
        {
            $pos = strpos(strtolower($row[0]), strtolower($word));

            if ($pos === false) 
            {
                $include = false;
                break;
            }
        }

        if ($include) 
        {
            print '<a href="Browse_Movies.php?id='.$row[2].'">';
            print $row[0].' ('.$row[1].')';   
            print '</a><br>';    
        }
    }



    mysql_close($db_connection);

    print '</div>';
}

?>

</body>
</html>

<!-- $titleWords = explode(" ", $row[0]);

 $isSubset = array_diff($searchWords, $titleWords);

if (!$isSubset)
    print $row[0].' ('.$row[1].')'; -->