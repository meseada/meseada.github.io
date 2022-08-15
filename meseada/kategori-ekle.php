
<?php include 'header.php'; ?>

<title>Kategori Ekle</title>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kategori Ekle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
              <li class="breadcrumb-item active">Kategori Ekle</li>
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
                Yeni Kategori
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <!-- İnputlu Bilgiler -->
              <form method="POST" action="config/islem.php" enctype="multipart/form-data"  data-parsley-validate>
              <div class="row">
                  <div class="col-6">
                    <label>Kategori İsmi</label>
                    <input type="text" class="form-control" placeholder="Örn.: Kahvaltılık" name="kategori_isim">
                  </div>
                  <div class="col-6">
                    <label>Kategori Sırası</label>
                    <input type="number" class="form-control" placeholder="Örn.:5" name="kategori_sira">
                  </div>
                </div>


                <div class="row" style="margin-top: 15px;">
                  <div class="col-6">
                    <label>Kategori Durumu</label>
                   <br>

                  <select class="custom-select rounded-0" id="exampleSelectRounded0" name="kategori_durum">
                    <option value="true">Seçim Yapın</option>
                    <option value="true">Aktif</option>
                    <option value="false">Pasif</option>
                  </select>


                  </div>
                  <div class="col-6">
                    <label>Kategori Resmi</label>
                   <br>
                    <select class="custom-select rounded-0" id="exampleSelectRounded0" name="kategori_resim_durum">
                    <option value="false">Yükleme İle</option>
                    <option value="true">Bağlantı İle</option>
                  </select>
                  </div>
                </div>



                <div class="row" style="margin-top: 15px;">
                  <div class="col-6">
                    <label>Kategori Resim Bağlantısı</label>
                   <br>
                   <input type="text" class="form-control" placeholder="İnternet Alldığınız Linki Girin" name="kategori_resim_baglanti">
                  </div>
                  <div class="col-6">
                    
                    <label>Kategori Resim Yükle</label>
                   <br>
                   <input type="file" name="resim">
                  
                  </div>
                </div>

              <!-- İnputlu Bilgiler -->

              <div style="margin-top: 15px;"></div>
              <textarea id="summernote" rows="10" name="kategori_aciklama"> Kategori Hakkında Kısa Açıklamanı Bu Kısma Ekleyebilirsin.
              </textarea>
              <br>
              <input type="submit" class="btn btn-block btn-primary" name="kategori_ekle" value="Ekle">
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
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
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
