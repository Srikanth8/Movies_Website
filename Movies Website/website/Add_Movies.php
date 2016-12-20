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
<span id="font2">Add Movies</span>
</div>

<div class="form">

<form method="GET">

<table style="text-align: center;"> <tr>

<td style="padding: 30px;">
Title:&nbsp
<input type="text" name="title"></br></br>
Year:&nbsp
<input type="text" name="year">
</td>

<td style="padding: 30px;">
Rating:&nbsp
<select name="rating">
  <option value="G">G</option>
  <option value="PG">PG</option>
  <option value="PG-13">PG-13</option>
  <option value="R">R</option>
  <option value="NC-17">NC-17</option>
  <option value="surrendere">surrendere</option>
</select> </br></br>
Genre:&nbsp
<select name="genre">
  <option value="Drama">Drama</option>
  <option value="Comedy">Comedy</option>
  <option value="Romance">Romance</option>
  <option value="Crime">Crime</option>
  <option value="Horror">Horror</option>
  <option value="Mystery">Mystery</option>
  <option value="Thriller">Thriller</option>
  <option value="Action">Action</option>
  <option value="Adventure">Adventure</option>
  <option value="Fantasy">Fantasy</option>
  <option value="Documentary">Documentary</option>
  <option value="Family">Family</option>
  <option value="Sci-Fi">Sci-Fi</option>
  <option value="Animation">Animation</option>
  <option value="Musical">Musical</option>
  <option value="War">War</option>
  <option value="Western">Western</option>
  <option value="Adult">Adult</option>
  <option value="Short">Short</option>
</select>
</td>

<td style="padding: 30px;">
Company:&nbsp
<input type="text" name="company"></br></br></br>
</td>
</tr></table>

</br>

<input type="submit" value="Submit" class="button2" style="width: 27%">
</form>

</div>

<?php

$title = $_GET["title"];
$year = $_GET["year"];
$rating = $_GET["rating"];
$genre = $_GET["genre"];
$company = $_GET["company"];

if($title && $year && $rating && $genre && $company) 
{
  print '<div class="display">';

	$db_connection = mysql_connect("localhost", "cs143", "");

	if(!$db_connection) {
    	$errmsg = mysql_error($db_connection);
    	print "Connection failed: $errmsg <br />";
    	exit(1);
	}

	mysql_select_db("CS143", $db_connection);

	$query = "select * from MaxMovieID;";
	
	$result = mysql_query($query, $db_connection);

	if (!$result) {
    	print "Could not add data"; //.mysql_error();
    	exit(1);
	}

	$row = mysql_fetch_row($result);
	$id = $row[0] + 1;

	$query = "update MaxMovieID set id=".$id;

	$result = mysql_query($query, $db_connection);

	if (!$result) {
    	print "Could not add data"; //.mysql_error();
    	exit(1);
	}

  $query = 'select id from Movie where title="'.$title.'" and year='.$year.' and rating="'.$rating.'" and company="'.$company.'";';

  $result = mysql_query($query, $db_connection);

  $row = mysql_fetch_row($result);

  print $row[0];

  if ($row == NULL)
  {
  	$query = 'insert into Movie (id, title, year, rating, company) values ('.$id.',"'.$title.'","'.$year.'","'.$rating.'","'.$company.'");';
  	
  	$result = mysql_query($query, $db_connection);

  	if (!$result) 
    {
      	print "Could not add data"; //.mysql_error();
      	exit(1);
  	}
  }
  else
  {
    $id = $row[0];
  }

  $query = 'insert into MovieGenre (mid, genre) values ('.$id.',"'.$genre.'");';

  $result = mysql_query($query, $db_connection);

  if (!$result) {
      print "Could not add data"; //.mysql_error();
      exit(1);
  }

	mysql_close($db_connection);

?>

You have added the following </br></br>

<table id="results" border=1 style="align-items: center; margin: 0 auto; font-size: 18px;">
<tr><td> Title </td><td> Year </td><td> Rating </td> <td> Genre </td><td> Company </td></tr>
<tr><td> <?php print $title ?> </td><td> <?php print $year ?> </td> <td> <?php print $rating ?> </td> <td> <?php print $genre ?> </td> <td> <?php print $company ?> </td></tr>
</table> </br>

<?php

print '</div>';

}
else
{
	if($title || $year || $rating || $genre || $company) 
  {
    print '<div class="display">';
		print "Please fill in all necessary fields";
    print '</div>';
  }  
}

?>

</body>
</html>