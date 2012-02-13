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
<h1>Movie List</h1>
<nav>
	<ul>
		<?php foreach ($results as $movie) : ?>
		 <li>
		 <a href="single.php?id=<?php echo $movie['id'];?>"><?php  echo $movie['title']; ?> </a>
		 &bull;
		<a href="edit.php?id=<?php echo $movie['id'];?>">Edit</a>
		 &bull;
		<a href="delete.php?id=<?php echo $movie['id'];?>">Delete</a>
		</li>
		 <?php endforeach ?>
	</ul>
</nav>

	<a href="add.php"><button class="add">Add a New Movie</button></a>

</body>
</html>