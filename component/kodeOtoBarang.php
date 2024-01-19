<?php
    //! kode otomatis untuk kode barang
    $kode_otomatis = mysqli_query($koneksi, "SELECT kode FROM tbarang ORDER BY kode DESC LIMIT 1");
    $datax = mysqli_fetch_array($kode_otomatis);
    if ($datax) {
        $no_terakhir = substr($datax['kode'] ,-3) ; //kita ambil no terakhir
        $no = $no_terakhir + 1;

        if ($no > 0 and $no < 10) {
            $kode = "00" . $no ;
        } else if ($no > 10 and $no < 100) {
            $kode = '0' . $no ;
        } else if ($no > 100) {
            $kode = $no ;
        }
    } else {
        $kode = '001';
    }
    $tahun = date('Y');
    $vkode = "IVN-" . $tahun . '-'.$kode ;