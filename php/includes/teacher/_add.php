<?php global $updated, $error; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Teacher
      <small>Please fill in the details</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Teachers</a></li>
      <li class="active">Add Teacher</li>
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
        <div class="box box-primary box-solid">
          <div class="box-header">
            <h3 class="box-title">Teacher Details</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="<?= $_SERVER["PHP_SELF"] ?>">
            <div class="box-body">
              <div class="form-group">
                <label for="teacher-name">Name</label>
                <input type="text" maxlength="50" class="form-control" id="teacher-name" name="teacher-name" required placeholder="Enter name">
              </div>
              <div class="form-group">
                <label for="teacher-code">Teacher code</label>
                <input type="text" maxlength="3" class="form-control" id="teacher-code" name="teacher-code" required placeholder="Enter teacher code">
              </div>
              <div class="form-group">
                <label for="teacher-email">Email address</label>
                <input type="email" maxlength="50" class="form-control" id="teacher-email" name="teacher-email" placeholder="Enter email address">
              </div>
              <div class="form-group">
                <label for="teacher-phone">Phone number</label>
                <input type="text" maxlength="20" class="form-control" id="teacher-phone" name="teacher-phone" placeholder="Enter phone number">
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
