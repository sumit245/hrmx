<?php
/* Employee Directory view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $countries = $this->Xin_model->get_countries();?>
<?php $get_animate = $this->Xin_model->get_content_animate();?>
<?php $role_resources_ids = $this->Xin_model->user_role_resource();?>

<div class="row <?php echo $get_animate;?>">
  <?php foreach($results as $employee) { ?>
  <?php
	if($employee->profile_picture!='' && $employee->profile_picture!='no file') {
		$u_file = base_url().'uploads/profile/'.$employee->profile_picture;
	} else {
		if($employee->gender=='Male') { 
			$u_file = base_url().'uploads/profile/default_male.jpg';
		} else {
			$u_file = base_url().'uploads/profile/default_female.jpg';
		}
	}
	?>
  <?php $designation = $this->Designation_model->read_designation_information($employee->designation_id);?>
  <?php
		if(!is_null($designation)){
		$designation_name = strtolower($designation[0]->designation_name);
	  } else {
		$designation_name = '--';	
	  }
	?>
  <div class="col-6 col-lg-3">
    <div class="box box-body">
      <div class="text-center"> <a href="#"> <img class="hr-user-img user-img-xin rounded-circle xin-mb-5" src="<?php echo $u_file;?>" alt="<?php echo $employee->first_name;?> <?php echo $employee->last_name;?>"> </a>
        <h3 class="xin-mb-5 emp-name">
          <?php if(in_array('202',$role_resources_ids)) {?>
          <a href="<?php echo site_url('admin/employees/detail')?>/<?php echo $employee->user_id;?>"><?php echo $employee->first_name;?> <?php echo $employee->last_name;?></a>
          <?php } else {?>
          <?php echo $employee->first_name;?> <?php echo $employee->last_name;?>
          <?php } ?>
        </h3>
        <h6 class="user-info mt-0 xin-mb-5 text-lighter"><?php echo ucwords($designation_name);?></h6>
        <div class="gap-items user-social font-size-16 p-15"> <a class="text-facebook" href="<?php echo $employee->facebook_link;?>"><i class="fa fa-facebook"></i></a> <a class="text-light-blue" href="<?php echo $employee->instagram_link;?>"><i class="fa fa-instagram"></i></a> <a class="text-red" href="<?php echo $employee->google_plus_link;?>"><i class="fa fa-google"></i></a> <a class="text-aqua" href="<?php echo $employee->twitter_link;?>"><i class="fa fa-twitter"></i></a> </div>
        <p><?php echo $employee->address;?> </p>
        <?php if(in_array('202',$role_resources_ids)) {?>
        <a href="<?php echo site_url('admin/employees/detail')?>/<?php echo $employee->user_id;?>" class="btn btn-rounded btn-primary btn-sm">View more <i class="fa fa-arrow-circle-right"></i></a>
        <?php } else {?>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
<?php if (isset($links)) { ?>
<ul class="pagination pagination-sm no-margin">
  <?php foreach ($links as $link) { 
    echo "<li>". $link."</li>";
    } ?>
</ul>
<?php } ?>
