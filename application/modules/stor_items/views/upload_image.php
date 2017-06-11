 <h1><?= $headline?></h1>
 <div class="row-fluid sortable">
 	<div class="box span12">
 		<div class="box-header" data-original-title>
 			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Upload Image</h2>
 			<div class="box-icon">

 				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
 				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
 			</div>
 		</div>
 		<div class="box-content">
 			<?php 
 			if(isset($error)){
 				foreach($error as $value){
 					echo "<div style='color: red;margin: 10px 0'>".$value."</div>";
 				}
 			}?>

 			
 			<?php 
 			$attributes = array('class' => 'form-horizontal');
 			echo form_open_multipart('stor_items/do_upload/'.$update_id,$attributes);?>
 			
 			
 			<fieldset>
 				<div class="control-group">
 					<label class="control-label" for="fileInput">File input</label>
 					<div class="controls">
 						<input class="input-file uniform_on" id="fileInput" name="userfile" type="file">
 					</div>
 				</div>          
 				
 				<div class="form-actions">
 					<button type="submit" class="btn btn-primary" value="upload">Save changes</button>
 					<button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
 				</div>
 			</fieldset>
 		</form>   

 	</div>
 </div><!--/span-->

</div><!--/row-->
