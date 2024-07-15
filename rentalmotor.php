<?php
$harga_per_hari = 7000;

$hasil = "";
$info = "";

if(isset($_POST['submit'])) {
    if(!empty($_POST['nama_pelanggan']) && !empty($_POST['lama_waktu']) && !empty($_POST['motor'])) {
        $nama_pelanggan = htmlspecialchars($_POST['nama_pelanggan']);
        $lama_waktu = htmlspecialchars($_POST['lama_waktu']);
        $motor = htmlspecialchars($_POST['motor']);

        function hitungBiayaRental($nama_pelanggan, $lama_waktu)
        {
            $pajak = 10000;
            $diskon_member = 0.05;
            $nama_member = ["Ana", "budi", "Anto", "Joko"];
            $is_member = in_array(strtolower($nama_pelanggan), $nama_member);

            global $harga_per_hari;

            $total_biaya = $harga_per_hari * $lama_waktu;

            if ($is_member) {
                $total_biaya -= $total_biaya * $diskon_member;
            }

            $total_biaya += $pajak;

            return $total_biaya;
        }

        $hasil = hitungBiayaRental($nama_pelanggan, $lama_waktu);

        if($hasil > 0) {
            $info = "$nama_pelanggan berstatus sebagai ";
            $info .= (in_array(strtolower($nama_pelanggan), ["ana", "budi", "Anto", "Joko"])) ? "member " : "non-member ";
            $info .= (in_array(strtolower($nama_pelanggan), ["ana", "budi", "Anto", "Joko"])) ? "mendapatkan diskon 5%. " : "tidak mendapatkan diskon 5%. ";
            $info .= "Jenis motor yang dirental adalah $motor selama $lama_waktu hari dengan harga rental per hari-harinya: Rp. " . number_format($harga_per_hari, 0, ',', '.') . ".<br>";
            $info .= "Biaya yang harus dibayarkan adalah Rp. " . number_format($hasil, 0, ',', '.') . ",-";
        } else {
            $info = "Input tidak valid";
        }
    } else {
        $info = "Semua input harus diisi";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Rental Motor</title>
    <style>
        body {
            background: #f2f2f2;
            font-family: sans-serif;
        }

        .input-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .input-container .h21 {
            margin-right: 20px;
            flex: 0 0 auto; 
        }

        .input-container .bil2 {
            flex: 1; 
            margin-left: 10px; 
            width: auto; 
        }

        .kalkulator {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 10px 20px 0px #d1d1d1;
            background-color: white;
        }

        .bil1,
        .bil2,
        .opt {
            width: 100%;
            border: none;
            font-size: 16pt;
            border-radius: 5px;
            padding: 10px;
            margin: 5px;
        }

        .tombol {
            background: lightgreen;
            text-align: center;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            color: rgb(29, 27, 27);
            font-size: 15pt;
            cursor: pointer;
            margin-top: 20px;
        }

        .judul {
            text-align: center;
            color: black;
            font-weight: normal;
            margin-top: 50px;
            font-size: 3rem;
        }

        .hasil-container {
            text-align: center;
        }

        .info {
            text-align: center;
            font-size: 1.2rem;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<h2 class="judul">Rental Motor</h2>
<div class="kalkulator">
    <form method="post" action="">
        <div class="input-container">
            <h2 class="h21">Nama Pelanggan:</h2>
            <input type="text" name="nama_pelanggan" class="bil1" autocomplete="off" placeholder="Masukkan nama pelanggan" required>
        </div>
        <div class="input-container">
            <h2 class="h21">Lama Waktu:</h2>
            <input type="number" name="lama_waktu" class="bil2" autocomplete="off" placeholder="Masukkan lama waktu" required min="1">
        </div>
        <div class="input-container">
            <h2 class="h21">Jenis Motor:</h2>
            <select class="opt" name="motor" required>
                <option value="" disabled selected>Pilih Motor</option>
                <option value="Honda Beat">Honda Beat</option>
                <option value="Yamaha NMAX">Yamaha NMAX</option>
                <option value="Suzuki Satria F150">Suzuki Satria F150</option>
                <option value="Kawasaki Ninja 250RR">Kawasaki Ninja 250RR</option>
            </select>
        </div>
        <div class="input-container">
            <input type="submit" name="submit" value="Submit" class="tombol">
        </div>
    </form>
    <?php if($info != "") { ?>
    <div class="hasil-container">
        <p class="info"><?php echo $info; ?></p>
    </div>
    <?php } ?>
</div>
</body>
</html>