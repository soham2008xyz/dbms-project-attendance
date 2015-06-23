<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Save Attendance Records
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= $SITE_ROOT ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#">Attendance Records</a></li>
            <li class="active">Save Attendance Records</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Student Attendance</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <p>Date: <strong><?= $_POST["date"] ?></strong></p>
                        <table class="table table-bordered table-striped table-hover" id="attendance-table">
                            <thead>
                            <tr>
                                <th>Roll Number</th>
                                <th>Attendance Record</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            //var_dump($_POST);
                            //die();
                            $keys = array_keys($_POST);
                            //print_r($keys);
                            //print_r($_POST);
                            $i = 0;
                            foreach($_POST as $key => $value) {
                                if( $key != "date" && $key != "schedule-id" ) {
                                    echo "<tr>\n";
                                    $sql = "CALL ADD_ATTENDANCE_RECORD ( :student, :schedule, :attendance, TO_DATE(:adate, 'yyyy-mm-dd') )";
                                    $stmt = $conn->prepare($sql);
                                    //echo $key."<br>";
                                    //echo array_keys($key, $_POST)."<br>";
                                    echo "<td>".$keys[$i]."</td>\n";
                                    echo "<td>".$value."</td>\n";
                                    $stmt->bindValue(":student", $keys[$i], PDO::PARAM_STR);
                                    $stmt->bindValue(":schedule", $_POST["schedule-id"], PDO::PARAM_STR);
                                    $stmt->bindValue(":attendance", $value == "Present" ? 1 : 0, PDO::PARAM_STR);
                                    $stmt->bindValue(":adate", $_POST["date"], PDO::PARAM_STR);
                                    $stmt->execute();
                                    //print_r($stmt);
                                    echo "</tr>\n";
                                }
                                $i++;
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Roll Number</th>
                                <th>Attendance Record</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="box-footer">
                        <a href="attendance-add.php" class="btn btn-primary btn-flat">Done</a>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>