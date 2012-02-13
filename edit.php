<?php 
	require_once 'includes/filter-wrapper.php';

$errors = array();
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(empty($id)){
	header('Location: index.php');
}

$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$director = filter_input(INPUT_POST, 'director', FILTER_SANITIZE_STRING);
$release_date = filter_input(INPUT_POST, 'release_date', FILTER_SANITIZE_STRING);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(empty($title)) {
		$errors['title'] = true;
	}
	if(empty($director)) {
		$errors['director'] = true;
	}
	if(empty($release_date)) {
		$errors['release_date'] = true;
	}
	if(empty($errors)) {
	require_once 'includes/db.php';
	$sql = $db-> prepare('
		UPDATE movies 
		SET title= :title, director= :director, release_date= :release_date
		WHERE id =:id
		');
	
	
	$sql->bindValue(':title', $title, PDO::PARAM_STR);
	$sql->bindValue(':director', $director, PDO::PARAM_STR);
	$sql->bindValue(':release_date', $release_date, PDO::PARAM_STR);
	$sql->bindValue(':id', $id, PDO::PARAM_INT);
	$sql->execute();
	
	header('Location: index.php');
	exit;
	}
	
} else {
	
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
		
			$title = $results['title'];
			$director = $results['director'];
			$release_date = $results['release_date'];
			
			
			
		}

?>





<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Add a Movie</title>
</head>

<body>
<form method="post" action="edit.php?id=<?php echo $id; ?>">
	<div class="title">
		<label for="title"> Movie Title <?php if(isset($errors['title'])) : ?> <strong>is Required</strong><?php endif; ?></label>
		<input type="text" id="title" name="title" value="<?php echo $title; ?>" required>
	</div>
	<div class="director">
		<label for="director">Director Name <?php if(isset($errors['director'])) : ?> <strong>is Required</strong><?php endif; ?></label>
		<input type="text" id="director" name="director" value="<?php echo $director; ?>" required>
	</div>
	<div class="release_date">
		<label for= "release_date">Release Date <?php if(isset($errors['release_date'])) : ?> <strong>is Required</strong><?php endif; ?></label>
		<input type="date" id="release_date" name="release_date" value="<?php echo $release_date; ?>" required>
	</div>
	<button type="submit">Submit</button>
</form>



</body>
</html>