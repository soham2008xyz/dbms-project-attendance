<?php global $SITE_ROOT, $schedules, $error, $deleted; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View All Schedules
      <!--<small>Please fill in the details</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Schedules</a></li>
      <li class="active">View All Schedules</li>
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
        <?php if( $deleted ) { ?>
        <div class="alert alert-info alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Done!</strong> Record deleted.
        </div>
        <?php } ?>
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Schedules List</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="schedule-table" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>Actions</th>
                  <th>Weekday</th>
                  <th>Period</th>
                  <th>Subject Name</th>
                  <th>Teacher Name</th>
                  <th>Section Name</th>
                  <th>Batch</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach( $schedules as $schedule ) { ?>
                <tr>
                  <td class="text-center">
                    <a class="btn btn-primary btn-flat" href="schedule-edit.php?id=<?= $schedule["SCHEDULE_ID"] ?>" data-title="Edit">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-flat" href="schedule-list.php?delete=<?= $schedule["SCHEDULE_ID"] ?>" data-title="Delete">
                      <i class="fa fa-trash"></i>
                    </a>
                  </td>
                  <td><?= $schedule["SCHEDULE_WEEKDAY"] ?></td>
                  <td><?= $schedule["SCHEDULE_PERIOD"] ?></td>
                  <td><?= $schedule["SUBJECT_NAME"] ?></td>
                  <td><?= $schedule["TEACHER_NAME"] ?></td>
                  <td><?= $schedule["SECTION_NAME"] ?></td>
                  <td>Batch of <?= $schedule["BATCH_YEAR_PASSOUT"] ?>, <?= $schedule["BATCH_STREAM"] ?></td>
                </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Actions</th>
                  <th>Weekday</th>
                  <th>Period</th>
                  <th>Subject Name</th>
                  <th>Teacher Name</th>
                  <th>Section Name</th>
                  <th>Batch</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>
</div>
