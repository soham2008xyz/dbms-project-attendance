<?php global $conn, $updated, $error; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add New Student
      <small>Please fill in the details</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Students</a></li>
      <li class="active">Add Student</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <?php if ( $updated ) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Success!</strong> A new record has been added.
        </div>
        <?php } ?>
        <?php if ( $error ) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Error!</strong> Please try again.
        </div>
        <?php } ?>
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Student Details</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="<?= $_SERVER["PHP_SELF"] ?>">
            <div class="box-body">
              <div class="form-group">
                <label for="student-name">Name</label>
                <input type="text" maxlength="50" class="form-control" id="student-name" name="student-name" required placeholder="Enter Name">
              </div>
              <div class="form-group">
                <label for="student-email">Email address</label>
                <input type="email" maxlength="50" class="form-control" id="student-email" name="student-email" placeholder="Enter email address">
              </div>
              <div class="form-group">
                <label for="student-phone">Phone number</label>
                <input type="text" maxlength="20" class="form-control" id="student-phone" name="student-phone" placeholder="Enter phone number">
              </div>
              <!--<div class="form-group">
                <label for="batch-id">Batch</label>
                <select class="form-control" id="batch-id" name="batch-id">
                  <?php $batches = $conn->query("SELECT * FROM BATCHES"); ?>
                  <?php foreach ( $batches as $batch ) { ?>
                  <option value="<?= $batch["BATCH_ID"] ?>">
                          Batch of <?= $batch["BATCH_YEAR_PASSOUT"] ?>, <?= $batch["BATCH_STREAM"] ?>
                  </option>
                  <?php } ?>
                </select>
              </div>-->
              <div class="form-group">
                <label for="section-id">Section</label>
                <select class="form-control" id="section-id" name="section-id">
                  <?php $sections = $conn->query("SELECT * FROM SECTIONS INNER JOIN BATCHES ON BATCHES.batch_id = SECTIONS.batch_id "); ?>
                  <?php foreach ( $sections as $section ) { ?>
                  <option value="<?= $section["SECTION_ID"] ?>">
                          Section <?= $section["SECTION_NAME"] ?> of Batch <?= $section["BATCH_YEAR_PASSOUT"] ?>, <?= $section["BATCH_STREAM"] ?>
                  </option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="semester">Semester</label>
                <select class="form-control" id="semester" name="semester">
                  <option value="1">1st</option>
                  <option value="2">2nd</option>
                  <option value="3">3rd</option>
                  <option value="4">4th</option>
                  <option value="5">5th</option>
                  <option value="6">6th</option>
                  <option value="7">7th</option>
                  <option value="8">8th</option>
                </select>
              </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-flat">Submit</button>
            </div>
          </form>
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>
