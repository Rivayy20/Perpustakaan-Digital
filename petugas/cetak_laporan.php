<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman Mobil</title>
    <style>
        /* CSS untuk tampilan cetak */
        @media print {
            @page {
                margin: 0;
                /* Hilangkan margin yang biasanya memunculkan URL di header/footer */
            }

            body {
                margin: 1cm;
                /* Tambahkan margin internal agar dokumen rapi */
            }

            /* Hilangkan elemen yang tidak diperlukan */
            .no-print {
                display: none;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body>

    <h2 align="center">Laporan Peminjaman Buku</h2>
    <table>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>No Polisi</th>
            <th>Tanggal Ambil</th>
            <th>Tanggal Kembali</th>
            <th>Supir</th>
            <th>Total Biaya</th>
            <th>Bayar Dp</th>
            <th>Status</th>
        </tr>
        <?php
        include "conn.php";
        $i = 1;
        $query = mysqli_query($conn, "SELECT tb_transaksi.nik, tb_transaksi.nopol, tb_transaksi.tgl_booking, tb_transaksi.tgl_ambil, tb_transaksi.tgl_kembali, tb_transaksi.supir, tb_transaksi.total, tb_transaksi.dp, tb_bayar.status 
                            FROM tb_transaksi 
                            JOIN tb_kembali ON tb_transaksi.id_transaksi = tb_kembali.id_transaksi
                            JOIN tb_bayar ON tb_kembali.id_kembali = tb_bayar.id_kembali
                            WHERE tb_bayar.status = 'lunas'");
        while ($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $data['nik']; ?></td>
                <td><?php echo $data['nopol']; ?></td>
                <td><?php echo $data['tgl_ambil']; ?></td>
                <td><?php echo $data['tgl_kembali']; ?></td>
                <td><?php echo $data['supir'] == 1 ? 'Ya' : 'Tidak'; ?></td>
                <td>Rp <?php echo number_format($data['total'], 0, ',', '.'); ?></td>
                <td>Rp <?php echo number_format($data['dp'], 0, ',', '.'); ?></td>
                <td><?php echo $data['status']; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>

    <script>
        window.print();
        setTimeout(function () {
            window.close();
        }, 100);
    </script>

</body>

</html>