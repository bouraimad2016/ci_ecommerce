	<h1><?= $headline?></h1>
	<?php echo validation_errors("<div style='color: red;margin: 10px 0'>","</div>"); ?>
	<?php 
	if(isset($flash)){
		echo $flash;
	} 
	?>
	<?php  if(is_numeric($update_id)): ?>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header" data-original-title>
					<h2><i class="halflings-icon white edit"></i><span class="break"></span>Account Detail</h2>
					<div class="box-icon">

						<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
						<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					

			<a href="<?php echo base_url().'stor_account/update_password/'.$update_id?>"><button class="btn btn-primary">Update Password</button></a>
				
				<a href="<?php echo base_url().'stor_account/deleteconf/'.$update_id?>"><button class="btn btn-danger">Delete Account</button></a>
				


			</div>
		</div><!--/span-->

	</div><!--/row-->
	<?php endif; ?>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Detail</h2>
				<div class="box-icon">

					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<?php $form_url = base_url().'stor_account/create/'.$update_id;
				?>
				<form class="form-horizontal" action="<?php echo $form_url;?>" method="POST">
					<fieldset>
						<div class="control-group"> <label class="control-label">Firstname: </label> <div class="controls"> <input type="text" class="span6" name="firstname" value="<?php echo $firstname;?>" /> </div> </div>
<div class="control-group"> <label class="control-label">Lastname: </label> <div class="controls"> <input type="text" class="span6" name="lastname" value="<?php echo $lastname;?>" /> </div> </div>
<div class="control-group"> <label class="control-label">Company: </label> <div class="controls"> <input type="text" class="span6" name="company" value="<?php echo $company;?>" /> </div> </div>
<div class="control-group"> <label class="control-label">Adress1: </label> <div class="controls"> <input type="text" class="span6" name="adress1" value="<?php echo $adress1;?>" /> </div> </div>
<div class="control-group"> <label class="control-label">Adress2: </label> <div class="controls"> <input type="text" class="span6" name="adress2" value="<?php echo $adress2;?>" /> </div> </div>
<div class="control-group"> <label class="control-label">Town: </label> <div class="controls"> <input type="text" class="span6" name="town" value="<?php echo $town;?>" /> </div> </div>
<div class="control-group"> <label class="control-label">Country: </label> <div class="controls"> <input type="text" class="span6" name="country" value="<?php echo $country;?>" /> </div> </div>
<div class="control-group"> <label class="control-label">Poste_code: </label> <div class="controls"> <input type="text" class="span6" name="poste_code" value="<?php echo $poste_code;?>" /> </div> </div>
<div class="control-group"> <label class="control-label">Telephone: </label> <div class="controls"> <input type="text" class="span6" name="telephone" value="<?php echo $telephone;?>" /> </div> </div>
<div class="control-group"> <label class="control-label">Email: </label> <div class="controls"> <input type="text" class="span6" name="email" value="<?php echo $email;?>" /> </div> </div>



						<div class="form-actions">
							<button type="submit" class="btn btn-primary" name="submit" value="Submit">Save changes</button>
							<button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
						</div>
					</fieldset>
				</form>   

			</div>
		</div><!--/span-->

	</div><!--/row-->
