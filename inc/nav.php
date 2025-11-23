<nav class="side-bar">
	<div class="user-p">
		<img src="img/user1.jpeg">
		<h4>@<?=$_SESSION['username']?></h4>
	</div>
	
	<?php 

		if($_SESSION['role'] == "employee"){
		?>
<!-- Employee navigation bar -->
	<ul id="navList">
		<li>
			<a href="index.php">
				<i class="fa fa-tachometer" aria-hidden="true"></i>
				<span>Dashboard</span>
			</a>
		</li>
		<li>
			<a href="my_task.php">
				<i class="fa fa-tasks" aria-hidden="true"></i>
				<span>My Task</span>
			</a>
		</li>
		<li>
			<a href="profile.php">
				<i class="fa fa-user" aria-hidden="true"></i>
				<span>Profile</span>
			</a>
		</li>
		<li>
			<a href="notifications.php">
				<i class="fa fa-bell" aria-hidden="true"></i>
				<span>Notifications</span>
			</a>
		</li>
		<li>
			<a href="logout.php">
				<i class="fa fa-sign-out" aria-hidden="true"></i>
				<span>Logout</span>
			</a>
		</li>
	</ul>
	<?php }else { ?>
<!-- admin navigation bar -->
	<ul id="navList">
		<li>
			<a href="index.php">
				<i class="fa fa-tachometer" aria-hidden="true"></i>
				<span>Dashboard</span>
			</a>
		</li>
		<li>
			<a href="user.php">
				<i class="fa fa-users" aria-hidden="true"></i>
				<span>Manage Users</span>
			</a>
		</li>
		<li>
			<a href="create_task.php">
				<i class="fa fa-plus" aria-hidden="true"></i>
				<span>Create Task</span>
			</a>
		</li>
		<li>
			<a href="tasks.php">
				<i class="fa fa-tasks" aria-hidden="true"></i>
				<span>All Tasks</span>
			</a>
		</li>
		<li>
			<a href="logout.php">
				<i class="fa fa-sign-out" aria-hidden="true"></i>
				<span>Logout</span>
			</a>
		</li>
	</ul>
<?php } ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const current = window.location.pathname.split('/').pop();
  document.querySelectorAll('#navList li a').forEach(link => {
    const href = link.getAttribute('href');
    if (href === current) {
      link.parentElement.classList.add('active');
    } else {
      link.parentElement.classList.remove('active');
    }
  });
});
</script>
</nav>