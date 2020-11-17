<?php $__env->startSection('title', __('admin.peakhour.add_time')); ?>

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('asset/css/bootstrap-material-datetimepicker.css')); ?>" />
<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <div class="container-fluid">
    	<div class="card">
            <div class="card-header card-header-primary">
              <h5 class="card-title"><?php echo app('translator')->getFromJson('admin.peakhour.add_time'); ?></h5>
              <a href="<?php echo e(URL::previous()); ?>" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">

            <form class="form-horizontal" action="<?php echo e(route('admin.peakhour.store')); ?>" method="POST" enctype="multipart/form-data" role="form">
            	<?php echo e(csrf_field()); ?>            	
				
				<div class="form-group">
					<label for="start_time" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.peakhour.start_time'); ?></label>
					<div class="col-xs-10">
						<input class="form-control" autocomplete="off"  type="text" value="<?php echo e(old('start_time')); ?>" name="start_time"  id="start_time" placehold="<?php echo app('translator')->getFromJson('admin.peakhour.start_time'); ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="end_time" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.peakhour.end_time'); ?></label>
					<div class="col-xs-10">
						<input class="form-control" autocomplete="off"  type="text" value="<?php echo e(old('end_time')); ?>" name="end_time"  id="end_time" placehold="<?php echo app('translator')->getFromJson('admin.peakhour.end_time'); ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="" class="bmd-label-floating"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.peakhour.add_time'); ?></button>
						<a href="<?php echo e(route('admin.peakhour.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('asset/js/moment.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('asset/js/bootstrap-material-datetimepicker.js')); ?>"></script>

<script type="text/javascript">
$(document).ready(function()
{    
    $('#start_time').bootstrapMaterialDatePicker({  
        format: 'hh:mm A' ,
        date: false,
     });
    $('#end_time').bootstrapMaterialDatePicker({  
        format: 'hh:mm A' ,
        date: false,
     });

});  
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>