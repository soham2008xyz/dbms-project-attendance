<?php global $SITE_ROOT, $student, $updated, $error; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Student
            <small>Please fill in the details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#">Students</a></li>
            <li class="active">Edit Student</li>
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
                        <h3 class="box-title">Student Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="<?= $_SERVER["PHP_SELF"] ?>?id=<?= $_GET["id"] ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="student-name">Student Name</label>
                                <input type="text" maxlength="50" class="form-control" id="student-name" name="student-name" required placeholder="Enter Student Name" value="<?= $student["STUDENT_NAME"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="student-email">Email address</label>
                                <input type="email" maxlength="50" class="form-control" id="student-email" name="student-email" placeholder="Enter email address" value="<?= $student["STUDENT_EMAIL"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="student-phone">Phone number</label>
                                <input type="text" maxlength="20" class="form-control" id="student-phone" name="student-phone" placeholder="Enter phone number" value="<?= $student["STUDENT_PHONE"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="section-id">Section</label>
                                <select class="form-control" id="section-id" name="section-id">
                                  <?php $sections = $conn->query("SELECT * FROM SECTIONS INNER JOIN BATCHES ON BATCHES.batch_id = SECTIONS.batch_id "); ?>
                                  <?php foreach ( $sections as $section ) { ?>
                                  <option value="<?= $section["SECTION_ID"] ?>" <?= $section["SECTION_ID"] == $student["SECTION_ID"] ? "selected" : "" ?>>
                                      Section <?= $section["SECTION_NAME"] ?> - Batch of <?= $section["BATCH_YEAR_PASSOUT"] ?>, <?= $section["BATCH_STREAM"] ?>
                                  </option>
                                  <?php } ?>
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="semester">Semester</label>
                            <select class="form-control" id="semester" name="semester">
                              <option value="1" <?= '1' == $student["STUDENT_SEMESTER"] ? "selected" : "" ?>>1st</option>
                              <option value="2" <?= '2' == $student["STUDENT_SEMESTER"] ? "selected" : "" ?>>2nd</option>
                              <option value="3" <?= '3' == $student["STUDENT_SEMESTER"] ? "selected" : "" ?>>3rd</option>
                              <option value="4" <?= '4' == $student["STUDENT_SEMESTER"] ? "selected" : "" ?>>4th</option>
                              <option value="5" <?= '5' == $student["STUDENT_SEMESTER"] ? "selected" : "" ?>>5th</option>
                              <option value="6" <?= '6' == $student["STUDENT_SEMESTER"] ? "selected" : "" ?>>6th</option>
                              <option value="7" <?= '7' == $student["STUDENT_SEMESTER"] ? "selected" : "" ?>>7th</option>
                              <option value="8" <?= '8' == $student["STUDENT_SEMESTER"] ? "selected" : "" ?>>8th</option>
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
