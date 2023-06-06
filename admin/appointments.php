  <?php 
	  include("include/header.php");
	  include("controller/appointments.php");
  ?>
  <body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

   <?php include("include/nav.php");?>


    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
		 <ul class="nav nav-tabs" role="tablist">
			<li class="nav-item">
			  <a class="nav-link <?php if($_GET['data'] == 'pending'){ echo 'active'; } ?>"  href="appointments?data=pending">Pending Appointments</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link  <?php if($_GET['data'] == 'approved'){ echo 'active'; } ?>"   href="appointments?data=approved">Approved Appointments</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link  <?php if($_GET['data'] == 'done'){ echo 'active'; } ?>"  href="appointments?data=done">Done Appointments</a>
			</li>
		  </ul>
			<div class="row">
				<div class="col-12">
					<div class="card">
					
						<div class="card-header">
						
							<h4 class="card-title"> Appointments Records </h4>
							<div class="heading-elements">
								<button class="btn btn-sm round btn-info btn-glow" data-toggle="modal" data-backdrop="false" data-target="#backdrop"><i class="la la-plus font-medium-1"></i>
								Add Appointments </button>
							</div>
							<br>
						
						</div>
						
						<div class="card-content">
						
							<div class="table-responsive">
								<table class="table alt-pagination wallet-wrapper table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center">Patient Name</th>
											<th class="text-center">Doctors Name</th>
											<th class="text-center">Date</th>
											<th class="text-center">Time</th>
											<th class="text-center">Status</th>
										</tr>
									</thead>
									<tbody>
									<?php while($val = $is_appointments->fetch_object()){ ?>
										<tr>
											<td class="text-center"><?php echo $val->p_fname . ' '. $val->p_lastname;?></td>
											<td class="text-center">Dr<?php echo $val->d_fname . ' '. $val->d_lname;?></td>
											<td class="text-center"><?php echo $val->appointment_date;?></td>
											<td class="text-center"><?php echo $val->appointment_time;?></td>
											<td class="text-center"><?php if( $val->status == 0) { echo "Pending";} else { echo '<a href="#" data-toggle="modal" data-backdrop="false" data-target="#results'.$val->appointment_id.'" class="btn round btn-outline-info btn-sm"> <i class="la la-check"></i> View Results </a>';} ?></td>
											
										</tr>
										<div class="modal fade text-left" id="results<?php echo $val->appointment_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" style="display: none;" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title" id="myModalLabel4"> Results</h4>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close" fdprocessedid="oewei8">
															<span aria-hidden="true">×</span>
														</button>
													</div>
													<div class="modal-body">
													<form method="POST">
												
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label for="projectinput1">Consultation Result</label>
																<br><br>
																<b><?php echo $val->consultation;?></b>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label for="projectinput1">Diagnosis Result</label>
																<br><br>
																<b><?php echo $val->diagnosis;?></b>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label for="projectinput3">Treatment Details</label>
																<br><br>
																<b><?php echo $val->treatment;?></b>
															</div>
														</div>
													
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal" >Close</button>
													</div>
												</form>
												</div>
											</div>
										</div>

									<?php } ?>	
								
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

        </div>
      </div>
    </div>
<div class="modal fade text-left" id="backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel4">Appointments Details</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" fdprocessedid="oewei8">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
			<form method="POST">
			<div class="form-group">
				<label for="companyName">Patients Name : </label>
				<select  class="form-control" name="patients_id" required>
					<option value=""> - Select Patient - </option>
					<?php
						$is_patients = $mysqli->query("SELECT * from is_patients");
						while($val = $is_patients->fetch_object()){
					?>
						<option value="<?php echo $val->patient_id;?>"> <?php echo $val->firstname . ' '.  $val->lastname;?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="companyName">Doctors Name: </label>
				<select  class="form-control" name="doctor_id" required>
					<option value=""> - Select Patient - </option>
						<?php
						$is_doctors = $mysqli->query("SELECT * from is_doctors");
						while($val = $is_doctors->fetch_object()){
					?>
						<option value="<?php echo $val->doctor_id;?>"> Dr. <?php echo $val->firstname . ' '.  $val->lastname;?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="companyName">Date: </label>
				<input type="date" class="form-control"  name="a_date" required>
			</div>
			<div class="form-group">
				<label for="companyName">Time: </label>
				<input type="time" class="form-control"  name="a_time" required>
			</div>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal" >Close</button>
				<button type="submit" class="btn btn-outline-primary" name="process">Process</button>
			</div>
		</form>
		</div>
	</div>
</div>

<?php include("include/footer.php");?>
