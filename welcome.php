<?php

	$host = 'localhost';
	$dbusername = 'root';
	$dbPassword  = '';
	$dbname = 'project';
	$conn = mysqli_connect($host,$dbusername,$dbPassword,$dbname);

	session_start();
	if (!isset($_SESSION['userId'])) {
		header('Location: mini.php');
	}
	
	if (isset($_GET['action'])) {
		if ($_GET['action'] == 'add') {
			
			if (isset($_POST['task']) && !empty($_POST['task'])) {
					$query = mysqli_query($conn, 'insert into tasks (userId, taskContent) values ('.$_SESSION['userId'].', \''.$_POST['task'].'\')');
					if ($query) {
						echo "data inserted";
					} else {
						echo "data not inserted";
						echo mysqli_error($conn);
					}
			}
		} else if ($_GET['action'] == 'delete') {
			echo 'delete entered';
				$taskToDelete = $_GET['taskId'];
				echo 'delete from tasks where taskId='.$taskToDelete;
				$query3 = mysqli_query($conn, 'delete from tasks where taskId='.$taskToDelete);
				if ($query3) {
					echo "task deleted";
				} else {
					echo "task not deltered";
					echo mysqli_error($conn);
				}
		} else if ($_GET['action'] == 'logout') {
			session_start();
			session_destroy();
			header('Location: mini.php');
		}
	}
	
	
?>
<html>
 <head>
 <title>
Welcome
</title>
<link rel = "stylesheet" type = "text/css" href = "style1.css">
</head>
<body BGCOLOR = "#239B56">
<a href="new.php?action=logout">Logout</a>
	<div class = "heading">
	<h1> To Do Lists</h1>
	</div>
	<form action = "new.php?action=add" method = "post">
	<input type = "text" name = "task" class = "task_input">
	<button type = "submit" class = "add_btn" name = "submit">Add</button>
	</form>
<table>
<thead>
    <tr>
		<th>Index</th>
		<th> Task</th>
		 <th> Choice</th>
     </tr> 
</thead>
<tbody>
		
		<?php
			$query2 = mysqli_query($conn, 'select * from tasks where userId = '.$_SESSION['userId']);
			$i = 0;
			while ($data = mysqli_fetch_assoc($query2)) {
				echo '<tr><td>'.($i + 1).'</td>
			<td class= "task">'.$data['taskContent'].'</td>
			<td class = "delete">
			<a href = "new.php?action=delete&taskId='.$data['taskId'].'">x</a>
			</td></tr>';
			$i += 1;
			}
		?>
			
		
</tbody>
</table>
</body>
</html>
