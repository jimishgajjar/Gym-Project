<?php
include('checkSession.php');
include('header.php');
?>

<body style="background: #fff;">
    <div class="container">
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-md-12 text-center">
                <h3>User Progress Report</h3>
            </div>
            <div class="col-md-12 mt-5">
                <?php if (isset($_GET['view'])) { ?>
                    <?php
                    $Condition['id'] = $_GET['view'];
                    $response = getData('user', $Condition);
                    $response = $response->fetch_assoc();
                    if (!empty($response)) {
                    ?>
                        <style>
                            .userInfo {
                                width: 100%;
                                border-collapse: collapse;
                                font-size: 18px;
                            }

                            .userInfo,
                            .userInfo td,
                            .userInfo th,
                            .userInfo tr {
                                padding: 5px;
                            }

                            .userInfo tr td {
                                width: 25%;
                            }
                        </style>
                        <table class="userInfo">
                            <tr>
                                <td><b>Full Name :</b></td>
                                <td><?php echo $response['full_name'] ?></td>
                                <td><b>Email :</b></td>
                                <td><?php echo $response['email'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Mobile No :</b></td>
                                <td><?php echo $response['mobile_no'] ?></td>
                                <td><b>Gender :</b></td>
                                <td><?php echo $response['gender'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Height :</b></td>
                                <td><?php echo $response['height'] ?></td>
                                <td><b>Weight :</b></td>
                                <td><?php echo $response['weight'] ?></td>
                            </tr>
                        </table>
                        <style>
                            .printTable {
                                width: 100%;
                                border-collapse: collapse;
                                font-size: 16px;
                            }

                            .printTable,
                            .printTable td,
                            .printTable th,
                            .printTable tr {
                                padding: 5px;
                                border: 1px solid;
                            }
                        </style>
                        <h5 class="mt-5">User Progress</h5>
                        <table id="" class="printTable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 3%;">#</th>
                                    <th>Date</th>
                                    <th>Weight</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $rowCount = 0;

                                $userReportQuery = "SELECT * FROM user_report WHERE user_id = '" . $_GET['view'] . "' ORDER BY date_entered ASC;";
                                $userReport = $conn->query($userReportQuery);

                                if ($userReport->num_rows > 0) {
                                    while ($row = $userReport->fetch_assoc()) {
                                        $rowCount++;
                                ?>
                                        <tr>
                                            <td class="text-center"><?php echo $rowCount ?></td>
                                            <td>
                                                <?php
                                                $s = $row['date_entered'];
                                                $dt = new DateTime($s);

                                                echo $dt->format('d/m/Y');
                                                ?>
                                            </td>
                                            <td><?php echo $row['weight']; ?></td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="6" align="center">No data avalible.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                Data not found !
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
    <?php include('footer.php'); ?>
    <script>
        window.print();
    </script>
</body>

</html>