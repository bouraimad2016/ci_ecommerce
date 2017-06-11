<h1><?= $headline?></h1>

<?php 
if(isset($flash)){
	echo $flash;
} 
?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Confirm Delete</h2>
			<div class="box-icon">

				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			

			<h3>Ar you sure that you want  delete item ?</h3>
           
			<?php echo form_open('stor_items/delete/'.$update_id);?>
 			
 			
 			<fieldset>     
 				
 				
 					<button type="submit" class="btn btn-danger" name="submit" value="Yes - delete">Yes - delete</button>
 					<button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
 			
 			</fieldset>
 		</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->