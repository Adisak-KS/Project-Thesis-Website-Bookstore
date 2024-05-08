<?php
require_once __DIR__ . '/../../../connection.php';
// ตรวจสอบสิทธิ์
// if (!(isset($_SESSION['sale']) || isset($_SESSION['admin']))) {
//     $_SESSION['status'] = "ไม่พบสิทธิ์การใช้งานในหน้านี้";
//     $_SESSION['status_code'] = "ผิดพลาด";
//     header('Location: login_form.php');
//     exit();
// }

if (isset($_SESSION['status']) && isset($_SESSION['status_code'])) {
    $status = $_SESSION['status'];
    $status_code = $_SESSION['status_code'];

    // เคลียร์ค่า session
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);

    // แสดงหน้าต่างข้อความแจ้งเตือน
    echo "<script>alert('$status');</script>";
    echo "<script>window.location.href = 'order_ntf_show.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once('head.php');
    ?>
</head>

<!-- body start -->

<body class="loading" data-layout-color="light" data-layout-mode="default" data-layout-size="fluid" data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='true'>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php
        require_once('nav.php');
        ?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php
        require_once('slidebar.php');
        ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row"></div>

                    <div class="col-12">
                        <!-- แสดงข้อมูล -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">รายการการชำระเงิน</h4>
                                <br>
                                <?php
                                $sql_ord_script = "SELECT * FROM bk_ord_orders WHERE ord_status IN ('เตรียมจัดส่งสินค้า', 'อยู่ระหว่างการขนส่ง', 'จัดส่งสำเร็จ') ORDER BY ord_date DESC";
                                $ord_result = mysqli_query($proj_connect, $sql_ord_script) or die(mysqli_connect_error());

                                $sql_fnd_script = "SELECT * FROM bk_fnd_finder WHERE fnd_status IN ('เตรียมจัดส่งสินค้า', 'อยู่ระหว่างการขนส่ง', 'จัดส่งสำเร็จ') ORDER BY fnd_date DESC";
                                $fnd_result = mysqli_query($proj_connect, $sql_fnd_script) or die(mysqli_connect_error());

                                ?>

                                <?php if ((mysqli_num_rows($ord_result) > 0) || (mysqli_num_rows($fnd_result) > 0)) { ?>
                                    <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>เวลา</th>
                                                <th>จำนวนเงิน</th>
                                                <th>ผู้ใช้</th>
                                                <th>สถานะ</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($ord_row_result = mysqli_fetch_assoc($ord_result)) { ?>
                                                <tr>
                                                    <td><?= $ord_row_result['ord_date'] ?></td>
                                                    <td><?= $ord_row_result['ord_amount'] ?></td>
                                                    <td>
                                                        <?php
                                                        $mmb_script = "SELECT mmb_username FROM bk_auth_member WHERE mmb_id = " . $ord_row_result['mmb_id'];
                                                        $mmb_result = mysqli_query($proj_connect, $mmb_script) or die(mysqli_connect_error());
                                                        $mmb_row_result = mysqli_fetch_assoc($mmb_result);
                                                        if ($mmb_row_result > 0) {
                                                            echo $mmb_row_result['mmb_username'];
                                                        } else {
                                                            echo 'ไม่พบบัญชีผู้ใช้';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($ord_row_result['ord_status'] == 'เตรียมจัดส่งสินค้า') {
                                                        ?>
                                                            <span class="badge rounded-pill bg-warning" style="font-size: 14px; color:black;"><?= $ord_row_result['ord_status'] ?></span>
                                                        <?php
                                                        } elseif ($ord_row_result['ord_status'] == 'อยู่ระหว่างการขนส่ง') {
                                                        ?>
                                                            <span class="badge rounded-pill bg-secondary" style="font-size: 14px; color:;"><?= $ord_row_result['ord_status'] ?></span>
                                                        <?php
                                                        }elseif($ord_row_result['ord_status'] == 'จัดส่งสำเร็จ'){
                                                        ?>
                                                        <span class="badge rounded-pill bg-success" style="font-size: 14px; color:;"><?= $ord_row_result['ord_status'] ?></span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <form action="notification_show_form.php" method="POST">
                                                            <input type="text" name="edit_id" id="edit_id" value="<?= $ord_row_result['ord_id'] ?>" hidden>
                                                            <button type="submit" name="edit_btn" class="btn btn-info btn-sm waves-effect waves-light"><i class="fe-eye"></i> รายละเอียด</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php }
                                            while ($fnd_row_result = mysqli_fetch_assoc($fnd_result)) { ?>
                                                <tr>
                                                    <td><?= $fnd_row_result['fnd_date'] ?></td>
                                                    <td><?= $fnd_row_result['fnd_totalprice'] ?></td>
                                                    <td>
                                                        <?php
                                                        $mmb_script = "SELECT mmb_username FROM bk_auth_member WHERE mmb_id = " . $fnd_row_result['mmb_id'];
                                                        $mmb_result = mysqli_query($proj_connect, $mmb_script) or die(mysqli_connect_error());
                                                        $mmb_row_result = mysqli_fetch_assoc($mmb_result);
                                                        if ($mmb_row_result > 0) {
                                                            echo $mmb_row_result['mmb_username'];
                                                        } else {
                                                            echo 'ไม่พบบัญชีผู้ใช้';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($fnd_row_result['fnd_status'] == 'เตรียมจัดส่งสินค้า') {
                                                        ?>
                                                            <span class="badge rounded-pill bg-warning" style="font-size: 14px; color:black;"><?= $fnd_row_result['fnd_status'] ?></span>
                                                        <?php
                                                        } elseif ($fnd_row_result['fnd_status'] == 'อยู่ระหว่างการขนส่ง') {
                                                        ?>
                                                            <span class="badge rounded-pill bg-secondary" style="font-size: 14px; color:;"><?= $fnd_row_result['fnd_status'] ?></span>
                                                        <?php
                                                        }elseif($fnd_row_result['fnd_status'] == 'จัดส่งสำเร็จ'){
                                                        ?>
                                                        <span class="badge rounded-pill bg-success" style="font-size: 14px; color:;"><?= $fnd_row_result['fnd_status'] ?></span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <form action="finder_notification_show_form.php" method="POST">
                                                            <input type="text" name="edit_id" id="edit_id" value="<?= $fnd_row_result['fnd_id'] ?>" hidden>
                                                            <button type="submit" name="edit_btn" class="btn btn-info btn-sm waves-effect waves-light"><i class="fe-eye"></i> รายละเอียด</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <p>ยังไม่มีรายการ</p>
                                <?php } ?>
                                <div class="text-end">
                                    <br>
                                    <button type="button" class="btn btn-secondary waves-effect btn-sm" onclick="window.location.href='index.php'">ย้อนกลับ</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Start -->
                    <?php
                    require_once('footer.php');
                    ?>
                    <!-- end Footer -->

                </div>

                <!-- ============================================================== -->
                <!-- End Page content -->
                <!-- ============================================================== -->


            </div>
            <!-- END wrapper -->

            <!-- Right Sidebar -->
            <?php
            require_once('right_ridebar.php');
            ?>

</body>

</html>