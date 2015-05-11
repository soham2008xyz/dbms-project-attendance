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
                <label for="record-date">Date</label>
                <input class="datepicker form-control" id="record-date" name="record-date" data-date-format="mm/dd/yyyy">
              </div>
              
              <div class="form-group">
                <label for="schedule-id">Schedule</label>
                <select class="form-control" id="schedule-id" name="schedule-id">
                  <?php $schedules = $conn->query("SELECT * FROM ATTENDANCE_LIST"); ?>
                  <?php foreach ( $schedules as $schedule ) { ?>
                  <option value="<?= $schedule["SCHEDULE_ID"] ?>">
                    <?= $schedule["SCHEDULE_WEEKDAY"] ?> <?= $schedule["SCHEDULE_PERIOD"] ?> : Subject <?= $section["SUBJECT_NAME"] ?> - Section <?= $schedule["SECTION_NAME"] ?>, <?= $section["BATCH_STREAM"] ?> <?= $section["BATCH_YEAR_PASSOUT"] ?>
                  </option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="student-id">Student</label>
                <select class="form-control" id="student-id" name="student-id">
                  <?php $students = $conn->query("SELECT * FROM SUBJECTS"); ?>
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
