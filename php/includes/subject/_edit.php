<?php global $SITE_ROOT, $subject, $updated, $error; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Subject
      <small>Please fill in the details</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Subjects</a></li>
      <li class="active">Edit Subject</li>
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
            <h3 class="box-title">Subject Details</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="<?= $_SERVER["PHP_SELF"] ?>?id=<?= $_GET["id"] ?>">
            <div class="box-body">
                    <div class="form-group">
                      <label for="subject-name">Subject name</label>
                      <input type="text" maxlength="50" class="form-control" id="subject-name" name="subject-name" required placeholder="Enter subject name" value="<?= $subject["SUBJECT_NAME"] ?>">
                    </div>
                    <div class="form-group">
                      <label for="subject-code">Subject code</label>
                      <input type="text" maxlength="6" class="form-control" id="subject-code" name="subject-code" required placeholder="Enter subject code" value="<?= $subject["SUBJECT_CODE"] ?>">
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
