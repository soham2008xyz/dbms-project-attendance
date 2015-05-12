<?php global $SITE_ROOT, $conn, $routines, $updated, $error; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Student Routine
      <?php if($_SERVER["REQUEST_METHOD"] == "GET") { ?>
      <small>Please fill in the details</small>
      <?php } ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Students</a></li>
      <li class="active">Student Routine</li>
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
          <strong>Success!</strong> Routine loaded.
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
            <h3 class="box-title">Batch & Section Details</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="<?= $_SERVER["PHP_SELF"] ?>">
            <div class="box-body">
                <div class="form-group">
                    <label for="section-id">Section</label>
                    <select class="form-control" id="section-id" name="section-id">
                        <?php $sections = $conn->query("SELECT * FROM SECTIONS INNER JOIN BATCHES ON BATCHES.batch_id = SECTIONS.batch_id "); ?>
                        <?php foreach ( $sections as $section ) { ?>
                            <option value="<?= $section["SECTION_ID"] ?>">
                                Section <?= $section["SECTION_NAME"] ?> - Batch of <?= $section["BATCH_YEAR_PASSOUT"] ?>, <?= $section["BATCH_STREAM"] ?>
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
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Section Routine</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="routine-table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Day of Week</th>
                                <th>Period 1</th>
                                <th>Period 2</th>
                                <th>Period 3</th>
                                <th>Period 4</th>
                                <th>Period 5</th>
                                <th>Period 6</th>
                                <th>Period 7</th>
                                <th>Period 8</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $days_of_week = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"); ?>
                        <?php for( $i = 1; $i<6; $i++ ) { ?>
                            <tr>
                                <td><strong><?= $days_of_week[$i] ?></strong></td>
                                <?php for( $j = 1; $j <= 8; $j++ ) { ?>
                                    <td>
                                    <?php foreach( $routines as $routine ) { ?>
                                        <?php if( $routine["SCHEDULE_WEEKDAY"] == $days_of_week[$i] && $routine["SCHEDULE_PERIOD"] == $j ) { ?>
                                            <strong><?= $routine["SUBJECT_NAME"] ?> <small>(<?= $routine["SUBJECT_CODE"] ?>)</small></strong><br>
                                            <?= $routine["TEACHER_NAME"] ?> <small>(<?= $routine["TEACHER_CODE"] ?>)</small>
                                            <?php break; ?>
                                        <?php } ?>
                                    <?php } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Day of Week</th>
                                <th>Period 1</th>
                                <th>Period 2</th>
                                <th>Period 3</th>
                                <th>Period 4</th>
                                <th>Period 5</th>
                                <th>Period 6</th>
                                <th>Period 7</th>
                                <th>Period 8</th>
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
