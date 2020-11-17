<?php $__env->startSection('title', __('admin.push.Push_Notification')); ?>

<?php $__env->startSection('styles'); ?>
<link href="<?php echo e(asset('asset/css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('asset/css/bootstrap-timepicker.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
            <?php if(Setting::get('demo_mode', 0) == 1): ?>
            <div class="col-md-12" style="height:50px;color:red;">
                ** Demo Mode : <?php echo app('translator')->getFromJson('admin.demomode'); ?>
            </div>
            <?php endif; ?> 
            <h5 class="card-title" style="margin-bottom: 2em;"><?php echo app('translator')->getFromJson('admin.push.Push_Notification'); ?></h5>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="<?php echo e(route('admin.send.push')); ?>" method="POST" role="form" id="create_push">

                <?php echo e(csrf_field()); ?>


                <div class="form-group">
                    <label class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.push.Sent_to'); ?></label>
                    <div class="col-xs-10">
                        <select class="form-control" name="send_to" onchange="switch_send(this.value)">
                            <option value="ALL">All Users and Drivers</option>
                            <option value="USERS">All Users</option>
                            <option value="PROVIDERS">All Drivers</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" id="for_users" style="display: none;">
                    <label class="bmd-label-floating">User Condition</label>
                    <div class="col-xs-5">
                        <select class="form-control" name="user_condition" onchange="switch_user_condition(this.value);">
                            <option value="">Select</option>
                            <option value="ACTIVE">For Users active in</option>
                            <option value="LOCATION">Users who are in</option>
                            <option value="RIDES">Who used the service more than</option>
                            <!-- <option value="AMOUNT"> who spent more than </option> -->
                        </select>
                    </div>
                    <div class="col-xs-5" id="user_active" style="display: none;">
                        <select class="form-control" name="user_active">
                            <option value="HOUR">Last one hour</option>
                            <option value="WEEK">Last week</option>
                            <option value="MONTH">Last month</option>
                        </select>
                    </div>

                    <div class="col-xs-5" id="user_rides"  style="display: none;">
                        <input type="number" class="form-control" name="user_rides" placehold="Number of Trips">
                    </div>

                    <div class="col-xs-5" id="user_amount" style="display: none;">
                        <input type="number" class="form-control" name="user_amount" placehold="Value amount">
                    </div>

                    <div class="col-xs-5" id="user_location" style="display: none;">
                        <input type="text" class="form-control"  id="search_location" placehold="Enter Location">
                        <input type="hidden" name="user_location" id="user_point">
                    </div>

                </div>


               <div class="form-group" id="for_providers" style="display: none;">
                     <label class="bmd-label-floating">Drivers Condition</label>
                    <div class="col-xs-5">
                        <select class="form-control" name="provider_condition" onchange="switch_provider_condition(this.value);">
                            <option value="">None</option>
                            <option value="ACTIVE">For drivers active in </option>
                            <option value="LOCATION">Drivers who are in </option>
                            <option value="RIDES">Who answered more than </option>
                            <!-- <option value="AMOUNT">  who earned more than </option> -->
                        </select>
                    </div>
                    <div class="col-xs-5" id="provider_active" style="display: none;">
                        <select class="form-control" name="provider_active">
                            <option value="HOUR">Last one hour</option>
                            <option value="WEEK">Last week</option>
                            <option value="MONTH">Last month</option>
                        </select>
                    </div>

                    <div class="col-xs-5" id="provider_rides"  style="display: none;">
                        <input type="number" class="form-control" name="provider_rides" placehold="Provider rides">
                    </div>

                    <div class="col-xs-5" id="provider_amount" style="display: none;">
                        <input type="number" class="form-control" name="provider_amount" placehold="Provider Amount">
                    </div>

                    <div class="col-xs-5" id="provider_location" style="display: none;">
                        <input type="text" class="form-control" id="search_provider_location" placehold="Enter Location">
                        <input type="hidden" name="provider_location" id="provider_point">
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.push.message'); ?></label>
                    <div class="col-xs-10">
                        <textarea maxlength="200" class="form-control" rows="3" name="message" required id="message" placehold="Digite a Mensagem" ></textarea>
                        <div id="characterLeftDesc"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="zipcode" class="bmd-label-floating"></label>
                    <div class="col-xs-10">							
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.push.Push_Now'); ?></button>
                        &nbsp;
                        <button data-toggle="modal" data-target="#schedule_modal" type="button" class="btn btn-success"><?php echo app('translator')->getFromJson('admin.push.Schedule_Push'); ?></button>
                    </div>
                </div>
            </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header card-header-primary">
            <h5 class="card-title"><?php echo app('translator')->getFromJson('admin.push.Notification_History'); ?></h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->getFromJson('admin.id'); ?></th>
                        <th><?php echo app('translator')->getFromJson('admin.push.Sent_to'); ?></th>
                        <th><?php echo app('translator')->getFromJson('admin.message'); ?></th>
                        <th><?php echo app('translator')->getFromJson('admin.push.Condition'); ?></th>
                        <th><?php echo app('translator')->getFromJson('admin.push.Sent_on'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $Pushes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $Push): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                        <td><?php echo e($Push->send_to); ?></td>
                        <td><?php echo e($Push->message); ?></td>
                        <td><?php echo e($Push->condition); ?></td>
                        <td>
                            <?php if($Push->created_at): ?>
                            <span class="text-muted"><?php echo e($Push->created_at->diffForHumans()); ?></span>
                            <?php else: ?>
                            -
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><?php echo app('translator')->getFromJson('admin.id'); ?></th>
                        <th><?php echo app('translator')->getFromJson('admin.push.Sent_to'); ?></th>
                        <th><?php echo app('translator')->getFromJson('admin.message'); ?></th>
                        <th><?php echo app('translator')->getFromJson('admin.push.Condition'); ?></th>
                        <th><?php echo app('translator')->getFromJson('admin.push.Sent_on'); ?></th>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
        </div>

    </div>
</div>



<!-- Schedule Modal -->
<div id="schedule_modal" class="modal fade schedule-modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Schedule Notification Submission</h4>
            </div>
            <form>
                <div class="modal-body">

                    <label>Data</label>
                    <input value="<?php echo e(date('m/d/Y')); ?>" class="form-control" type="text" id="datepicker" placehold="Data" name="schedule_date">
                    <label>Hora</label>
                    <input value="<?php echo e(date('H:i')); ?>" class="form-control" type="text" id="timepicker" placehold="Hora" name="schedule_time">

                </div>
                <div class="modal-footer">
                    <button type="button" id="schedule_button" class="btn btn-default" data-dismiss="modal">Agendar</button>
                </div>

            </form>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script src="<?php echo e(asset('asset/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('asset/js/bootstrap-timepicker.js')); ?>"></script>

<script type="text/javascript">
    <?php if(Setting::get('demo_mode', 0) == 1): ?>
    $("#create_push :input").prop("disabled", true);
    <?php endif; ?>

            $('#characterLeftDesc').text('100 caracteres restantes');

    $('#message').keyup(function () {
        var max = 100;
        var len = $(this).val().length;
        if (len >= max) {
            $('#characterLeftDesc').text(' You have reached the limit');
        } else {
            var ch = max - len;
            $('#characterLeftDesc').text(ch + ' caracteres restantes');
        }
    });
</script>

<script type="text/javascript">
    function switch_send(send_value) {
        if (send_value == 'USERS') {
            $('#for_users').show();
            $('#for_providers').hide();
        } else if (send_value == 'PROVIDERS') {
            $('#for_users').hide();
            $('#for_providers').show();
        } else {
            $('#for_users').hide();
            $('#for_providers').hide();
        }
    }


    function switch_user_condition(condition_value) {
        if (condition_value == 'ACTIVE') {
            $('#user_active').show();
            $('#user_location').hide();
            $('#user_amount').hide();
            $('#user_rides').hide();
        } else if (condition_value == 'LOCATION') {
            $('#user_active').hide();
            $('#user_location').show();
            $('#user_amount').hide();
            $('#user_rides').hide();
        } else if (condition_value == 'AMOUNT') {
            $('#user_active').hide();
            $('#user_location').hide();
            $('#user_amount').show();
            $('#user_rides').hide();
        } else if (condition_value == 'RIDES') {
            $('#user_active').hide();
            $('#user_location').hide();
            $('#user_amount').hide();
            $('#user_rides').show();
        } else {
            $('#user_active').hide();
            $('#user_location').hide();
            $('#user_amount').hide();
            $('#user_rides').hide();
        }
    }


    function switch_provider_condition(condition_value) {
        if (condition_value == 'ACTIVE') {
            $('#provider_active').show();
            $('#provider_location').hide();
            $('#provider_amount').hide();
            $('#provider_rides').hide();
        } else if (condition_value == 'LOCATION') {
            $('#provider_active').hide();
            $('#provider_location').show();
            $('#provider_amount').hide();
            $('#provider_rides').hide();
        } else if (condition_value == 'AMOUNT') {
            $('#provider_active').hide();
            $('#provider_location').hide();
            $('#provider_amount').show();
            $('#provider_rides').hide();
        } else if (condition_value == 'RIDES') {
            $('#provider_active').hide();
            $('#provider_location').hide();
            $('#provider_amount').hide();
            $('#provider_rides').show();
        } else {
            $('#provider_active').hide();
            $('#provider_location').hide();
            $('#provider_amount').hide();
            $('#provider_rides').hide();
        }
    }

</script>


<script type="text/javascript">
    $(document).ready(function () {
        $('#schedule_button').click(function () {
            $("#datepicker").clone().attr('type', 'hidden').appendTo($('#create_push'));
            $("#timepicker").clone().attr('type', 'hidden').appendTo($('#create_push'));
            document.getElementById('create_push').submit();
        });
    });
</script>
<script type="text/javascript">
    var date = new Date();
    date.setDate(date.getDate() - 1);
    $('#datepicker').datepicker({
        startDate: date
    });
    $('#timepicker').timepicker({showMeridian: false});
</script>


<script>

    var autocomplete, autocompleteprovider;

    function initAutocomplete() {

        autocomplete = new google.maps.places.Autocomplete(document.getElementById('search_location'));
        autocompleteprovider = new google.maps.places.Autocomplete(document.getElementById('search_provider_location'));

        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace().geometry.location;
            set_location(place.lat(), place.lng());
        });

        autocompleteprovider.addListener('place_changed', function () {
            var providerplace = autocompleteprovider.getPlace().geometry.location;
            set_provider_location(providerplace.lat(), providerplace.lng());
        });

    }

    function set_location(lat, lng) {
        document.getElementById('user_point').value = lat + ',' + lng;
    }

    function set_provider_location(lat, lng) {
        document.getElementById('provider_point').value = lat + ',' + lng;
    }

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(Config::get('constants.map_key')); ?>&libraries=places&callback=initAutocomplete"
async defer></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>