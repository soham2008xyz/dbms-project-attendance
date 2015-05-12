<?php global $SITE_ROOT, $records, $error, $deleted; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View Attendance Records
      <!--<small>Please fill in the details</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Attendance Records</a></li>
      <li class="active">View Attendance Records</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <?php if( $error ) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Error!</strong> Please try again.
        </div>
        <?php } else { ?>
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Attendance Records List</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="attendance-records-table" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>Actions</th>
                  <th>Date</th>
                  <th>Batch</th>
                  <th>Section</th>
                  <th>Teacher</th>
                  <th>Subject</th>
                  <th>Number of Students</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach( $records as $record ) { ?>
                <tr>
                  <td class="text-center">
                    <a class="btn btn-primary btn-flat" href="attendance-view.php?date=<?= $record["ATTENDANCE_RECORD_DATE"] ?>&schedule=<?= $record["SCHEDULE_ID"] ?>" data-title="View">
                      <i class="fa fa-eye"></i>
                    </a>
                  </td>
                  <td><?= $record["ATTENDANCE_RECORD_DATE"] ?></td>
                  <td>Batch of <?= $record["BATCH_YEAR_PASSOUT"] ?>, <?= $record["BATCH_STREAM"] ?></td>
                  <td>Section <?= $record["SECTION_NAME"] ?></td>
                  <td><?= $record["TEACHER_NAME"] ?> <small>(<?= $record["TEACHER_CODE"] ?>)</small></td>
                  <td><?= $record["SUBJECT_NAME"] ?> <small>(<?= $record["SUBJECT_CODE"] ?>)</small></td>
                  <td><?= $record["NUM_STUDENTS"] ?></td>
                </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                    <th>Actions</th>
                    <th>Date</th>
                    <th>Batch</th>
                    <th>Section</th>
                    <th>Teacher</th>
                    <th>Subject</th>
                    <th>Number of Students</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div><!-- /.box -->
        <?php } ?>
      </div>
    </div>
  </section>
</div>
