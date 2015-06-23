<?global $students, $error; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            View Attendance Records
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#">Attendance Records</a></li>
            <li class="active">View Attendance Records</li>
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
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Student Attendance</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <p>Date: <strong><?= $_GET["date"] ?></strong></p>
                        <table class="table table-bordered table-striped table-hover" id="attendance-table">
                            <thead>
                            <tr>
                                <th>Roll Number</th>
                                <th>Student Name</th>
                                <th>Attendance Record</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ( $students as $student ) { ?>
                                <tr>
                                    <td><?= $student["STUDENT_ID"] ?></td>
                                    <td><?= $student["STUDENT_NAME"] ?></td>
                                    <td><?= $student["ATTENDANCE_RECORD_VALUE"] == 1 ? "Present" : "Absent" ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Roll Number</th>
                                <th>Student Name</th>
                                <th>Attendance Record</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="box-footer">
                        <a href="attendance-list.php" class="btn btn-primary btn-flat">Done</a>
                    </div>
                </div><!-- /.box -->
                <?php } ?>
            </div>
        </div>
    </section>
</div>