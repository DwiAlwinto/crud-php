<?php
     //koneksi database
     $server = "localhost";
     $user = "root";
     $password = "";
     $database = "databarang";

     //to koneksi
     $koneksi = mysqli_connect(
         $server,
         $user,
         $password,
         $database
     ) 
     or die (mysqli_error($koneksi));

     


     //to button simpan
     if (isset($_POST['bsimpan'])) {

        //pengujian apakah bsimpan untuk disimpan baru atau di edit
        if (isset($_GET['hal']) == "edit") { //!untuk edit
            $edit = mysqli_query($koneksi, "UPDATE tbarang SET 
                                                    nama = '$_POST[tnama]',
                                                    asal = '$_POST[tasal]',
                                                    jumlah = '$_POST[tjumlah]',
                                                    satuan = '$_POST[tsatuan]',
                                                    tanggal_diterima = '$_POST[tdate]'
                                                WHERE id_barang = '$_GET[id]'
                                            ");
            //edit or update
            if ($edit) {
                echo "<script>
                        alert('UPDATE data sukses');
                        document.location='index.php';
                     </script>";
            }else{
                echo "<script>
                        alert('Data Gagal di UPDATE');
                        document.location='index.php';
                     </script>";
            } 
        } else { //jika bukan edit akan disimpan
             // bsimpan diklik untuk disimpan
        $simpan = mysqli_query($koneksi, " INSERT INTO tbarang (kode, nama, asal, jumlah, satuan, tanggal_diterima)
        VALUE ( '$_POST[tkode]',
                '$_POST[tnama]',
                '$_POST[tasal]',
                '$_POST[tjumlah]',
                '$_POST[tsatuan]',
                '$_POST[tdate]'
              )
        ");
            if ($simpan) {
                echo "<script>
                    alert('Simpan data sukses');
                    document.location='index.php';
                </script>";
            }else {
                echo "<script>
                    alert('Simpan data GAGAL');
                    document.location='index.php';
                </script>";
                }
            }
        }

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


    //Dekelarasi variabel untuk menampung data yang akan di edit
    //v hanya variabel
    //  $vkode = ""; //Karenda sudah menggunakan kode otomatis
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
