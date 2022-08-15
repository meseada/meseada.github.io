
<?php include 'header.php';

$kategorisor=$db->prepare("SELECT * from kategoriler where kategori_id=:id");
    $kategorisor->execute(array(
      'id' => $_GET['kategori_id']
        ));
       $kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);


 ?>

<title>Kategori Düzenle</title>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kategori Düzenle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
              <li class="breadcrumb-item active">Kategori Düzenle</li>
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
                Kategori Düzenle
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <!-- İnputlu Bilgiler -->
              <form method="POST" action="config/islem.php" enctype="multipart/form-data"  data-parsley-validate>
              <div class="row">
                  <div class="col-6">
                    <label>Kategori İsmi</label>
                    <input type="text" class="form-control" placeholder="Örn.: Kahvaltılık" name="kategori_isim" value="<?php echo $kategoricek['kategori_isim']; ?>">
                  </div>
                  <div class="col-6">
                    <label>Kategori Sırası</label>
                    <input type="number" class="form-control" placeholder="Örn.:5" name="kategori_sira" value="<?php echo $kategoricek['kategori_sira']; ?>">
                  </div>
                </div>


                <div class="row" style="margin-top: 15px;">
                  <div class="col-6">
                    <label>Kategori Durumu</label>
                   <br>

                  <select class="custom-select rounded-0" id="exampleSelectRounded0" name="kategori_durum">

  <option value="true" <?php echo $kategoricek['kategori_durum'] == 'true' ? 'selected=""' : ''; ?>>Aktif</option>



  <option value="false" <?php if ($kategoricek['kategori_durum']== 'false') { echo 'selected=""'; } ?>>Pasif</option>


                  </select>


                  </div>
                  <div class="col-6">
                    <label>Kategori Resmi</label>
                   <br>
                    <select class="custom-select rounded-0" id="exampleSelectRounded0" name="kategori_resim_durum">


  <option value="false" <?php echo $kategoricek['kategori_resim_durum'] == 'false' ? 'selected=""' : ''; ?>>Yükleme İle</option>



  <option value="true" <?php if ($kategoricek['kategori_resim_durum']== 'true') { echo 'selected=""'; } ?>>Bağlantı İle</option>

                  </select>
                  </div>
                </div>



                <div class="row" style="margin-top: 15px;">
                  <div class="col-6">
                    <label>Kategori Resim Bağlantısı</label><br>
                   <img width="100" height="100" src="<?php echo $kategoricek['kategori_resim_baglanti']; ?>">
                   <input type="text" class="form-control" placeholder="İnternet Alldığınız Linki Girin" name="kategori_resim_baglanti" value="<?php echo $kategoricek['kategori_resim_baglanti']; ?>">
                   
                  </div>
                  <div class="col-6">
                    
                  <label>Kategori Resim Yükle</label>
                   <br>
                   <input type="file" name="resim">
                    <br>                   <?php 
                   if($kategoricek['kategori_resim_yukleme'] == ''){
                    echo "Resim Yok";
                   }else{ ?>

                    <img width="100" height="100" src="img/<?php echo $kategoricek['kategori_resim_yukleme']; ?>">

                    <input type="hidden" name="eski_yol" value="<?php echo $kategoricek['kategori_resim_yukleme']; ?>">

                    <?php

                   }


                    ?>
                  </div>
                </div>

              <!-- İnputlu Bilgiler -->

              <div style="margin-top: 15px;"></div>
              <textarea id="summernote" rows="10" name="kategori_aciklama"> <?php echo $kategoricek['kategori_aciklama']; ?>
              </textarea>
              <br>

              <input type="hidden" name="kategori_id" value="<?php echo $kategoricek['kategori_id']; ?>">


              <input type="submit" class="btn btn-block btn-primary" name="kategori_duzenle" value="Ekle">
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
