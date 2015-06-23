<?php global $conn, $students, $updated, $error; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Attendance Records
    <?php if($_SERVER["REQUEST_METHOD"] == "GET") { ?>
        <small>Please fill in the details</small>
    <?php } ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Attendance Records</a></li>
      <li class="active">Add Attendance Records</li>
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
          <strong>Success!</strong> Schedule loaded.
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
                <label for="schedule-id">Schedule</label>
                <select class="form-control" id="schedule-id" name="schedule-id">
                  <?php $schedules = $conn->query("SELECT * FROM SCHEDULES
                  INNER JOIN SECTIONS
                  ON SECTIONS.SECTION_ID = SCHEDULES.SECTION_ID
                  INNER JOIN BATCHES
                  ON BATCHES.BATCH_ID = SECTIONS.BATCH_ID
                  INNER JOIN SUBJECTS
                  ON SUBJECTS.SUBJECT_ID = SCHEDULES.SUBJECT_ID
                  INNER JOIN TEACHERS
                  ON TEACHERS.TEACHER_ID = SCHEDULES.TEACHER_ID"); ?>
                  <?php foreach ( $schedules as $schedule ) { ?>
                  <option value="<?= $schedule["SCHEDULE_ID"] ?>">
                    <?= $schedule["TEACHER_NAME"] ?> <small>(<?= $schedule["TEACHER_CODE"] ?>)</small> - <?= $schedule["SUBJECT_NAME"] ?> <small>(<?= $schedule["SUBJECT_CODE"] ?>)</small> - Batch of <?= $schedule["BATCH_YEAR_PASSOUT"] ?>, <?= $schedule["BATCH_STREAM"] ?> <small>(Section <?= $schedule["SECTION_NAME"] ?>)</small> - <?= $schedule["SCHEDULE_WEEKDAY"] ?>,  Period <?= $schedule["SCHEDULE_PERIOD"] ?>
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
          <?php if($_SERVER["REQUEST_METHOD"] == "POST") { ?>
          <form method="post" action="attendance-save.php">
          <div class="box box-primary">
              <div class="box-header">
                  <h3 class="box-title">Student Attendance</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                  <input type="hidden" name="schedule-id" value="<?= $_POST["schedule-id"] ?>" />
                  <div class="form-group">
                      <label for="date">Date</label>
                      <input type="date" name="date" id="date" class="form-control">
                  </div>
                    <table class="table table-bordered table-striped table-hover" id="attendance-table">
                        <thead>
                            <tr>
                                <th>Roll Number</th>
                                <th>Student Name</th>
                                <th>Attendance Record</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach( $students as $student ) { ?>
                            <tr>
                                <td><?= $student["STUDENT_ID"] ?></td>
                                <td><?= $student["STUDENT_NAME"] ?></td>
                                <td>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary btn-flat active">
                                            <input type="radio" name="<?= $student["STUDENT_ID"] ?>" id="present-<?= $student["STUDENT_ID"] ?>" value="Present" checked> Present
                                        </label>
                                        <label class="btn btn-primary btn-flat">
                                            <input type="radio" name="<?= $student["STUDENT_ID"] ?>" id="absent-<?= $student["STUDENT_ID"] ?>" value="Absent"> Absent
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Roll Number</th>
                                <th>Student Name</th>
                                <th>Attendance Record</th>
                            </tr>
                        </tfoot>
                    </table>
              </div>
              <div class="box-footer">
                  <button type="submit" class="btn btn-primary btn-flat">Submit</button>
              </div>
          </div><!-- /.box -->
              </form>
          <?php } ?>
      </div>
    </div>
  </section>
</div>
