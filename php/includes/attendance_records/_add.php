<?php global $conn, $updated, $error; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Take Attendance
      <small>Please fill in the details</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Attendance Records</a></li>
      <li class="active">Take Attendance</li>
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
                <label for="teacher-id">Teacher</label>
                <select class="form-control" id="teacher-id" name="teacher-id">
                  <?php $teachers = $conn->query("SELECT DISTINCT SCHEDULES.TEACHER_ID, TEACHERS.TEACHER_CODE, TEACHERS.TEACHER_NAME
                  FROM SCHEDULES
                  INNER JOIN TEACHERS
                  ON TEACHERS.TEACHER_ID = SCHEDULES.TEACHER_ID"); ?>
                  <?php foreach ( $teachers as $teacher ) { ?>
                  <option value="<?= $teacher["TEACHER_ID"] ?>">
                    <?= $teacher["TEACHER_NAME"] ?> <small>(<?= $teacher["TEACHER_CODE"] ?>)</small>
                  </option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="subject-id">Subject</label>
                <select class="form-control" id="subject-id" name="subject-id">
                  <?php $subjects = $conn->query("SELECT "); ?>
                  <?php foreach ( $subjects as $subject ) { ?>
                  <option value="<?= $subject["SUBJECT_ID"] ?>">
                    <?= $subject["SUBJECT_NAME"] ?> <small>(<?= $subject["SUBJECT_CODE"] ?>)</small>
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
