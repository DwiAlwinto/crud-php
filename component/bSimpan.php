<?php
     //to button simpan
     if (isset($_POST['bsimpan'])) {

        //pengujian apakah bsimpan untuk disimpan baru atau di edit
        if (isset($_GET['hal']) == "edit") { //!untuk edit (method untuk ambil url id_barang edit yang dklik )
            //buat variabel edit
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