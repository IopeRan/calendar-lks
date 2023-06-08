<?php

$bulan = $_GET['bulan'] ?? date("F");
$tahun = $_GET['tahun'] ?? date("Y");

// Daftar bulan
$daftarBulan = array(
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
);

// Mencari indeks bulan dalam daftar bulan
$bulanIndex = array_search($bulan, $daftarBulan);

// Menghitung indeks bulan sebelumnya
$bulanSebelumnyaIndex = ($bulanIndex - 1) < 0 ? count($daftarBulan) - 1 : ($bulanIndex - 1);
$bulanSelanjutnyaIndex = ($bulanIndex + 1) >= count($daftarBulan) ? 0 : ($bulanIndex + 1);


// Bulan sebelumnya dan selanjutnya
$bulanSebelumnya = $daftarBulan[$bulanSebelumnyaIndex];
$bulanSelanjutnya = $daftarBulan[$bulanSelanjutnyaIndex];

// Bulan sebelumnya
$bulanSebelumnya = $daftarBulan[$bulanSebelumnyaIndex];

// Mendapatkan tahun berdasarkan perubahan bulan
if ($bulanIndex == 0) {
    $tahunSebelumnya = $tahun - 1;
    $tahunSelanjutnya = $tahun;
} else if ($bulanIndex == count($daftarBulan) - 1) {
    $tahunSebelumnya = $tahun;
    $tahunSelanjutnya = $tahun + 1;
} else {
    $tahunSebelumnya = $tahun;
    $tahunSelanjutnya = $tahun;
}

// Mengubah bulan menjadi format angka, misalnya January menjadi 1
$bulanAngka = date("m", strtotime($bulan));

// Menghitung jumlah hari dalam bulan dan tahun yang ditampilkan
$jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulanAngka, $tahun);

// Membuat array tanggal-tanggal dalam bulan dan tahun yang ditampilkan
$tanggal = array();
for ($i = 1; $i <= $jumlahHari; $i++) {
    $tanggal[] = $i;
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="calendar.css">
</head>

<body>


    <div class="custom-calendar-wrap">
        <div class="custom-inner">
            <div class="custom-header clearfix">
                <nav>
                    <a href="?bulan=<?= urlencode($bulanSebelumnya); ?>&tahun=<?= $tahunSebelumnya; ?>" class="custom-btn custom-prev"></a>
                    <a id="next" href="?bulan=<?= urlencode($bulanSelanjutnya); ?>&tahun=<?= $tahunSelanjutnya; ?>" class="custom-btn custom-next"></a>
                </nav>
                <h2 id="custom-month" class="custom-month"><?= $bulan; ?></h2>
                <h3 id="custom-year" class="custom-year"><?= $tahun; ?></h3>
            </div>
            <div id="calendar" class="fc-calendar-container">
            <div id="calendar" class="fc-calendar-container">
            <div id="calendar" class="fc-calendar-container">
    <div class="fc-calendar fc-five-rows">
        <div class="fc-head">
            <?php
            $hari = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
            foreach ($hari as $h) {
                echo "<div>$h</div>";
            }
            ?>
        </div>
        <div class="fc-body">
            <?php
            $indexHari = array_search(date("D", strtotime("$tahun-$bulanAngka-01")), $hari);
            $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulanAngka, $tahun);
            $indexTanggal = 1;
            
            echo '<div class="fc-row">';
            
            for ($i = 0; $i < 7; $i++) {
                if ($i < $indexHari) {
                    echo '<div></div>';
                } else {
                    // echo '<div>' . $hari[$i] . '</div>';
                    echo '<div><span class="fc-date">' . $indexTanggal . '</span></div>';
                    $indexTanggal++;
                }
            }
            
            echo '</div>';
            
            while ($indexTanggal <= $jumlahHari) {
                echo '<div class="fc-row">';
                
                for ($i = 0; $i < 7; $i++) {
                    if ($indexTanggal <= $jumlahHari) {
                        // echo '<div>' . $hari[$i] . '</div>';
                        echo '<div><span class="fc-date">' . $indexTanggal . '</span></div>';
                        $indexTanggal++;
                    } else {
                        echo '<div></div>';
                    }
                }
                
                echo '</div>';
            }

            ?>
        </div>
    </div>
</div>


        </div>

</body>

</html>