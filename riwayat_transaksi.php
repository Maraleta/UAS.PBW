<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>M-Pay | Riwayat Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; padding: 30px; }
        .card-custom { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: none; height: 100%; }
        .saldo-box { background: #0d6efd; color: white; border-radius: 10px; padding: 15px; font-weight: bold; }
        .table thead { background-color: #f1f5f9; }
    </style>
</head>
<body>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">📋 Riwayat Transaksi Anda</h4>
        <a href="index.php" class="btn btn-secondary btn-sm">🏠 Kembali ke Dashboard</a>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card-custom">
                <h5 class="text-success fw-bold mb-3">Pemasukan (+)</h5>
                <table class="table small">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-masuk-js"></tbody>
                    <tfoot>
                        <tr class="table-light">
                            <th colspan="2">TOTAL MASUK</th>
                            <th class="text-success" id="total-masuk-js">Rp 0</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card-custom">
                <h5 class="text-danger fw-bold mb-3">Pengeluaran (-)</h5>
                <table class="table small">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-keluar-js"></tbody>
                    <tfoot>
                        <tr class="table-light">
                            <th colspan="2">TOTAL KELUAR</th>
                            <th class="text-danger" id="total-keluar-js">Rp 0</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="saldo-box mt-4 text-center">
        SISA SALDO AKHIR: <span id="saldo-akhir-js">Rp 0</span>
    </div>
</div>

<script>
    let transaksi = JSON.parse(localStorage.getItem('m_pay_data')) || [];

    const tabelMasuk = document.getElementById('tabel-masuk-js');
    const tabelKeluar = document.getElementById('tabel-keluar-js');
    
    let totalMasuk = 0;
    let totalKeluar = 0;

    function formatIDR(angka) {
        return new Intl.NumberFormat('id-ID', { 
            style: 'currency', 
            currency: 'IDR', 
            minimumFractionDigits: 0 
        }).format(angka);
    }

    if (transaksi.length === 0) {
        const kosong = `<tr><td colspan="3" class="text-center text-muted">Belum ada transaksi.</td></tr>`;
        tabelMasuk.innerHTML = kosong;
        tabelKeluar.innerHTML = kosong;
    } else {
        transaksi.forEach(t => {
            const baris = `
                <tr>
                    <td>${t.tanggal}</td>
                    <td>${t.deskripsi}</td>
                    <td class="fw-bold ${t.tipe === 'pemasukan' ? 'text-success' : 'text-danger'}">
                        ${t.tipe === 'pemasukan' ? '+' : '-'} ${formatIDR(t.jumlah)}
                    </td>
                </tr>`;

            if (t.tipe === 'pemasukan') {
                tabelMasuk.innerHTML += baris;
                totalMasuk += t.jumlah;
            } else {
                tabelKeluar.innerHTML += baris;
                totalKeluar += t.jumlah;
            }
        });
    }

    document.getElementById('total-masuk-js').innerText = formatIDR(totalMasuk);
    document.getElementById('total-keluar-js').innerText = formatIDR(totalKeluar);
    document.getElementById('saldo-akhir-js').innerText = formatIDR(totalMasuk - totalKeluar);
</script>

</body>
</html>