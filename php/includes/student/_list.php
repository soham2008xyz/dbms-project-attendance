<?php global $SITE_ROOT, $sections, $error, $deleted; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View All Students
      <!--<small>Please fill in the details</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Students</a></li>
      <li class="active">View All Students</li>
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
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Students List</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="students-table" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>Actions</th>
                  <th>Student Name</th>
                  <th>Student Email</th>
                  <th>Student Phone</th>
                  <th>Section Name</th>
                  <th>Batch</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach( $students as $student ) { ?>
                <tr>
                  <td class="text-center">
                    <a class="btn btn-primary btn-flat" href="student-edit.php?id=<?= $student["STUDENT_ID"] ?>" data-title="Edit">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-flat" href="student-list.php?delete=<?= $student["STUDENT_ID"] ?>" data-title="Delete">
                      <i class="fa fa-trash"></i>
                    </a>
                  </td>
                  <td><?= $student["STUDENT_NAME"] ?></td>
                  <td><?= $student["STUDENT_EMAIL"] ?></td>
                  <td><?= $student["STUDENT_PHONE"] ?></td>
                  <td><?= $student["SECTION_NAME"] ?></td>
                  <td>Batch of <?= $student["BATCH_YEAR_PASSOUT"] ?>, <?= $student["BATCH_STREAM"] ?></td>
                </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Actions</th>
                  <th>Student Name</th>
                  <th>Student Email</th>
                  <th>Student Phone</th>
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
