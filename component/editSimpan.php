<?php 
    //Dekelarasi variabel untuk menampung data yang akan di edit
    //v hanya variabel
    //  $vkode = ""; //Karenda sudah menggunakan kode otomatis(ini dah digantii ke kodeOtoBarang.php)
    $vnama = "";
    $vasal= "";
    $vjumlah = "";
    $vsatuan = "";
    $vtanggal_diterima = "";


   //  pengujian JIKA untuk tombol edit dan hapus diklik (untuk data yang akan di edit);
   if (isset($_GET['hal'])) { //ini ambil dari url jadi string $_GET
       //Jika edit data data
       if ($_GET['hal'] == "edit") { //untuk bedit
           //tampilkan data yang akan diedit
           $tampil = mysqli_query($koneksi, "  SELECT * FROM tbarang WHERE id_barang = '$_GET[id]'");
           $data = mysqli_fetch_array($tampil);
           if ($data) {
               //jika data ditemukan, maka data ditampung ke dalam variabel
               $vkode = $data['kode'];
               $vnama = $data['nama'];
               $vasal= $data['asal'];
               $vjumlah = $data['jumlah'];
               $vsatuan = $data['satuan'];
               $vtanggal_diterima = $data['tanggal_diterima']; //ini semua masukan ke form input barang yang di html
           }
       } else if ($_GET['hal'] == "hapus") { //untuk bhapus
           $hapus = mysqli_query($koneksi, "DELETE FROM tbarang WHERE id_barang = '$_GET[id]' ");
           if ($hapus) {
               echo "<script>
                   alert('DELETE data sukses');
                   document.location='index.php';
               </script>";
           }else {
               echo "<script>
                   alert('DELETE data GAGAL');
                   document.location='index.php';
               </script>";
               }
           }
       }