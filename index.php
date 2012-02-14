<?php 
	require_once 'includes/filter-wrapper.php';
require_once 'includes/db.php';

$results = $db->query('SELECT id, title, release_date, director 
				FROM movies 
				ORDER BY release_date ASC');
?>


<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Movies</title>
	<link href="css/general.css" rel="stylesheet">
</head>

<body>
<!--		<table border="1">-->
		<table class='main'>
<!--	The caption element briefly describes the contents of the table -->
		<caption>Movie List</caption>
			<tbody>
			<nav>
				<?php foreach ($results as $movie) : ?>
				 <tr><td>
				 <a href="single.php?id=<?php echo $movie['id'];?>"><?php  echo $movie['title']; ?> </a>
				 </td><td>
				<a href="edit.php?id=<?php echo $movie['id'];?>">Edit</a>
				 </td><td>
				<a href="delete.php?id=<?php echo $movie['id'];?>">Delete</a>
				</td></tr>
				 <?php endforeach ?>
			</nav>
			</tbody>
		</table>
<br>
	<a href="add.php"><button class="add">Add a New Movie</button></a>

</body>
</html>