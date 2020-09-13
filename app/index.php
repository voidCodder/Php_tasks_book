<? 
//For saving tasks
session_start();

include_once '../php/main.php';
include_once '../php/pagination.php';
include_once '../php/sortItems.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<title>Task book</title>
	<meta name="viewport" content="width=device-width">
	<link rel="icon" href="images/favicon.png">
	<link rel="stylesheet" href="css/app.min.css">

</head>

<body>

	<div class="container-lg header-wrapper">

		<div class="row">
			<!-- Dropdown -->
			<div class="dropdown col">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Sort by
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="?sortby=name">Name</a>
					<a class="dropdown-item" href="?sortby=email">Email</a>
					<a class="dropdown-item" href="?sortby=status">Status</a>
				</div>
			</div>

			<!-- Create task panel -->
			<div class="col">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CreateTaskPanel">
					Add task
				</button>
				<!-- Modal -->
				<div class="modal fade" id="CreateTaskPanel" tabindex="-1" role="dialog" aria-labelledby="CreateTaskPanelTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">New task</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="form-task" action="/phpActions/addTask.php" method="post">
									<div class="form-group">
										<label for="user-name" class="col-form-label">User name:</label>
										<input type="text" class="form-control" id="user-name" name="userName" required placeholder="Enter your name...">
									</div>
									<div class="form-group">
										<label for="user-email" class="col-form-label">Email:</label>
										<input type="text" class="form-control" id="user-email" name="userEmail" required placeholder="Enter your email...">
									</div>
									<div class="form-group">
										<label for="message-text" class="col-form-label">Message:</label>
										<textarea class="form-control" id="message-text" name="userMessage"></textarea>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" form="form-task">Create task</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Admin Panel -->
			<div class="col">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalAdminPanel">
					Login
				</button>
				<!-- Modal -->
				<div class="modal fade" id="ModalAdminPanel" tabindex="-1" role="dialog" aria-labelledby="ModalAdminPanelTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="LoginModalTitle">Login</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="form-login" action="/phpActions/Login.php" method="post">
									<div class="form-group">
										<label for="user-login" class="col-form-label">Email address</label>
										<input type="text" class="form-control" id="user-login" name="userLogin" required placeholder="Enter email...">
									</div>
									<div class="form-group">
										<label for="user-password" class="col-form-label">Email:</label>
										<input type="text" class="form-control" id="user-password" name="userPassword" required placeholder="Password...">
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" form="form-login">Login</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-2">
				<span>You are now:</span>
				<span class="header-user">
				<? if($_SESSION['status'] == 1) echo 'Admin'; else echo 'User'; ?>
				</span>
			</div>

		</div>

	</div>
			
	<div class="container-lg">

		<? foreach ($tasks as $key => $task): ?>

			<div class="task__content row 
			<? if($task["status"] == 1) echo task__content_checked ?>"
			data-type-task
			data-id="<?=$task["id"]?>"
			>
				<div class="col">
					<div>Name: <?=$task["userName"] ?> </div>
					<div>Email: <?=$task["email"] ?></div>
					<div>
						<div>Description:</div>
						<div class="task-description" 
						data-task-description 
						data-id="<?=$task["id"]?>"
						><?=$task["description"] ?></div>
					</div>
				</div>

				<? if($_SESSION['status'] == 1) { ?>
				<div class="task-buttons-wrapper col-2">
					<button type="button" class="btn btn-outline-primary task-buttons__button_fit" 
					data-id="<?=$task["id"]?>" 
					data-event-edit>Edit</button>
					<button type="button" class="btn btn-outline-success task-buttons__button_fit" 
					data-id="<?=$task["id"]?>" 
					data-event-save>Save</button>
					<div class="form-check">
						<input type="checkbox" 
						class="form-check-input" 
						id="CheckTask<?=$key?>" 
						data-id="<?=$task["id"]?>" 
						data-type-checkbox
						<? if($task["status"] == 1) echo checked ?>
						>
						<label class="form-check-label" 
						for="CheckTask<?=$key?>"
						>Completed</label>
					</div>
				</div>
				<? } ?>
			
			</div>

		<? endforeach; ?>

	</div>

	<footer class="container-lg">
		<nav aria-label="Page navigation">
			<ul class="pagination">
				<li class="page-item <? if($active == 1) echo "disabled" ?> ">
					<a class="page-link" href="<?=$url_page.($active - 1)?>">Previous</a>
				</li>

				<? for ($i = $minPage; $i <= $maxPage; $i++) { ?>

				<li class="page-item <? if($i == $active) echo "active" ?> ">
					<a class="page-link" href="<?=$url_page.$i?>"><?=$i?></a>
				</li>

				<? } ?>
				
				<li class="page-item <? if($active == $count_pages) echo "disabled" ?> ">
					<a class="page-link" href="<?=$url_page.($active + 1)?>">Next</a>
				</li>
			</ul>
		</nav>
	</footer>
					
	<script src="js/app.min.js"></script>

</body>
</html>
