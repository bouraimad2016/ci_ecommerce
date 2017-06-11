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
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Upload Success</h2>
			<div class="box-icon">

				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<div class="alert alert-success">Your file was successfully uploaded!</div>

			<ul>
				<?php foreach ($upload_data as $item => $value):?>
					<li><?php echo $item;?>: <?php echo $value;?></li>
				<?php endforeach; ?>
			</ul>
            <?php   
              $item_url_image = base_url().'stor_items/create/'.$update_id;     
            ?>
			<a href="<?=$item_url_image ?>"><button class="btn btn-primary">Upload Anothar Image Item</button></a>


		</div>
	</div><!--/span-->

</div><!--/row-->