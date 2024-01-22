<?php 
  include 'connection.php'; 
  
  $occupancy2 = mysqli_query($connection, "SELECT occupancy from datatraining");
  foreach ($occupancy2 as $row) {
  // $status = $row['occupancy'] == 0 ? "Not Occupied" : "Occupied";
  // echo $status;
  }

?>
 
<table class="table table-striped table-bordered">
    
    <thead>
         <tr>
            <th>No.</th>
            <th>Date Time</th>
            <th>Temperature (<sup>o</sup>C)</th>
            <th>Humidity (%)</th>
            <th>Light (lx)</th>
            <th>CO<sub>2</sub> (ppm)</th>
            <th>Occupancy</th>
        </tr>  
    </thead>

    <tbody>
        <?php
            $page = (isset($_POST['page']))? $_POST['page'] : 1;
            $limit = 25; 
            $limit_start = ($page - 1) * $limit;
            $no = $limit_start + 1;
 
            $query = "SELECT * FROM datatraining LIMIT $limit_start, $limit";
            $data1 = $connection->prepare($query);
            $data1->execute();
            $res1 = $data1->get_result();
            while ($row = $res1->fetch_assoc()) {
        ?>
        <tr>
            <td><?= $row['no.']; ?></td>
            <td><?= $row['date_time']; ?></td>
            <td><?= $row['temperature']; ?></td>
            <td><?= $row['humidity']; ?></td>
            <td><?= $row['light']; ?></td>
            <td><?= $row['co2']; ?></td>
            <td>
                <?= 
                    $status = $row['occupancy'] == 0 ? "Not Occupied" : "Occupied";
                    $status; 
                ?>
            </td> 
        </tr>
        <?php } ?>
    </tbody>

    <tfoot>
        <tr>
            <td colspan="7" class="bg-white">
                <table class="total-pagination">
                    <tr>
                        <td>
                            <?php
                                $query_jumlah = "SELECT count(*) AS jumlah FROM datatraining";
                                $data1 = $connection->prepare($query_jumlah);
                                $data1->execute();
                                $res1 = $data1->get_result();
                                $row = $res1->fetch_assoc();
                                $total_records = $row['jumlah'];
                            ?>
                            <h5>Total Records : <?php echo $total_records; ?></h5>
                        </td>
                        <td>
                            <nav class="">
                                <ul class="pagination justify-content-end">
                                    <?php
                                        $jumlah_page = ceil($total_records / $limit);
                                        $jumlah_number = 1;
                                        $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
                                        $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;
                        
                                        if ($page == 1) {
                                            echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                                            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                                        } else {
                                            $link_prev = ($page > 1) ? $page - 1 : 1;
                                            echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
                                            echo '<li class="page-item halaman" id="'.$link_prev.'"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                                        }
                        
                                        for ($i = $start_number; $i <= $end_number; $i++) {
                                            $link_active = ($page == $i) ? ' active' : '';
                                            echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
                                        }
                        
                                        if ($page == $jumlah_page) {
                                            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                                            echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
                                        } else {
                                            $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
                                            echo '<li class="page-item halaman" id="'.$link_next.'"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                                            echo '<li class="page-item halaman" id="'.$jumlah_page.'"><a class="page-link" href="#">Last</a></li>';
                                        }
                                    ?>
                                </ul>
                            </nav>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </tfoot>

</table>
 