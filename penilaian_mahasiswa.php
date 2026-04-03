<?php
// SISTEM PENILAIAN MAHASISWA
// Tugas Pertemuan 3 - PHP

// DATA MAHASISWA (Array Asosiatif)
$mahasiswa = [
    [
        "nama"        => "Andi Pratama",
        "nim"         => "2023001",
        "nilai_tugas" => 80,
        "nilai_uts"   => 75,
        "nilai_uas"   => 85
    ],
    [
        "nama"        => "Budi Santoso",
        "nim"         => "2023002",
        "nilai_tugas" => 60,
        "nilai_uts"   => 55,
        "nilai_uas"   => 50
    ],
    [
        "nama"        => "Citra Dewi",
        "nim"         => "2023003",
        "nilai_tugas" => 90,
        "nilai_uts"   => 88,
        "nilai_uas"   => 92
    ],
    [
        "nama"        => "Doni Firmansyah",
        "nim"         => "2023004",
        "nilai_tugas" => 70,
        "nilai_uts"   => 65,
        "nilai_uas"   => 72
    ]
];

// FUNCTION: Hitung Nilai Akhir
// Bobot: Tugas 30%, UTS 30%, UAS 40%
function hitungNilaiAkhir($tugas, $uts, $uas) {
    $nilai_akhir = ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
    return $nilai_akhir;
}

// FUNCTION: Tentukan Grade
function nentukanGrade($nilai_akhir) {
    if ($nilai_akhir >= 85) {
        return "A";
    } elseif ($nilai_akhir >= 75) {
        return "B";
    } elseif ($nilai_akhir >= 65) {
        return "C";
    } elseif ($nilai_akhir >= 55) {
        return "D";
    } else {
        return "E";
    }
}

// FUNCTION: Tentukan Status Kelulusan
function nentukanStatus($nilai_akhir) {
    if ($nilai_akhir >= 60) {
        return "LULUS";
    } else {
        return "TIDAK LULUS";
    }
}

// PROSES DATA: Hitung nilai setiap mahasiswa
$total_nilai  = 0;
$nilai_tertinggi = 0;
$nama_tertinggi  = "";

foreach ($mahasiswa as $key => $mhs) {
    // Hitung nilai akhir
    $nilai_akhir = hitungNilaiAkhir(
        $mhs["nilai_tugas"],
        $mhs["nilai_uts"],
        $mhs["nilai_uas"]
    );

    // Simpan hasil ke array
    $mahasiswa[$key]["nilai_akhir"] = $nilai_akhir;
    $mahasiswa[$key]["grade"]       = nentukanGrade($nilai_akhir);
    $mahasiswa[$key]["status"]      = nentukanStatus($nilai_akhir);

    // Akumulasi untuk rata-rata
    $total_nilai += $nilai_akhir;

    // Cek nilai tertinggi
    if ($nilai_akhir > $nilai_tertinggi) {
        $nilai_tertinggi = $nilai_akhir;
        $nama_tertinggi  = $mhs["nama"];
    }
}

// Hitung rata-rata kelas
$jumlah_mahasiswa = count($mahasiswa);
$rata_rata        = $total_nilai / $jumlah_mahasiswa;

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            color: #333;
            padding: 30px 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: #1a237e;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }

        /* Tabel Utama */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }

        th {
            background-color: #1a237e;
            color: #fff;
            padding: 12px 15px;
            text-align: center;
            font-size: 14px;
        }

        td {
            padding: 11px 15px;
            text-align: center;
            font-size: 14px;
            border-bottom: 1px solid #e8e8e8;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e8eaf6;
        }

        /* Badge Grade */
        .grade {
            display: inline-block;
            width: 32px;
            height: 32px;
            line-height: 32px;
            border-radius: 50%;
            font-weight: bold;
            font-size: 15px;
            color: #fff;
        }

        .grade-A { background-color: #2e7d32; }
        .grade-B { background-color: #1565c0; }
        .grade-C { background-color: #f57f17; }
        .grade-D { background-color: #e65100; }
        .grade-E { background-color: #b71c1c; }

        /* Badge Status */
        .status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .lulus {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .tidak-lulus {
            background-color: #ffebee;
            color: #b71c1c;
        }

        /* Kartu Ringkasan */
        .summary {
            display: flex;
            gap: 20px;
        }

        .card {
            flex: 1;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .card .label {
            font-size: 13px;
            color: #888;
            margin-bottom: 8px;
        }

        .card .value {
            font-size: 28px;
            font-weight: bold;
            color: #1a237e;
        }

        .card .sub {
            font-size: 13px;
            color: #555;
            margin-top: 5px;
        }

        /* Info bobot */
        .bobot-info {
            background-color: #e8eaf6;
            border-left: 4px solid #1a237e;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 13px;
            color: #333;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>📋 Sistem Penilaian Mahasiswa</h1>
    <p class="subtitle">Tugas Pertemuan 3 &mdash; Pemrograman Web (PHP)</p>

    <!-- Info Bobot Penilaian -->
    <div class="bobot-info">
        <strong>Bobot Penilaian:</strong>
        Tugas 30% &nbsp;|&nbsp; UTS 30% &nbsp;|&nbsp; UAS 40%
        &nbsp;&nbsp;&mdash;&nbsp;&nbsp;
        <strong>Lulus</strong> jika Nilai Akhir &ge; 60
    </div>

    <!-- Tabel Data Mahasiswa -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Tugas</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // LOOP: Tampilkan data setiap mahasiswa
            $no = 1;
            foreach ($mahasiswa as $mhs) :
                // Tentukan class CSS untuk status
                $status_class = ($mhs["status"] == "LULUS") ? "lulus" : "tidak-lulus";
                $grade_class  = "grade-" . $mhs["grade"];
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $mhs["nama"] ?></td>
                <td><?= $mhs["nim"] ?></td>
                <td><?= $mhs["nilai_tugas"] ?></td>
                <td><?= $mhs["nilai_uts"] ?></td>
                <td><?= $mhs["nilai_uas"] ?></td>
                <td><strong><?= number_format($mhs["nilai_akhir"], 1) ?></strong></td>
                <td>
                    <span class="grade <?= $grade_class ?>">
                        <?= $mhs["grade"] ?>
                    </span>
                </td>
                <td>
                    <span class="status <?= $status_class ?>">
                        <?= $mhs["status"] ?>
                    </span>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Kartu Ringkasan -->
    <div class="summary">
        <div class="card">
            <div class="label">Jumlah Mahasiswa</div>
            <div class="value"><?= $jumlah_mahasiswa ?></div>
            <div class="sub">orang</div>
        </div>
        <div class="card">
            <div class="label">Rata-rata Kelas</div>
            <div class="value"><?= number_format($rata_rata, 1) ?></div>
            <div class="sub">nilai akhir</div>
        </div>
        <div class="card">
            <div class="label">Nilai Tertinggi</div>
            <div class="value"><?= number_format($nilai_tertinggi, 1) ?></div>
            <div class="sub"><?= $nama_tertinggi ?></div>
        </div>
    </div>

</div>

</body>
</html>
