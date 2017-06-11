<h1>Manage Category</h1>
<?php 
if(isset($flash)){
	echo $flash;
} 
?>
  <?php 
      $items_account_url = base_url().'stor_category/create';
  ?>
   <p><a href="<?= $items_account_url; ?>"><button type="button" class="btn btn-primary">Add New Categories</button></a></p>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Categories</h2>
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
								  <th>Category Name</th>
								  <th>Category Parent Name</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						 <?php 
			            $this->load->module('stor_category');
						 foreach($query->result() as $row): ?>
						 <?php 
						 $items_account_url = base_url().'stor_category/create/'.$row->id; 
						 if($row->cat_parent== 0){
						 	$parent_cat_title = '-';
						 }else{
                        $parent_cat_title = $this->stor_category->_get_cat_parent($row->cat_parent);
                    }
						 ?>
						 	
							<tr>
								<td><?= $row->cat_title; ?></td>
								<td class="center"><?= $parent_cat_title ?></td>
								
								<td class="center">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a class="btn btn-info" href="<?=$items_account_url ?>">
										<i class="halflings-icon white edit"></i>  
									</a>
									
								</td>
							</tr>
						<?php endforeach; ?>
							
							
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->