<?php global $SITE_ROOT, $sections, $error, $deleted; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View All Sections
      <!--<small>Please fill in the details</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Sections</a></li>
      <li class="active">View All Sections</li>
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
            <h3 class="box-title">Sections List</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="sections-table" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>Actions</th>
                  <th>Batch</th>
                  <th>Section Name</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach( $sections as $section ) { ?>
                <tr>
                  <td class="text-center">
                    <a class="btn btn-primary btn-flat" href="section-edit.php?id=<?= $section["SECTION_ID"] ?>" data-title="Edit">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-flat" href="section-list.php?delete=<?= $section["SECTION_ID"] ?>" data-title="Delete">
                      <i class="fa fa-trash"></i>
                    </a>
                  </td>
                  <td>Batch of <?= $section["BATCH_YEAR_PASSOUT"] ?>, <?= $section["BATCH_STREAM"] ?></td>
                  <td><?= $section["SECTION_NAME"] ?></td>
                </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Actions</th>
                  <th>Batch</th>
                  <th>Section Name</th>
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
