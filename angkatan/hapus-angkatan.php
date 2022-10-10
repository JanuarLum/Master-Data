<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/navbar.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<?php 
    require_once "menu.php";
    include "../koneksi.php";
    if (isset($_POST['id'])) {
        $tombol="";
        $id = $_POST['id'];
        $QuerySQL = "DELETE FROM angkatan WHERE id=$id";
        $execSQL = mysqli_query($koneksi,$QuerySQL);
        if ($execSQL) {
            header('Location: view-angkatan.php?hapus=1');
        }
        else {
            header('Location: view-angkatan.php?hapus=0');
        }
    }
    elseif(isset($_GET['id'])) {   
        $tombol="";
        $id = $_GET['id'];
        $QuerySQL = "SELECT * from angkatan WHERE id=$id";
        $execSQL = mysqli_query($koneksi,$QuerySQL);

        //cek ada datanya ngga?
        $tahun = "-";
        if (mysqli_num_rows($execSQL) > 0) {
            while ($row = mysqli_fetch_assoc($execSQL)) {
                //ambil data        
                $tahun = $row["tahun"];
            }
        }
    }
    else {
        $id = "-";
        $tahun = "-";
        $tombol="disabled";
    }
?>
<div class="container-fluid mt-3">
  <h3>Apakah Anda Ingin Menghapus Data ini?</h3>
  <table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th><?php echo $id; ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Tahun</td>
            <td><?php echo $tahun; ?></td>
        </tr>
    </tbody>
  </table>
  <form action="hapus-angkatan.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" name="btnHapus" value="Hapus" class="btn btn-danger" <?= $tombol ?>/>
    <a href="view-angkatan.php" class="btn btn-primary">Batal</a>
  </form>
</div>
</body>
</html>


