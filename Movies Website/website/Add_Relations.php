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
	color: white;
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
    padding: 8px 16px;
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
    width: 30%;
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
	margin-top: 21%;
	width: 65%;
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
<span id="font2">Add Relations</span>
</div>

<?php

$db_connection = mysql_connect("localhost", "cs143", "");

if(!$db_connection) {
    $errmsg = mysql_error($db_connection);
    print "Connection failed: $errmsg <br />";
    exit(1);
}

mysql_select_db("CS143", $db_connection);

?>

<div class="form" style="float: left; margin-left: 17%">
<form method="GET">

<table style="text-align:center;"> <tr>

<td style="padding: 30px;">
Movie: 
<select name="movie1" style="width:180px;">
<?php

$query = "select id, title, year from Movie;";
    
$result = mysql_query($query, $db_connection);

if (!$result) {
    print "Unable to obtain data from database"; //.mysql_error();
    exit(1);
}

while ($row = mysql_fetch_row($result))
    print '<option value="'.$row[0].'">'.$row[1].' ('.$row[2].')</option>';

?>
</select> </br></br>
Actor: 
<select name="actor" style="width:180px;">
<?php

$query = "select id, first, last from Actor;";
    
$result = mysql_query($query, $db_connection);

if (!$result) {
    print "Unable to obtain data from database"; //.mysql_error();
    exit(1);
}

while ($row = mysql_fetch_row($result))
    print '<option value="'.$row[0].'">'.$row[1].' '.$row[2].'</option>';

?>
</select> </br></br>
Role: 
<input type="text" name="role" style="width:180px;">
</td>

</tr></table>
<input type="submit" value="Submit" class="button2" style="width: 40%">
</form>
</div>


<div class="form" style="float: right; margin-right: 17%">
<form method="GET">

<table style="text-align:center;"> <tr>

<td style="padding: 30px;"> 
<span style="visibility: hidden;"> Role: </span> </br>
Movie: 
<select name="movie2" style="width:180px;">
<?php

$query = "select id, title, year from Movie;";
    
$result = mysql_query($query, $db_connection);

if (!$result) {
    print "Unable to obtain data from database"; //.mysql_error();
    exit(1);
}

while ($row = mysql_fetch_row($result))
    print '<option value="'.$row[0].'">'.$row[1].' ('.$row[2].')</option>';

?>
</select> </br></br>
Director: 
<select name="director" style="width:180px;">
<?php

$query = "select id, first, last from Director;";
    
$result = mysql_query($query, $db_connection);

if (!$result) {
    print "Unable to obtain data from database"; //.mysql_error();
    exit(1);
}

while ($row = mysql_fetch_row($result))
    print '<option value="'.$row[0].'">'.$row[1].' '.$row[2].'</option>';

?>
</select> </br>
<input type="text" style="visibility: hidden;">
</td>

</tr></table>
<input type="submit" value="Submit" class="button2" style="width: 40%">
</form>
</div>


<div class="display">
<?php

$mid1 = $_GET["movie1"];
$actor = $_GET["actor"];
$role = $_GET["role"];
$mid2 = $_GET["movie2"];
$director = $_GET["director"];

if ($actor)
{
    if (!$role)
    {
        print "Please fill in all necessary fields";
        exit(1);
    }

    $query = 'insert into MovieActor values ('.$mid1.','.$actor.',"'.$role.'");';

    $result = mysql_query($query, $db_connection);

    if (!$result) {
        print "Could not add Relation"; //.mysql_error();
        exit(1);
    }

    print 'You have successfully added the relation(s)!';
}

if ($director)
{
    $query = 'insert into MovieDirector values ('.$mid2.','.$director.');';

    $result = mysql_query($query, $db_connection);

    if (!$result) {
        print "Could not add Relation"; //.mysql_error();
        exit(1);
    }

    print 'You have successfully added the relation(s)!';
}

mysql_close($db_connection);

?>

</div>

</body>
</html>