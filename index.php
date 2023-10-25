<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }

        h2 {
        text-align: center;
    }

    table {
        margin: 0 auto;
    }
        form {
            background-color: #fff;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            font-weight: bold;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <h1>Penentuan Hari dalam Sebulan</h1>
    <form method="post" action="">
        <label>Masukkan angka bulan (1-12): </label>
        <input type="number" name="bulan" min="1" max="12">
        <label>Masukkan tahun: </label>
        <input type="number" name="tahun" min="0">
        <input type="submit" value="Hitung">
    </form>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bulan = $_POST["bulan"];
    $tahun = $_POST["tahun"];

    // Menganalisis jumlah hari dalam bulan
    if (($bulan >= 1 && $bulan <= 12) && ($tahun > 0)) {
        if ($bulan == 2) {
            if (($tahun % 4 == 0 && $tahun % 100 != 0) || ($tahun % 400 == 0)) {
                $jumlah_hari = 29;
            } else {
                $jumlah_hari = 28;
            }
        } elseif (in_array($bulan, [4, 6, 9, 11])) {
            $jumlah_hari = 30;
        } else {
            $jumlah_hari = 31;
        }
        echo "<p>Jumlah hari dalam bulan $bulan tahun $tahun adalah $jumlah_hari hari.</p>";

        // Menampilkan kalender
        echo "<h2>Kalender untuk Bulan $bulan Tahun $tahun</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Minggu</th><th>Senin</th><th>Selasa</th><th>Rabu</th><th>Kamis</th><th>Jumat</th><th>Sabtu</th></tr>";

        $tanggal = 1;
        $tanggalTerakhir = $jumlah_hari;
        $hariAwal = date("w", strtotime("$tahun-$bulan-1"));

        echo "<tr>";
        for ($i = 0; $i < $hariAwal; $i++) {
            echo "<td></td>";
        }
        for ($i = 1; $i <= $jumlah_hari; $i++) {
            if ($tanggal <= $tanggalTerakhir) {
                if ($tanggal < 10) {
                    echo "<td>0" . $tanggal . "</td>";
                } else {
                    echo "<td>" . $tanggal . "</td>";
                }
                $tanggal++;
            }
            if (($i + $hariAwal) % 7 == 0) {
                echo "</tr><tr>";
            }
        }
        echo "</tr>";
        echo "</table>";
    } else {
        echo "<p>Masukkan tidak valid. Pastikan Anda memasukkan bulan antara 1-12 dan tahun positif.</p>";
    }
}
?>

</body>
</html>
