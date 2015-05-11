<?php global $SITE_ROOT, $schedule, $updated, $error; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Schedule
      <small>Please fill in the details</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Schedules</a></li>
      <li class="active">Edit Schedule</li>
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
          <strong>Success!</strong> Your changes have been saved.
        </div>
        <?php } ?>
        <?php if ( $error ) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Error!</strong> Please try again.
        </div>
        <?php } ?>
        <!-- general form elements -->
        <div class="box box-primary box-solid">
          <div class="box-header">
            <h3 class="box-title">Schedule Details</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="<?= $_SERVER["PHP_SELF"] ?>?id=<?= $_GET["id"] ?>">
            <div class="box-body">
              <div class="form-group">
                <label for="weekday">Weekday</label>
                <select class="form-control" id="weekday" name="weekday">
                  <option value="Monday" <?= 'Monday' == $schedule["SCHEDULE_WEEKDAY"] ? "selected" : "" ?>>Monday</option>
                  <option value="Tuesday" <?= 'Tuesday' == $schedule["SCHEDULE_WEEKDAY"] ? "selected" : "" ?>>Tuesday</option>
                  <option value="Wednesday" <?= 'Wednesday' == $schedule["SCHEDULE_WEEKDAY"] ? "selected" : "" ?>>Wednesday</option>
                  <option value="Thursday" <?= 'Thursday' == $schedule["SCHEDULE_WEEKDAY"] ? "selected" : "" ?>>Thursday</option>
                  <option value="Friday" <?= 'Friday' == $schedule["SCHEDULE_WEEKDAY"] ? "selected" : "" ?>>Friday</option>
                  <option value="Saturday" <?= 'Saturday' == $schedule["SCHEDULE_WEEKDAY"] ? "selected" : "" ?>>Saturday</option>
                  <option value="Sunday" <?= 'Sunday' == $schedule["SCHEDULE_WEEKDAY"] ? "selected" : "" ?>>Sunday</option>
                </select>
              </div>
              <div class="form-group">
                <label for="period">Period</label>
                <select class="form-control" id="period" name="period">
                  <option value="1" <?= '1' == $schedule["SCHEDULE_PERIOD"] ? "selected" : "" ?>>1st</option>
                  <option value="2" <?= '2' == $schedule["SCHEDULE_PERIOD"] ? "selected" : "" ?>>2nd</option>
                  <option value="3" <?= '3' == $schedule["SCHEDULE_PERIOD"] ? "selected" : "" ?>>3rd</option>
                  <option value="4" <?= '4' == $schedule["SCHEDULE_PERIOD"] ? "selected" : "" ?>>4th</option>
                  <option value="5" <?= '5' == $schedule["SCHEDULE_PERIOD"] ? "selected" : "" ?>>5th</option>
                  <option value="6" <?= '6' == $schedule["SCHEDULE_PERIOD"] ? "selected" : "" ?>>6th</option>
                  <option value="7" <?= '7' == $schedule["SCHEDULE_PERIOD"] ? "selected" : "" ?>>7th</option>
                  <option value="8" <?= '8' == $schedule["SCHEDULE_PERIOD"] ? "selected" : "" ?>>8th</option>
                </select>
              </div>
              <div class="form-group">
                <label for="section-id">Section</label>
                <select class="form-control" id="section-id" name="section-id">
                  <?php $sections = $conn->query("SELECT * FROM SECTIONS INNER JOIN BATCHES ON BATCHES.batch_id = SECTIONS.batch_id "); ?>
                  <?php foreach ( $sections as $section ) { ?>
                  <option value="<?= $section["SECTION_ID"] ?>" <?= $section["SECTION_ID"] == $schedule["SECTION_ID"] ? "selected" : "" ?>>
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
                  <option value="<?= $subject["SUBJECT_ID"] ?>" <?= $subject["SUBJECT_ID"] == $schedule["SUBJECT_ID"] ? "selected" : "" ?>>
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
                  <option value="<?= $teacher["TEACHER_ID"] ?>" <?= $teacher["TEACHER_ID"] == $schedule["TEACHER_ID"] ? "selected" : "" ?>>
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
