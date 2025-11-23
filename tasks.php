<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "DB_connection.php";
    include "app/Model/Task.php";
    include "app/Model/User.php";
    
    $text = "All Task";
    if (isset($_GET['due_date']) &&  $_GET['due_date'] == "Due Today") {
    	$text = "Due Today";
      $tasks = get_all_tasks_due_today($conn);
      $num_task = count_tasks_due_today($conn);

    }else if (isset($_GET['due_date']) &&  $_GET['due_date'] == "Overdue") {
    	$text = "Overdue";
      $tasks = get_all_tasks_overdue($conn);
      $num_task = count_tasks_overdue($conn);

    }else if (isset($_GET['due_date']) &&  $_GET['due_date'] == "No Deadline") {
    	$text = "No Deadline";
      $tasks = get_all_tasks_NoDeadline($conn);
      $num_task = count_tasks_NoDeadline($conn);

    }else{
    	 $tasks = get_all_tasks($conn);
       $num_task = count_tasks($conn);
    }
    $users = get_all_users($conn);
    
	
	function search_tasks($conn, $keyword){
    $sql = "SELECT * FROM tasks 
            WHERE title LIKE ? 
               OR description LIKE ? 
               OR due_date LIKE ? 
               OR assigned_to IN (SELECT id FROM users WHERE full_name LIKE ?)";
    $stmt = $conn->prepare($sql);
    $kw = "%$keyword%";
    $stmt->execute([$kw, $kw, $kw, $kw]);
    if ($stmt->rowCount() > 0) {
        return $stmt->fetchAll();
    } else {
        return [];
    }
	}
	$search = isset($_GET['search']) ? trim($_GET['search']) : "";

	if (!empty($search)) {
		// fungsi baru untuk search di Task.php
		$tasks = search_tasks($conn, $search);
		$num_task = count($tasks);
	} else {
		if (isset($_GET['due_date']) && $_GET['due_date'] == "Due Today") {
			$text = "Due Today";
			$tasks = get_all_tasks_due_today($conn);
			$num_task = count_tasks_due_today($conn);
		} else if (isset($_GET['due_date']) && $_GET['due_date'] == "Overdue") {
			$text = "Overdue";
			$tasks = get_all_tasks_overdue($conn);
			$num_task = count_tasks_overdue($conn);
		} else if (isset($_GET['due_date']) && $_GET['due_date'] == "No Deadline") {
			$text = "No Deadline";
			$tasks = get_all_tasks_NoDeadline($conn);
			$num_task = count_tasks_NoDeadline($conn);
		} else {
			$tasks = get_all_tasks($conn);
			$num_task = count_tasks($conn);
		}
	}




?>
<!DOCTYPE html>
<html>
<head>
	<title>All Tasks</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
		<h4 class="title-2">
			<form method="get" action="tasks.php" style="margin:10px 0;">

				<?php if(isset($_GET['due_date'])): ?>
					<input type="hidden" name="due_date" value="<?=htmlspecialchars($_GET['due_date'])?>">
				<?php endif; ?>
				<div class="search-box">
					<input type="text" id="searchInput" name="search" 
						placeholder="Search by assign to, title, due date" 
						value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
					<?php if (!empty($_GET['search'])): ?>
						<span class="clear-btn" onclick="clearSearch()">×</span>
					<?php endif; ?>
					<button type="submit"><i class="fa fa-search"></i></button>
				</div>
			</form>

			<a href="tasks.php" 
			class="<?= !isset($_GET['due_date']) ? 'active-tab' : '' ?>">
			All Tasks
			</a>
			<a href="tasks.php?due_date=Due Today" 
			class="<?= (isset($_GET['due_date']) && $_GET['due_date']=='Due Today') ? 'active-tab' : '' ?>">
			Due Today
			</a>
			<a href="tasks.php?due_date=Overdue" 
			class="<?= (isset($_GET['due_date']) && $_GET['due_date']=='Overdue') ? 'active-tab' : '' ?>">
			Overdue
			</a>
			<a href="tasks.php?due_date=No Deadline" 
			class="<?= (isset($_GET['due_date']) && $_GET['due_date']=='No Deadline') ? 'active-tab' : '' ?>">
			No Deadline
			</a>
			<a href="create_task.php" class="btn">Create Task</a>
		</h4>

         <h4 class="title-2"><?=$text?> (<?=$num_task?>)</h4>
			<?php if (isset($_GET['success'])) {?>
      	  	<div class="success" role="alert">
			  <?php echo stripcslashes($_GET['success']); ?>
			</div>
		<?php } ?>
			<?php if ($tasks != 0) { ?>
			<div class="table-responsive">
				<table class="main-table">
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Description</th>
						<th>Assigned To</th>
						<th>Due Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					<?php $i=0; foreach ($tasks as $task) { ?>
					<tr>
						<td><?= ++$i ?></td>
						<td><?= $task['title'] ?></td>
						<td><?= $task['description'] ?></td>
						<td>
							<?php 
							foreach ($users as $user) {
								if ($user['id'] == $task['assigned_to']) {
									echo $user['full_name'];
								}
							}
							?>
						</td>
						<td>
							<?php 
							if ($task['due_date'] == "") echo "No Deadline";
							else echo $task['due_date'];
							?>
						</td>
						<td><?= $task['status'] ?></td>
						<td>
							<a href="edit-task.php?id=<?= $task['id'] ?>" class="edit-btn">Edit</a>
							<a href="delete-task.php?id=<?= $task['id'] ?>" class="delete-btn">Delete</a>
						</td>
					</tr>
					<?php } ?>
				</table>
			</div>
		<?php } else { ?>
			<h3>Empty</h3>
		<?php } ?>			
		</section>
	</div>
	<script src="css/script.js"></script>
</body>
</html>
<?php }else{ 
   $em = "First login";
   header("Location: login.php?error=$em");
   exit();
}
 ?>