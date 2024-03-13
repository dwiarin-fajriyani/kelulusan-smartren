<?php
// include "../database.php";
// $qsiswa = mysqli_query($db_conn, "SELECT * FROM un_siswa");



//array Field NIlai rata2 rapot
$nama_field = array(
    '0' => "n_pai",
    '1' => "n_pkn",
    '2' => "n_bin",
    '3' => "n_mat",
    '4' => "n_ipa",
    '5' => "n_ips",
    '6' => "n_big",
    '7' => "n_sb",
    '8' => "n_pjok",
    '9' => "n_pkr",
    '10' => "n_bde",
    '11' => "n_mulok2"
);

?>



<script type="text/javascript" src="chartjs/Chart.js"></script>
<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["PAI", "PPKn", "B.Ind", "MTK", "IPA", "IPS", "B.Ing", "SenBud", "PJOK", "Praky", "Mulok1", "Mulok2"],
            datasets: [{
                label: 'Rata-rata Nilai Akhir',
                // data: [12, 19.5, 3, 23, 2, 3, 12, 19, 3, 23, 2, 3],
                data: [
                    <?php
                    for ($i = 0; $i < count($nama_field); $i++) {
                        $inifield = "{$nama_field[$i]}";

                        //menghitung Rata-rata nilai
                        $qsiswa = mysqli_query($db_conn, "SELECT AVG($inifield ) AS average FROM un_siswa");
                        $kolom = mysqli_fetch_assoc($qsiswa);
                        $average = round($kolom['average']);
                        echo $average;
                        if ($i < 11) {
                            echo " ,";
                        }
                        // echo " => rata-rata : " . $inifield . "<br>";
                    }

                    ?>

                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 50, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(14, 255, 80 , 0.2)',
                    'rgba(218, 255, 80, 0.4)',
                    'rgba(218, 40, 0, 0.2)',
                    'rgba(164,135,50,0.2)',
                    'rgba(164,0,161,0.2)',
                    'rgba(101, 179, 121, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 50, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(14, 255, 80, 1)',
                    'rgba(218, 255, 80, 2)',
                    'rgba(218, 40, 0, 0.50)',
                    'rgba(164,135,50,0.50)',
                    'rgba(164,0,161,0.50)',
                    'rgba(101, 179 , 121, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
