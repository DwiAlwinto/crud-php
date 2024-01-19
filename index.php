<?php 
   require "service/database.php";
   require "component/bSimpan.php";
   require "component/kodeOtoBarang.php";
   require "component/editSimpan.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD PHP NATIVE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <!-- awal container -->
        <div class="container">
            <h3 class="text-center mt-4">Data Inventory</h3>
            <h3 class="text-center">Kantor Toko Azhari</h3>
            <!-- row -->
            <div class="row">
                <div class="col-md-10 mx-auto">
                     <!-- cards -->
                    <div class="card">
                        <div class="card-header bg-primary text-light">
                            Form Input Datang barang 
                        </div>
                        <div class="card-body">

                            <!-- awal form input barang -->
                            <form action="" method="post">
                            <div class="mb-3">
                                    <label class="form-label">Kode Barang</label>
                                    <input type="text" name="tkode" value="<?= $vkode ?>" class="form-control" placeholder="Input kode barang" required >
                            </div>

                            <div class="mb-3">
                                    <label class="form-label">Nama Barang</label>
                                    <input type="text" name="tnama" value="<?= $vnama ?>" class="form-control" placeholder="Nama kode barang">
                            </div>

                            <div class="mb-3">
                                    <label class="form-label">Asal Barang</label>
                                    <select class="form-select" name="tasal">
                                        <option value="<?= $vasal ?>"> <?= $vasal ?> </option>
                                        <option value="Pembelian">Pembelian</option>
                                        <option value="Hibah">Hibah</option>
                                        <option value="Bantuan">Bantuan</option>
                                        <option value="Sumbangan">Sumbangan</option>
                                    </select>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah</label>
                                        <input type="number" name="tjumlah" value="<?= $vjumlah ?>"  class="form-control" placeholder="Masukan jumlah barang">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Satuan</label>
                                        <select class="form-select" name="tsatuan" value="<?= $vsatuan ?>" >
                                        <option value="<?= $vsatuan ?>"> <?= $vsatuan ?> </option>
                                        <option value="Unit">Unit</option>
                                        <option value="Kotak">Kotak</option>
                                        <option value="Pcs">Pcs</option>
                                        <option value="Pak">Pak</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal di terima</label>
                                        <input type="date" name="tdate" value="<?= $vtanggal_diterima ?>"  class="form-control" placeholder="Tanggal terima barang">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <hr>
                                    <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
                                    <button type="reset" name="bkosongkan" class="btn btn-danger">Kosongkan</button>
                                </div>


                            </div>
                            
                            </form>
                            <!-- awal form input barang -->

                        </div>
                        <div class="card-footer bg-primary">
                            
                        </div>
                    </div>
                    <!-- card -->
                </div>
            </div>
            <!-- row -->


            

             <!-- cards data Barang -->
             <div class="card mt-5">
                        <div class="card-header bg-primary text-light">
                           Datang barang Toko Azhari 
                        </div>
                        <div class="card-body">

                        <!-- untuk pencarian barang -->
                            <div class="col-md-8 mx-auto">
                                <form action="" method="post">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" value="<?= @$_POST['tcari'] ?>" name="tcari" placeholder="Masukan kode barang atau nama barang" required >
                                        <button type="submit" class="btn btn-primary mr-2" name="bcari">Cari</button>
                                        <button type="submit" class="btn btn-danger" name="breset">Reset</button>
                                    </div>
                                </form>
                            </div>
                        <!-- untuk pencarian barang -->

                            
                            <table class="table table-success table-striped table-hover table-border">
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Asal Barang</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Diterima</th>
                                    <th>Aksi</th>
                                </tr>

                                <tr>
                                    <!-- loop data -->
                                    <?php 
                                    $no = 1;

                                    // !untuk pecnarian data (jika tombol cari klik)
                                        if (isset($_POST['bcari'])) {
                                            $pencarian = $_POST['tcari'];
                                            $cari = "SELECT * FROM tbarang WHERE kode like '%$pencarian%' or nama like '%$pencarian%' order by id_barang desc";
                                        } else {
                                            $cari = "SELECT * FROM tbarang ORDER BY id_barang DESC";
                                        }
                                     // !untuk pecnarian data (jika tombol cari klik)

                                        //  $tampil = mysqli_query($koneksi, "SELECT * FROM tbarang ORDER BY id_barang DESC");
                                         $tampil = mysqli_query($koneksi, $cari);
                                         while ($data = mysqli_fetch_array($tampil)) :        //: ini untuk pegnati kurung kurawa                                         
                                    ?>
                                    <!-- loop data -->
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['kode'] ?></td>
                                    <td><?= $data['nama'] ?></td>
                                    <td><?= $data['asal'] ?></td>
                                    <td><?= $data['jumlah'] ?> <?= $data['satuan'] ?> </td>
                                    <td><?= $data['tanggal_diterima']?></td>
                                    <td>
                                        <a href="index.php?hal=edit&id=<?= $data['id_barang'] ?>" class="btn btn-warning" >Edit</a>
                                        <a href="index.php?hal=hapus&id=<?= $data['id_barang'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin Hapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                                <!-- : ini untuk buka. endwhile; untuk tutup -->

                            </table>

                        </div>
                        <div class="card-footer bg-primary">
                            
                        </div>
                    </div>
                    <!-- card  data -->
loca
           
        </div>

    <!-- awal container -->











    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>