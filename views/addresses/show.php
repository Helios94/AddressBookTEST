<br/>
<div class="row">
    <div class="col-md-3">
        <div class="card">
        <img src="<?php echo $address->avatar != null ? $address->avatar : 'assets/img/avatar.png' ?>" class="card-img-top" alt="Avatar Picture">
        <div class="card-body">
            <h5 class="card-title"><?php echo $address->first_name; ?> <?php echo strtoupper($address->last_name); ?></h5>
            <a href="?controller=addresses&action=edit&id=<?php echo $address->id_address; ?>" class="btn btn-sm btn-primary">Edit Address</a>
        </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <h5 class="card-header">Contact Infos</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div><strong>Company : </strong><?php echo $address->company != null ? $address->company : '<a href="?controller=addresses&action=index">Add missing info.</a>' ?></div>
                        <div><strong>Work Email : </strong><?php echo $address->work_email != null ? '<a href="mailto:'.$address->work_email.'">'.$address->work_email.'</a>' : '<a href="?controller=addresses&action=index">Add missing info</a>' ?></div>
                        <div><strong>Personal Email: </strong><?php echo $address->personal_email != null ? '<a href="mailto:'.$address->personal_email.'">'.$address->personal_email.'</a>' : '<a href="?controller=addresses&action=index">Add missing info</a>' ?></div>
                    </div>
                    <div class="col-md-6">
                        <div><strong>Mobile : </strong><?php echo $address->mobile_number != null ? '<a href="tel:'.$address->mobile_number.'">'.$address->mobile_number.'</a>' : '<a href="?controller=addresses&action=index">Add missing info.</a>' ?></div>
                        <div><strong>Work : </strong><?php echo $address->work_number != null ? '<a href="tel:'.$address->work_number.'">'.$address->work_number.'</a>' : '<a href="?controller=addresses&action=index">Add missing info</a>' ?></div>
                        <div><strong>Home : </strong><?php echo $address->home_number != null ? '<a href="tel:'.$address->home_number.'">'.$address->home_number.'</a>' : '<a href="?controller=addresses&action=index">Add missing info</a>' ?></div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="card">
            <h5 class="card-header">Address Details</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div><strong>Street : </strong><?php echo $address->street != null ? $address->street : '<a href="?controller=addresses&action=index">Add missing info.</a>' ?></div>
                        <div><strong>City : </strong><?php echo $address->city != null ? $address->city : '<a href="?controller=addresses&action=index">Add missing info</a>' ?></div>
                        <div><strong>Zip : </strong><?php echo $address->zip != null ? $address->zip : '<a href="?controller=addresses&action=index">Add missing info</a>' ?></div>
                        <div><strong>State : </strong><?php echo $address->state != null ? $address->state : '<a href="?controller=addresses&action=index">Add missing info</a>' ?></div>
                        <div><strong>Country : </strong><?php echo $address->country != null ? $address->country : '<a href="?controller=addresses&action=index">Add missing info</a>' ?></div>
                    </div>
                    <div class="col-md-6">
                        <h6>Full Address</h6>
                        <address>
                            <?php echo $address->first_name; ?> <?php echo strtoupper($address->last_name); ?><br/>
                            <?php echo $address->street ?><br/>
                            <?php echo $address->city ?><br/>
                            <?php echo $address->zip ?>, <?php echo $address->state ?><br/>
                            <?php echo $address->country ?>
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
