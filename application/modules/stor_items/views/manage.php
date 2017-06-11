<h1>manage items</h1>
<?php 
if(isset($flash)){
	echo $flash;
} 
?>
  <?php 
      $iems_store_url = base_url().'stor_items/create';
  ?>
   <p><a href="<?= $iems_store_url; ?>"><button type="button" class="btn btn-primary">Add New Item</button></a></p>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white tag"></i><span class="break"></span>Items Details</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Items Title</th>
								  <th>Price</th>
								  <th>Waz Price</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						 <?php foreach($query->result() as $row): ?>
						 	<?php 
						 	$edit_item_url = base_url().'stor_items/create/'.$row->id; 
                            $status = $row->status;
                            if($status == 1){
                               $status_label = 'success';
                               $status_desc = 'active';
                            }else{
                               $status_label = 'default';
                               $status_desc = 'inactive';
                            }
						 	?>
							<tr>
								<td><?= $row->items_title; ?></td>
								<td class="center">$<?= $row->items_price; ?></td>
								<td class="center">$<?= $row->waz_price; ?></td>
								<td class="center">
									<span class="label label-<?= $status_label?>"><?= $status_desc?></span>
								</td>
								<td class="center">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a class="btn btn-info" href="<?= $edit_item_url ?>">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
							
							
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->