<?php global $conn, $updated, $error; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add New Schedule
      <small>Please fill in the details</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Schedules</a></li>
      <li class="active">Add Schedule</li>
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
            <h3 class="box-title">Schedule Details</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="<?= $_SERVER["PHP_SELF"] ?>">
            <div class="box-body">
              <div class="form-group">
                <label for="weekday">Weekday</label>
                <select class="form-control" id="weekday" name="weekday">
                  <option value="1">Monday</option>
                  <option value="2">Tuesday</option>
                  <option value="3">Wednesday</option>
                  <option value="4">Thursday</option>
                  <option value="5">Friday</option>
                  <option value="6">Saturday</option>
                  <option value="7">Sunday</option>
                </select>
              </div>
              <div class="form-group">
                <label for="period">Period</label>
                <select class="form-control" id="period" name="period">
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
                <label for="subject-id">Subject</label>
                <select class="form-control" id="subject-id" name="subject-id">
                  <?php $subjects = $conn->query("SELECT * FROM SUBJECTS"); ?>
                  <?php foreach ( $subjects as $subject ) { ?>
                  <option value="<?= $subject["SUBJECT_ID"] ?>">
                    <?= $subject["SUBJECT_CODE"] ?> - <?= $subject["SUBJECT_NAME"] ?>
                  </option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
              <label for="teacher-id">Teacher</label>
                <select class="form-control" id="teacher-id" name="teacher-id">
                  <?php $teachers = $conn->query("SELECT * FROM TEACHERS "); ?>
                  <?php foreach ( $teachers as $teacher ) { ?>
                  <option value="<?= $teacher["TEACHER_ID"] ?>">
                    <?= $teacher["TEACHER_NAME"] ?> (<?= $teacher["TEACHER_CODE"] ?>)
                  </option>
                  <?php } ?>
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
