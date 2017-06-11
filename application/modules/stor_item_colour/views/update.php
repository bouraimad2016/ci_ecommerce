<h1><?= $headline?></h1>
<?php echo validation_errors("<div style='color: red;margin: 10px 0'>","</div>"); ?>
<?php 
if(isset($flash)){
	echo $flash;
} 
?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Colour</h2>
			<div class="box-icon">

				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
		<h3>Add new colour is required , press finish whene you finish here</h3>
			<?php $form_url = base_url().'stor_item_colour/submit/'.$update_id;
			?>
			<form class="form-horizontal" action="<?php echo $form_url;?>" method="POST">
				<fieldset>
					<div class="control-group">
						<label class="control-label">Item Colour Option: </label>
						<div class="controls">
							<input type="text" class="span6" name="colour"   />
						</div>
					</div>
					
				
					<div class="form-actions">
						<button type="submit" class="btn btn-primary" name="submit" value="Submit">Save changes</button>
						<button type="submit" class="btn" name="submit" value="Finish">Finish</button>
					</div>
				</fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->
<?php if ($num_rows >0): ?>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Items colour Details</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Items Cout</th>
								  <th>Colour</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						 <?php $count = 0;
						 foreach($query->result() as $row): ?>
						 	<?php $count++;
						 	$delete_item_url = base_url().'stor_item_colour/delete/'.$row->id; 
                           
						 	?>
							<tr>
								<td><?= $count ?></td>
								<td class="center"><?= $row->item_colour; ?></td>
								<td class="center">
									<a class="btn btn-danger" href="<?= $delete_item_url?>">
										<i class="halflings-icon white trash"></i> Remove Option
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
							
							
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
<?php endif; ?>