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
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Detail</h2>
			<div class="box-icon">

				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
		<?php 
         $big_pic = (isset($big_pic)?$big_pic: '');

		if($big_pic==''):?>
			<a href="<?php echo base_url().'stor_items/upload_image/'.$update_id?>"><button class="btn btn-primary">Upload Item Image</button></a>
		<?php else: ?>
			<a href="<?php echo base_url().'stor_items/delete_image/'.$update_id?>"><button class="btn btn-danger">Delete Item Image</button></a>
		<?php endif; ?>
			<a href="<?php echo base_url().'stor_item_colour/update/'.$update_id?>"><button class="btn btn-primary">Update Item Colors</button></a>
			<a href="<?php echo base_url().'stor_item_size/update/'.$update_id?>"><button class="btn btn-primary">Update Item Size</button></a>
			<a href=""><button class="btn btn-primary">Update Item Categorie</button></a>
			<a href="<?php echo base_url().'stor_items/deleteconf/'.$update_id?>"><button class="btn btn-danger">Delete Item</button></a>
			<a href="<?php echo base_url().'stor_items/view/'.$update_id?>"><button class="btn btn-default">View Item In Shop</button></a>



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
			<?php $form_url = base_url().'stor_items/create/'.$update_id;
			?>
			<form class="form-horizontal" action="<?php echo $form_url;?>" method="POST">
				<fieldset>
					<div class="control-group">
						<label class="control-label">Item Title : </label>
						<div class="controls">
							<input type="text" class="span6" name="item_title" value="<?php echo $items_title;?>"  />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Item Price : </label>
						<div class="controls">
							<input type="text" class="span6" name="item_price" value="<?php echo $items_price; ?>"  />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Was Price <span style="color: #7bca73">(optional)</span>: </label>
						<div class="controls">
							<input type="text" class="span6" name="was_price" value="<?php echo $waz_price;?>"  />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Status : </label>
						<div class="controls">
						<?php    

							$id_select_form = 'id="selectError3"'; 
							$options = array(
								''      =>  'Please Choose...',
								'1'        => 'active',
								'0'        => 'inactive'
								);

							echo form_dropdown('status', $options, $status,$id_select_form);

							?>

						</div>
					</div>


					<div class="control-group hidden-phone">
						<label class="control-label" for="textarea2">Description :</label>
						<div class="controls">
							<textarea class="cleditor" id="textarea2" rows="3" name="item_description"><?php echo $items_descr; ?></textarea>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary" name="submit" value="Submit">Save changes</button>
						<button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
					</div>
				</fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->
<?php 
$big_pic = (isset($big_pic)?$big_pic: '');
if($big_pic!=''):?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Image</h2>
			<div class="box-icon">

				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			
         <img src="<?= base_url().'adminfiles/img/gallery/'.$big_pic?>">
		</div>
	</div><!--/span-->

</div><!--/row-->
<?php endif; ?>