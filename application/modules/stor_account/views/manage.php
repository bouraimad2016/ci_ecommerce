<h1>Manage Account</h1>
<?php 
if(isset($flash)){
	echo $flash;
} 
?>
  <?php 
      $items_account_url = base_url().'stor_account/create';
  ?>
   <p><a href="<?= $items_account_url; ?>"><button type="button" class="btn btn-primary">Add New Account</button></a></p>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white briefcase"></i><span class="break"></span>Customer Account</h2>
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
								  <th>First Name</th>
								  <th>Last Name</th>
								  <th>Company</th>
								  <th>Date Create</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						 <?php 
						 $this->load->module('datemade');
						 foreach($query->result() as $row): ?>
						 <?php 
						 $items_account_url = base_url().'stor_account/create/'.$row->id; 
                         $date_cool = $this->datemade->get_nice_date($row->date_made, 'cool');
						 ?>
						 	
							<tr>
								<td><?= $row->firstname; ?></td>
								<td class="center">$<?= $row->lastname; ?></td>
								<td class="center">$<?= $row->company; ?></td>
								<td class="center">
								<?=  $date_cool?></span>
								</td>
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