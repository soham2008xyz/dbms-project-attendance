<?php global $updated, $error; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add a New Batch
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Batches</a></li>
      <li class="active">Add Batch</li>
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
            <h3 class="box-title">Batch Details</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="<?= $_SERVER["PHP_SELF"] ?>">
            <div class="box-body">
              <div class="form-group">
                <label for="year-passout">Year Passout</label>
                <input type="text" class="form-control" id="year-passout" name="year-passout" required placeholder="Enter Year Passout">
              </div>
              <div class="form-group">
              <label>Stream</label>
                <select class="form-control" id="batch-stream" name="batch-stream">
                  <option>CSE</option>
                  <option>IT</option>
                  <option>ECE</option>
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
