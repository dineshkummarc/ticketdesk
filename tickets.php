<?php
include_once 'include/functions.php';
include_once 'include/connect.php';
sec_session_start();

if(login_check(dbConnect()) == true) {
	include_once('include/navbar.php');
        // Add your protected page content here!
?>
// set active menu bar
<script>$('#tickets').addClass("active");</script>

<body>

<nav class="navbar navbar-default navbar-fixed-top navbar-inverse subMenu">
  <div class="navbar-inner container-fluid container-fluid">
    <ul class="nav navbar-nav">
    	<li id="subMenuNew"><a href="./main.php">New</a></li>
	<li id="subMenuMine"><a href="./tickets.php?ticketId=mine">My Tickets</a></li>
	<li id="subMenuAll"><a href="./tickets.php?ticketId=all">All</a></li>
	<li id="subMenuOpen"><a href="./tickets.php?ticketId=open">Open</a></li>
	<li id="subMenuClient" ><a href="./tickets.php?ticketId=woc">Waiting on Client</a></li>
	<li id="subMenuAgent" ><a href="./tickets.php?ticketId=woa">Waiting on Agent</a></li>
	<li id="subMenuClosed"><a href="./tickets.php?ticketId=closed">Closed</a></li>
    </ul>
  </div>
</nav>

<div id="content">

<?php

if (isset($_POST['updateTicket'])) {
	$ticket = new ticket();
	$ticket->getTicket($_POST['ticketId']);
	$ticket->setAssignedUser($_POST['assignedUser']);
	$ticket->setStatus($_POST['status']);
	$ticket->setGroupId($_POST['group']);
	$ticket->setComments($_POST['comments']);
	$ticket->setSubject($_POST['subject']);

	if ($_POST['ticketNote'] != "") {
		$ticket->addNote($_POST['ticketNote']);
	}
	if ($_POST['previousAssignedUser'] != $_POST['assignedUser']) {
		$user = user::withUserName($ticket->getAssignedUser());

		$systemEmail = system::withName('system email');
		$systemSiteUrl = system::withName('siteurl');

		$message = "You've been assigned a ticket!";
		$to = $user->getEmail();
		$subject = "Ticketdesk - Ticket Assignment";
		$from = $systemEmail->getValue();
		$body = 'Hi ' .$ticket->getAssignedUser() . ', <br/> <br/>Ticket id: '. $ticket->getId() .
						' has been assigned to you Click <a href="http://' . $systemSiteUrl->getValue() .'/tickets.php?ticketId='. $ticket->getId() .
						'">here</a> to view the ticket<br/>';
		$headers = "From: " . strip_tags($from) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($to,$subject,$body,$headers);
	}
	if ($ticket->updateTicket()) {
		echo 'Ticket saved!';
		echo '<META http-equiv="refresh" content="0;URL=./main.php">';
	} else {
		echo 'update failed: ' . $ticket->getMysqli()->error;
	}


/*
echo 'clientId = '. $ticket->getclientId();
echo '<br>user = '. $ticket->getUser();
echo '<br>category = '. $ticket->getCategoryId();
echo '<br>sub category = '. $ticket->getSubCategoryId();
echo '<br>TransferYn = '. $ticket->getTransferYn();
echo '<br>TransferDeptId = '. $ticket->getTransferDeptId();
echo '<br>OpenDate = '. $ticket->getOpenDate();
echo '<br>Assigned User = '. $ticket->getAssignedUser();
echo '<br>';
	*/

	// add note

}
?>

	<div id="displayTickets" class="panel panel-default">
					<div class="panel-heading">Tickets</div>
					<?php isset($_GET['ticketId']) ? $ticketId = $_GET['ticketId'] : $ticketId = null;?>

        	<?php if ($ticketId == 'all') { ?>
        			<script>$("#subMenuAll").addClass("active"); </script>
        	    <?php ticket::displayTickets('all'); ?>
        	<?php } elseif ($ticketId == 'mine') { ?>
        			<script>$("#subMenuMine").addClass("active"); </script>
        			<?php ticket::displayTickets('mine'); ?>
        	<?php } elseif ($ticketId == 'open') { ?>
        			<script>$("#subMenuOpen").addClass("active"); </script>
        			<?php ticket::displayTickets('Open'); ?>
        	<?php }	elseif ($ticketId == 'woa') { ?>
							<script>$("#subMenuAgent").addClass("active"); </script>
							<?php ticket::displayTickets('Waiting on agent'); ?>
						<?php } elseif ($ticketId == 'woc') {  ?>
								<script>$("#subMenuClient").addClass("active"); </script>
								<?php ticket::displayTickets('Waiting on client'); ?>
						<?php } elseif ($ticketId == 'closed') { ?>
								<script>$("#subMenuClosed").addClass("active"); </script>
								<?php ticket::displayTickets('Closed'); ?>
		<?php } else {
        		$ticket = new ticket();
        		if (isset($_POST['ticketId'])) {$ticket->getTicket($_POST['ticketId']);}
        		if (isset($_GET['ticketId'])) {$ticket->getTicket($_GET['ticketId']);}

        		$category = new category();
        		$category->getCategory($ticket->getCategoryId());
        		$subcat = new subCategory();
        		$subcat->getSubCategory($ticket->getSubCategoryId());
        		// display and update notes...
        	?>
			<div class="panel-body">
        			<div class="well">
				<form class="form" method="POST">
					<input type="text" name="ticketId" value="<?php echo ''. $ticket->getId(); ?>" hidden />
					<input type="text" name="previousAssignedUser" value="<?php echo '' . $ticket->getAssignedUser();?>" hidden />
			                <div class="form-group">
			                    <label for="ticketId" class="col-sm-2 control-label">Ticket# </label>
			                    <div class="col-sm-10">
			                    	<input class="form-control" name="ticketId" type="text" disabled value="<?php echo ''. $ticket->getId();?> " />
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label for="ClientId" class="col-sm-2 control-label">Client# </label>
			                    <div class="col-sm-10">
			                    	<input class="form-control" name="ClientId" type="text"  value="<?php echo ''. $ticket->getClientId(); ?>" />
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label for="subject" class="col-sm-2 control-label">Subject:</label>
			                    <div class="col-sm-10">
			                    	<input class="form-control" name="subject" type="text"  value="<?php echo ''. $ticket->getSubject(); ?>" />
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label for="comments" class="col-sm-2 control-label">Description:</label>
			                    <div class="col-sm-10">
			                    	<textarea class="form-control verticalonly" name="comments" type="text" ><?php echo ''. $ticket->getComments(); ?> </textarea>
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label for="user" class="col-sm-2 control-label">Created By:</label>
			                    <div class="col-sm-10">
			                    	<input class="form-control" name="user" disabled type="text"  value="<?php echo ''. $ticket->getUser(); ?>" />
			                    </div>
			                </div>


			                <div class="form-group">
			                    <label for="category" class="col-sm-2 control-label">Category:</label>
			                    <div class="col-sm-10">
			                    	<input class="form-control" name="category" disabled type="text"  value="<?php echo ''. $category->getName(); ?>" />
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label for="subCategory" class="col-sm-2 control-label">Sub Category:</label>
			                    <div class="col-sm-10">
			                    	<input class="form-control" name="subCategory" disabled type="text"  value=" <?php echo ''. $subcat->getName(); ?>" />
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label for="status" class="col-sm-2 control-label">Status:</label>
			                    <div class="col-sm-10">
			                        <select class="form-control" name="status">
			        			<option value="<?php echo ''. $ticket->getStatus(); ?>"><?php echo ''. $ticket->getStatus(); ?> </option>
			        			<option value="Closed">Closed</option>
			        			<option value="Open">Open</option>
			        			<option value="Waiting on Client">Waiting On Client</option>
			        			<option value="Waiting on Agent">Waiting On Agent</option>
			        			<option value="Waiting on 3rd Party">Waiting On 3rd Party</option>
		        			</select>
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label for="ticketNote" class="col-sm-2 control-label">Add Notes:</label>
			                    <div class="col-sm-10">
			                        <textarea class="form-control" rows="5" name="ticketNote" id="ticketNote"></textarea>
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label for="group" class="col-sm-2 control-label">Assigned group:</label>
			                    <div class="col-sm-10">
			        		<select class="form-control" name="group">
			        			<?php $department = department::withId($ticket->getGroupId()); ?>
			        			<option value="<?php echo ''. $department->getId(); ?> "> <?php echo ''. $department->getName(); ?> </option>
			   				<?php department::displayDepartmentsOptionList(); ?>

			        		</select>
			                    </div>
			                </div>


			                <div class="form-group">
			                    <label for="assignedUser" class="col-sm-2 control-label">Assigned User:</label>
			                    <div class="col-sm-10">
			        		<select class="form-control" name="assignedUser">
			        			<option value="<?php echo ''. $ticket->getAssignedUser();?> "> <?php echo ''. $ticket->getAssignedUser();?></option>
			   				<?php user::displayUserOptionList(); ?>

			        		</select>
			                    </div>
			                </div>

					<button name="updateTicket" class="btn btn-primary" type="submit">Update</button>


	        		</form>
	        		</div>
	        	</div>
	        	<?php $ticket->getNotes();?>
		<?php }	?>
        </div>

</div>
</body>

<?php
// end protected content
} else {
        echo 'You are not authorized to access this page redirecting you to the <a href="./index.php">login page</a>.';
        echo '<META http-equiv="refresh" content="2;URL=./index.php">';
}

?>
