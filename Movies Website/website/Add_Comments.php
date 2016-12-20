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
	margin-top: 2%;
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
<span id="font2">Add Ratings and Comments</span>
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

<div class="form">

<form method="GET">

<table style="text-align:center;"> <tr>

<td style="padding: 30px;">
Name: &nbsp
<input type="text" name="name" style="width:180px;"></br></br>
Movie:&nbsp
<select name="movie_title" style="width:180px;">
<?php

$query = "select id, title, year from Movie;";
    
$result = mysql_query($query, $db_connection);

if (!$result) {
    print "Could not obtain current timestamp"; //.mysql_error();
    exit(1);
}

while ($row = mysql_fetch_row($result))
    print '<option value="'.$row[0].'">'.$row[1].' ('.$row[2].')</option>';

?>
</select> </br></br>
Rating: &nbsp
1<input type="radio" name="rating" value="1">  &nbsp
2<input type="radio" name="rating" value="2">  &nbsp
3<input type="radio" name="rating" value="3">  &nbsp
4<input type="radio" name="rating" value="4">  &nbsp
5<input type="radio" name="rating" value="5"> 
</td>

<td style="padding: 30px;">
Comments: </br>
<textarea name="comments" rows="5" cols="35"></textarea></br></br>
</td>

</tr></table>
<input type="submit" value="Submit" class="button2" style="width: 30%">
</form>

</div>

<?php

$name = $_GET["name"];
$id = $_GET["movie_title"];
$rating = $_GET["rating"];
$comments = $_GET["comments"];


if($name && $id && $rating && $comments) 
{
    print '<div class="display">';

	$query = "select now();";
	
	$result = mysql_query($query, $db_connection);

	if (!$result) {
    	print "Could not obtain current timestamp"; //.mysql_error();
    	exit(1);
	}

	$row = mysql_fetch_row($result);
	$time = $row[0];

	$query = 'select title from Movie where id='.$id.';';

	$result = mysql_query($query, $db_connection);

	if (!$result) {
    	print "Could not add Review"; //.mysql_error();
    	exit(1);
	}

    $row = mysql_fetch_row($result);
    $title = $row[0];


	$query = 'insert into Review (name, time, mid, rating, comment) values ("'.$name.'",CURRENT_TIMESTAMP,'.$id.','.$rating.',"'.$comments.'");';

	$result = mysql_query($query, $db_connection);

	if (!$result) {
    	print "Could not add review"; //.mysql_error();
    	exit(1);
	}

	mysql_close($db_connection);

?>

You have added the following </br></br>

<table id="results" border=1 style="align-items: center; margin: 0 auto; font-size: 18px;">
<tr><td> Name </td><td> Title </td> <td> Time </td><td> Rating </td><td> Comments </td></tr>
<tr><td> <?php print $name ?> </td><td> <?php print $title ?> </td> <td> <?php print $time ?> </td> <td> <?php print $rating ?> </td> <td> <?php print $comments ?> </td></tr>
</table> </br>

<?php

print '</div>';

}
else
{    
	if($name || $id || $rating || $comments) 
    {
        print '<div class="display">';
		print "Please fill in all necessary fields";
        print '</div>';
    }    
}

?>

</body>
</html>