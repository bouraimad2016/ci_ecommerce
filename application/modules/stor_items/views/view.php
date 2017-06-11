<div class="row">
  <div class="col-md-4">
  	<img src="<?php echo base_url().'/adminfiles/img/gallery/'.$big_pic; ?>" alt="" class="img-responsive">
  </div>
  <div class="col-md-5">
  	<h1><?php echo $items_title; ?></h1>
  	<?php echo $items_descr; ?>
  </div>
  <div class="col-md-3">
  	<?php echo Modules::run('cart/_draw_item_to_cart', $update_id); ?>
  </div>
</div>

