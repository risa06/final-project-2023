<?php
  include "connection.php";

  // 3-SIGMA
  $mean = mysqli_query($connection, "SELECT AVG(temperature) AS average FROM datatraining");
  $row_mean = mysqli_fetch_assoc($mean);
  $average = $row_mean["average"];

  $std = mysqli_query($connection, "SELECT STDDEV(temperature) AS deviation FROM datatraining");
  $row_std = mysqli_fetch_assoc($std);
  $deviation = $row_std["deviation"];

  $z = 3;
  $upper_limit = $average + ($z * $deviation);
  $lower_limit = $average - ($z * $deviation);

  // OUTLIER
  $temperature_2 = mysqli_query($connection, "SELECT temperature FROM datatraining WHERE temperature<$lower_limit OR temperature>$upper_limit");
  $total_outlier_temperature = mysqli_num_rows($temperature_2);

  // Menampung sementara data temperature ke dalam array $value[]
  $temperature_3 = mysqli_query($connection,"SELECT temperature FROM datatraining");
  while ($result = mysqli_fetch_array($temperature_3)) {
      $value[] = $result['temperature'];
  }
  // echo max($value);
  // echo min($value);

?>

<table border="1">
    <tr>
        <th>Total records</th>
            <td>:</td>
            <td><?php echo $total_records_temperature; ?></td>
    </tr>
    <tr>
        <th>Mean</th>
            <td>:</td>
            <td><?php echo $average; ?></td>
    </tr>
    <tr>
        <th>Standard deviation</th>
            <td>:</td>
            <td><?php echo $deviation; ?></td>
    </tr>
    <tr>
        <th>Minimum</th>
            <td>:</td>
            <td><?php echo min($value); ?></td>
    </tr>
    <tr>
        <th>Maximum</th>
            <td>:</td>
            <td><?php echo max($value); ?></td>
    </tr>
    <tr>
        <th>Lower limit</th>
            <td>:</td>
            <td><?php echo $lower_limit; ?></td>
    </tr>
    <tr>
        <th>Upper limit</th>
            <td>:</td>
            <td><?php echo $upper_limit; ?></td>
    </tr>
    <tr>
        <th>Outlier</th>
            <td>:</td>
            <td>
                <?php 
                    echo "Total outlier : " . $total_outlier_temperature;
                ?>
            </td>
    </tr>
    <tr>
        <th></th>
            <td></td>
            <td>
                <table border="1" class="data-outlier">
                    <?php 
                        // OUTLIER PAGINATION
                        $page = (isset($_POST['page']))? $_POST['page'] : 1;
                        $limit = 15; 
                        $limit_start = ($page - 1) * $limit;
                        $no = $limit_start + 1;
                        // OUTLIER 
                        $query = "SELECT temperature FROM datatraining WHERE temperature<$lower_limit OR temperature>$upper_limit LIMIT $limit_start, $limit";
                        $data1 = $connection->prepare($query);
                        $data1->execute();
                        $result = $data1->get_result();
                        while ($row = $result->fetch_assoc()) {
                            echo "<td>" . $row['temperature'] . "</td>"; 
                        }
                    ?>
                </table>
            </td>
    </tr>
    <tr>
        <th></th>
            <td></td>
            <td>
                <nav class="mt-1">
                    <ul class="m-0 pagination font-pagination">
                        <?php
                            // OUTLIER PAGINATION
                            $jumlah_page = ceil($total_outlier_temperature / $limit);
                            $jumlah_number = 1;
                            $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
                            $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;

                            if ($total_outlier_temperature > $limit) {

                                if ($page == 1) {
                                    echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                                    echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                                } else {
                                    $link_prev = ($page > 1) ? $page - 1 : 1;
                                    echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
                                    echo '<li class="page-item halaman" id="'.$link_prev.'"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                                }
                        
                                for ($i = $start_number; $i <= $end_number; $i++) {
                                    $link_active = ($page == $i)? ' active' : '';
                                    echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
                                }
                        
                                if ($page == $jumlah_page) {
                                    echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                                    echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
                                } else {
                                    $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
                                    echo '<li class="page-item halaman" id="'.$link_next.'"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                                    echo '<li class="page-item halaman" id="'.$jumlah_page.'"><a class="page-link" href="#">Last</a></li>';
                                }

                            }
                        ?>
                    </ul>
                </nav>   
            </td>
    </tr>
</table>