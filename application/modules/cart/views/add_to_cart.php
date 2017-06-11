<h3>Add To Cart</h3>
<div class="table_cart">
	<table class="table text-center">
	
		<tr>
			<h4>Item Id: 	
		<?= $item_id ?></h4>
		</tr>
		
	<?php if($colour_count>0): ?>
		<tr>
			<td>Colour:</td>
			<td>
				<?php    
				$id_select_form = 'class="form-control"'; 
				echo form_dropdown('status', $colour_options, $submited_colour,$id_select_form);
				?>
			</td>
		</tr>
	<?php endif; ?>
		<?php if($size_count>0): ?>
		<tr>
			<td>Size :</td>
			<td>
				<?php    
				$id_select_form = 'class="form-control"'; 
				echo form_dropdown('status', $size_options, $submited_size,$id_select_form);
				?>
			</td>
		</tr>
	<?php endif; ?>
		<tr>
			<td>Qty :</td>
			<td>
				<input type="text" col="4">
			</td>
		</tr>
		<tr>
		    <td></td>
			<td>
				<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span>Add To Basket</button>
			</td>
		</tr>
	</table>
</div>