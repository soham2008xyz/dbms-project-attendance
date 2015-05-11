<?php global $SITE_ROOT, $teachers, $error; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View All Teachers
      <!--<small>Please fill in the details</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Teachers</a></li>
      <li class="active">View All Teachers</li>
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
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Teachers List</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="teachers-table" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>Teacher ID</th>
                  <th>Teacher Code</th>
                  <th>Teacher Name</th>
                  <th>Teacher Email</th>
                  <th>Teacher Phone</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach( $teachers as $teacher ) { ?>
                <tr>
                  <td><?= $teacher["TEACHER_ID"] ?></td>
                  <td><?= $teacher["TEACHER_CODE"] ?></td>
                  <td><?= $teacher["TEACHER_NAME"] ?></td>
                  <td><?= $teacher["TEACHER_EMAIL"] ?></td>
                  <td><?= $teacher["TEACHER_PHONE"] ?></td>
                </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Teacher ID</th>
                  <th>Teacher Code</th>
                  <th>Teacher Name</th>
                  <th>Teacher Email</th>
                  <th>Teacher Phone</th>
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
