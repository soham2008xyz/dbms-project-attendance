<?php global $conn, $updated, $error; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add New Section
      <small>Please fill in the details</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Sections</a></li>
      <li class="active">Add Section</li>
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
            <h3 class="box-title">Section Details</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="<?= $_SERVER["PHP_SELF"] ?>">
            <div class="box-body">
              <div class="form-group">
                <label for="section-name">Section Name</label>
                <input type="text" maxlength="3" class="form-control" id="section-name" name="section-name" required placeholder="Enter Section Name">
              </div>
              <div class="form-group">
                <label for="batch-id">Batch</label>
                <select class="form-control" id="batch-id" name="batch-id">
                  <?php $batches = $conn->query("SELECT * FROM BATCHES"); ?>
                  <?php foreach ( $batches as $batch ) { ?>
                  <option value="<?= $batch["BATCH_ID"] ?>">
                          Batch of <?= $batch["BATCH_YEAR_PASSOUT"] ?>, <?= $batch["BATCH_STREAM"] ?>
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
