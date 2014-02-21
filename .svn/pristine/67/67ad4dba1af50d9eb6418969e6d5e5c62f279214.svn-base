<?php
	include('includes/php/header.php');


	if(!isset($_SESSION['username']) || !isset($_SESSION['permLevel'])){
		header("Location: logout.php");
		exit();
	}

	if($_SESSION['permLevel'] < 5) // user not an admin
	{
		header("Location: logout.php");
		exit();
	}
	include('includes/php/htmlHeader.php');
	?>
	<body>
	<div class="container">
	
	<?php include('includes/php/navbar.php'); 

	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$workOrderData = getWorkOrder($_GET['id']);
	}

	print_r($workOrderData);
?>
<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>
<?php

	if(isset($workOrderData))
		echo "Work Order ".($workOrderData['id'] + WORK_ORDER_OFFSET);
	else
		echo "New Work Order"; 
?>
</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="companyName">Company Name</label>
  <div class="controls">
    <select id="companyName" name="companyName" class="input-large">
      <option>Option one</option>
      <option>Option two</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="textinput">Date picker</label>
  <div class="controls">
    <input id="textinput" name="textinput" placeholder="placeholder" class="input-xlarge" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="textinput">Date picker</label>
  <div class="controls">
    <input id="textinput" name="textinput" placeholder="placeholder" class="input-xlarge" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="textinput">time entries</label>
  <div class="controls">
    <input id="textinput" name="textinput" placeholder="placeholder" class="input-xlarge" type="text">
    <p class="help-block">help</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="textinput">billable items</label>
  <div class="controls">
    <input id="textinput" name="textinput" placeholder="placeholder" class="input-xlarge" type="text">
    <p class="help-block">help</p>
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="assignedUser">Assigned User</label>
  <div class="controls">
    <select id="assignedUser" name="assignedUser" class="input-large">
      <option>Option one</option>
      <option>Option two</option>
    </select>
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="techNotes">Tech Notes</label>
  <div class="controls">                     
    <textarea id="techNotes" name="techNotes">Notes go here</textarea>
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="customerNotes">Customer Noates</label>
  <div class="controls">                     
    <textarea id="customerNotes" name="customerNotes">Notes go here</textarea>
  </div>
</div>

</fieldset>
</form>

</body>
<?php include('includes/php/footer.php'); ?>
