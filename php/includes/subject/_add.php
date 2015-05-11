<?php global $updated, $error; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add a New Subject
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Subjects</a></li>
      <li class="active">Add Subject</li>
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
            <h3 class="box-title">Subject Details</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="<?= $_SERVER["PHP_SELF"] ?>">
            <div class="box-body">
              <div class="form-group">
                <label for="subject-name">Subject name</label>
                <input type="text" maxlength="50" class="form-control" id="subject-name" name="subject-name" required placeholder="Enter subject name">
              </div>
              <div class="form-group">
                <label for="subject-code">Subject code</label>
                <input type="text" maxlength="6" class="form-control" id="subject-code" name="subject-code" required placeholder="Enter subject code">
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
