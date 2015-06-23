<?php global $SITE_ROOT, $batch, $updated, $error; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Batch
      <small>Please fill in the details</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Batches</a></li>
      <li class="active">Edit Batch</li>
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
            <h3 class="box-title">Batch Details</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="<?= $_SERVER["PHP_SELF"] ?>?id=<?= $_GET["id"] ?>">
            <div class="box-body">
                    <div class="form-group">
                      <label for="year-passout">Passout Year</label>
                      <input type="text" min="1988" max="2020" maxlength="4" class="form-control" id="batch-year-passout" name="batch-year-passout" required placeholder="Enter Passout Year" value="<?= $batch["BATCH_YEAR_PASSOUT"] ?>">
                    </div>
                    <div class="form-group">
                      <label for="batch-stream">Stream</label>
                      <select class="form-control" id="batch-stream" name="batch-stream" value="<?= $batch["BATCH_STREAM"] ?>">
                        <option <?= $batch["BATCH_STREAM"] == "CSE" ? "selected" : "" ?>>CSE</option>
                        <option <?= $batch["BATCH_STREAM"] == "IT" ? "selected" : "" ?>>IT</option>
                        <option <?= $batch["BATCH_STREAM"] == "ECE" ? "selected" : "" ?>>ECE</option>
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
