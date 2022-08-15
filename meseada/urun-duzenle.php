
<?php include 'header.php';

$urunsor=$db->prepare("SELECT * from urunler where urun_id=:id");
    $urunsor->execute(array(
      'id' => $_GET['urun_id']
        ));
       $uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);


 ?>

<title>Ürün Düzenle</title>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ürün Düzenle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
              <li class="breadcrumb-item active">Ürün Düzenles</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Ürün Düzenle
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <!-- İnputlu Bilgiler -->
              <form method="POST" action="config/islem.php" enctype="multipart/form-data">
              <div class="row">
                  <div class="col-6">
                    <label>Ürün İsmi</label>
                    <input type="text" class="form-control" placeholder="Örn.: Gözleme" name="urun_isim" value="<?php echo $uruncek['urun_isim']; ?>">
                  </div>
                  <div class="col-6">
                    <label>Ürün Sırası</label>
                    <input type="number" class="form-control" placeholder="Örn.:5" name="urun_sira" value="<?php echo $uruncek['urun_sira']; ?>">
                  </div>
                </div>
              <!-- İnputlu Bilgiler -->

                  <div class="row" style="margin-top: 15px;">
                  <div class="col-6">
                    <label>Ürün Durumu</label>
                   <br>

                  <select class="custom-select rounded-0" id="exampleSelectRounded0" name="urun_durum">


  <option value="true" <?php echo $uruncek['urun_durum'] == 'true' ? 'selected=""' : ''; ?>>Aktif</option>



  <option value="false" <?php if ($uruncek['urun_durum']== 'false') { echo 'selected=""'; } ?>>Pasif</option>

                  </select>


                  </div>
                  <div class="col-6">
                    <label>Ürün Resim Durumu</label>
                   <br>
                    <select class="custom-select rounded-0" id="exampleSelectRounded0" name="urun_resim_durum">

  <option value="false" <?php echo $uruncek['urun_resim_durum'] == 'false' ? 'selected=""' : ''; ?>>Yükleme İle</option>



  <option value="true" <?php if ($uruncek['urun_resim_durum']== 'true') { echo 'selected=""'; } ?>>Bağlantı İle</option>

                  </select>
                  </div>
                </div>

                  <div class="row" style="margin-top: 15px;">
                  <div class="col-6">
                    <label>Ürün Resim Bağlantısı</label>
                   <br>
                   <img width="100" height="100" src="<?php echo $uruncek['urun_resim_baglanti']; ?>">
                   <input type="text" class="form-control" placeholder="İnternet Alldığınız Linki Girin" name="urun_resim_baglanti" value="<?php echo $uruncek['urun_resim_baglanti']; ?>">
                  </div>
                  <div class="col-6">
                    
                  <label>Ürün Resim Yükle</label>
                   <br>
                   <input type="file" name="resim">
                    <br>                   <?php 
                   if($uruncek['urun_resim_yukleme'] == ''){
                    echo "Resim Yok";
                   }else{ ?>

                    <img width="100" height="100" src="img/<?php echo $uruncek['urun_resim_yukleme']; ?>">

                    <input type="hidden" name="eski_yol" value="<?php echo $uruncek['urun_resim_yukleme']; ?>">

                    <?php

                   }


                    ?>
                  </div>
                </div>

              <div style="margin-top: 15px;"></div>
              <textarea id="summernote" rows="10" name="urun_aciklama"> <?php echo $uruncek['urun_aciklama']; ?>
              </textarea>
              <br>
              <div class="row">
                  <div class="col-6">
                    <label>Ürün Kategorisi</label>
                    <select id="heard" class="form-control" name="urun_kategori">


<?php 


$kategorisor=$db->prepare("SELECT * from kategoriler");
        $kategorisor->execute();

while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {
 ?>

    <option value="<?php echo $kategoricek['kategori_id']; ?>" <?php echo $uruncek['urun_kategori'] == $kategoricek['kategori_id'] ? 'selected=""' : ''; ?>><?php echo $kategoricek['kategori_isim']; ?></option>


<?php } ?>

                 </select>
                  </div>
                  <div class="col-6">
                    <label>Ürün Fiyatı</label>
                    <input type="number" class="form-control" placeholder="Örn.:10" name="urun_fiyat" value="<?php echo $uruncek['urun_fiyat']; ?>">
                  </div>
                </div>
              <br>

              <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id']; ?>">

              <input type="submit" class="btn btn-block btn-primary" name="urun_duzenle" value="Ekle">
              </form>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  



<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- CodeMirror -->
<script src="plugins/codemirror/codemirror.js"></script>
<script src="plugins/codemirror/mode/css/css.js"></script>
<script src="plugins/codemirror/mode/xml/xml.js"></script>
<script src="plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="ist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>


<?php include "footer.php"; ?>
