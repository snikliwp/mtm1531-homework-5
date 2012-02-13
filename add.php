<?php 
	require_once 'includes/filter-wrapper.php';

$errors = array();
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
		INSERT INTO movies (title, director, release_date)
		VALUES (:title, :director, :release_date)
		');
	
	
	$sql->bindValue(':title', $title, PDO::PARAM_STR);
	$sql->bindValue(':director', $director, PDO::PARAM_STR);
	$sql->bindValue(':release_date', $release_date, PDO::PARAM_STR);
	$sql->execute();
	
	header('Location: index.php');
	exit;
	}
	
}




?>





<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Add a Movie</title>
</head>

<body>
<form method="post" action="add.php">
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
	<button type="submit">Add</button>
</form>


</body>
</html>