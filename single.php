<?php 
	require_once 'includes/filter-wrapper.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (empty($id)) {
	header('Location: index.php');
	exit;
};

// you only need to connect to the database if the id is not empty
require_once 'includes/db.php';

// prepare() creates a stored procedure 
$sql = $db->prepare('
	SELECT id, title, release_date, director
	FROM movies
	WHERE id = :id
');


$sql->bindValue(':id', $id, PDO::PARAM_INT);

// executes the stored procedure
$sql->execute();
// gets the results from the quey and put it into the variable
// fetch() is for one result
// fetchAll is if we expect more than one result
$results = $sql->fetch();

if (empty($results)) {
	header('Location: index.php');
	exit;
};


?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $results['title'];?> &middot; Movies</title>
	<link href="css/general.css" rel="stylesheet">
</head>

<body>
	<table class='main'>
	<caption><?php echo $results['title'];?></caption>
		<tbody>
			<tr>
				<td>Release Date: </td>
				<td><?php echo $results['release_date']; ?></td>
			</tr>
			<tr>
				<td>Director: </td>
				<td><?php echo $results['director']; ?></td>
			</tr>
		</tbody>
	</table>
	<br>
	<a href="index.php"><button class="add">Back to the Movie List</button></a>

</body>
</html>