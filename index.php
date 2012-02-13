<?php 
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
<ul>
<?php foreach ($results as $movie) : ?>
 <li>
 <a href="single.php?id=<?php echo $movie['id'];?>"><?php  echo $movie['title']; ?> </a>
 &bull;
<a href="delete.php?id=<?php echo $movie['id'];?>">Delete</a>
</li>
 <?php endforeach ?>

</ul>


</body>
</html>