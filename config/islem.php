<?php
ob_start();
session_start();  
include 'baglanti.php';



/* Kategori Ekleme */
if (isset($_POST['kategori_ekle'])) 
{


	if($_FILES['resim']){
		$tip = $_FILES['resim']['type'];
		$resimAdi = $_FILES['resim']['name'];
		$uzantisi = explode('.', $resimAdi);
		$uzantisi = $uzantisi[count($uzantisi) - 1];
		$yeni_adi = time() . "." . $uzantisi;

		move_uploaded_file($_FILES["resim"]["tmp_name"], '../img/'.$yeni_adi);


	}
 
	$ilac_ekle=$db->prepare("INSERT INTO kategoriler SET
		kategori_isim=:kategori_isim,
		kategori_sira=:kategori_sira,
		kategori_aciklama=:kategori_aciklama,
		kategori_durum=:kategori_durum,
		kategori_resim_durum=:kategori_resim_durum,
		kategori_resim_baglanti=:kategori_resim_baglanti,
		kategori_resim_yukleme=:kategori_resim_yukleme
		");

	$update=$ilac_ekle->execute(array(
		'kategori_isim' => $_POST['kategori_isim'],
		'kategori_sira' => $_POST['kategori_sira'],
		'kategori_aciklama' => $_POST['kategori_aciklama'],
		'kategori_durum' => $_POST['kategori_durum'],
		'kategori_resim_durum' => $_POST['kategori_resim_durum'],
		'kategori_resim_baglanti' => $_POST['kategori_resim_baglanti'],
		'kategori_resim_yukleme' => $yeni_adi
		));





	if ($update) 
	{

		

		
		//Json Veri Oluşturma
		$sorgu = $db->query("SELECT * FROM kategoriler ORDER BY kategori_sira ASC", PDO::FETCH_ASSOC);
		$sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
		$json_veri = json_encode($sonuc, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		file_put_contents('../json/kategoriler.json', $json_veri);
		//Json Veri Oluşturma

		Header("Location:../kategori-ekle.php?durum=yes"); 

	} 
	else 
	{

		Header("Location:../kategori-ekle.php?durum=no");

	}

}
/* Kategori Ekleme */

/* Kategori Düzenle (Start) */

if (isset($_POST['kategori_duzenle'])) {

	$kategori_id=$_POST['kategori_id'];


	$boyut = $_FILES['resim']['size'];
	if($boyut > 0){
		$tip = $_FILES['resim']['type'];
		$resimAdi = $_FILES['resim']['name'];
		$uzantisi = explode('.', $resimAdi);
		$uzantisi = $uzantisi[count($uzantisi) - 1];
		$yeni_adi = time() . "." . $uzantisi;

		move_uploaded_file($_FILES["resim"]["tmp_name"], '../img/'.$yeni_adi);


	}else{
		$yeni_adi = $_POST['eski_yol'];
	}
	

	
	$ayarkaydet=$db->prepare("UPDATE kategoriler SET
		kategori_isim=:kategori_isim,
		kategori_sira=:kategori_sira,
		kategori_durum=:kategori_durum,
		kategori_resim_durum=:kategori_resim_durum,
		kategori_resim_baglanti=:kategori_resim_baglanti,
		kategori_aciklama=:kategori_aciklama,
		kategori_resim_yukleme=:kategori_resim_yukleme
		WHERE kategori_id={$_POST['kategori_id']}");

	$update=$ayarkaydet->execute(array(
		'kategori_isim' => $_POST['kategori_isim'],
		'kategori_sira' => $_POST['kategori_sira'],
		'kategori_durum' => $_POST['kategori_durum'],
		'kategori_resim_durum' => $_POST['kategori_resim_durum'],
		'kategori_resim_baglanti' => $_POST['kategori_resim_baglanti'],
		'kategori_aciklama' => $_POST['kategori_aciklama'],
		'kategori_resim_yukleme' => $yeni_adi
		));


	if ($update) {

		if($boyut > 0){

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../img/".$resimsilunlink); }

		Header("location:../kategori-duzenle.php?kategori_id=$kategori_id&durum=yes");

				//Json Veri Oluşturma
		$sorgu = $db->query("SELECT * FROM kategoriler ORDER BY kategori_sira ASC", PDO::FETCH_ASSOC);
		$sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
		$json_veri = json_encode($sonuc, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		file_put_contents('../json/kategoriler.json', $json_veri);
		//Json Veri Oluşturma



	} else {

		Header("location:../kategori-duzenle.php?kategori_id=$kategori_id&durum=no");
	}

}
/* Kategori Düzenle (End) */

/*Kategori Sil (Start)*/

if (@$_GET['kategorisil']== "ok") 
{
	$sil=$db->prepare("DELETE from kategoriler where kategori_id=:id");
	$kontrol=$sil->execute(array(
   'id' => $_GET['kategori_id']
	));

   if ($kontrol) 
   {
   	 header('location:../kategoriler.php?durum=silyes');
   }else
   {
   	 header('location:../kategoriler.php?durum=silno');
   }
}

/*Kategori Sil (End)*/




/* Ürün Ekleme */
if (isset($_POST['urun_ekle'])) 
{


		$tip = $_FILES['resim']['type'];
		$resimAdi = $_FILES['resim']['name'];
		$uzantisi = explode('.', $resimAdi);
		$uzantisi = $uzantisi[count($uzantisi) - 1];
		$yeni_adi = time() . "." . $uzantisi;

		move_uploaded_file($_FILES["resim"]["tmp_name"], '../img/'.$yeni_adi);


	
 
	$ilac_ekle=$db->prepare("INSERT INTO urunler SET
		urun_isim=:urun_isim,
		urun_sira=:urun_sira,
		urun_aciklama=:urun_aciklama,
		urun_kategori=:urun_kategori,
		urun_fiyat=:urun_fiyat,
		urun_durum=:urun_durum,
		urun_resim_durum=:urun_resim_durum,
		urun_resim_baglanti=:urun_resim_baglanti,
		urun_resim_yukleme=:urun_resim_yukleme
		");

	$update=$ilac_ekle->execute(array(
		'urun_isim' => $_POST['urun_isim'],
		'urun_sira' => $_POST['urun_sira'],
		'urun_aciklama' => $_POST['urun_aciklama'],
		'urun_kategori' => $_POST['urun_kategori'],
		'urun_fiyat' => $_POST['urun_fiyat'],
		'urun_durum' => $_POST['urun_durum'],
		'urun_resim_durum' => $_POST['urun_resim_durum'],
		'urun_resim_baglanti' => $_POST['urun_resim_baglanti'],
		'urun_resim_yukleme' => $yeni_adi
		));


	if ($update) 
	{


		//Json Veri Oluşturma
		$sorgu = $db->query("SELECT * FROM urunler ORDER BY urun_sira ASC", PDO::FETCH_ASSOC);
		$sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
		$json_veri = json_encode($sonuc, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		file_put_contents('../json/urunler.json', $json_veri);
		//Json Veri Oluşturma



		Header("Location:../urun-ekle.php?durum=yes");

	} 
	else 
	{

		Header("Location:../urun-ekle.php?durum=no");

	}

}
/* Ürün Ekleme */


/*Ürün Sil (Start)*/

if (@$_GET['urunsil']== "ok") 
{
	$sil=$db->prepare("DELETE from urunler where urun_id=:id");
	$kontrol=$sil->execute(array(
   'id' => $_GET['urun_id']
	));

   if ($kontrol) 
   {
   	 header('location:../urunler.php?durum=silyes');
   }else
   {
   	 header('location:../urunler.php?durum=silno');
   }
}

/*Ürün Sil (End)*/


/* Ürün Düzenle (Start) */

if (isset($_POST['urun_duzenle'])) {

	$urun_id=$_POST['urun_id'];

	$boyut = $_FILES['resim']['size'];
	if($boyut > 0){
		$tip = $_FILES['resim']['type'];
		$resimAdi = $_FILES['resim']['name'];
		$uzantisi = explode('.', $resimAdi);
		$uzantisi = $uzantisi[count($uzantisi) - 1];
		$yeni_adi = time() . "." . $uzantisi;

		move_uploaded_file($_FILES["resim"]["tmp_name"], '../img/'.$yeni_adi);


	}else{
		$yeni_adi = $_POST['eski_yol'];
	}

	

	
	$ayarkaydet=$db->prepare("UPDATE urunler SET
		urun_isim=:urun_isim,
		urun_sira=:urun_sira,
		urun_durum=:urun_durum,
		urun_resim_durum=:urun_resim_durum,
		urun_resim_baglanti=:urun_resim_baglanti,
		urun_aciklama=:urun_aciklama,
		urun_resim_yukleme=:urun_resim_yukleme,
		urun_kategori=:urun_kategori
		WHERE urun_id={$_POST['urun_id']}");

	$update=$ayarkaydet->execute(array(
		'urun_isim' => $_POST['urun_isim'],
		'urun_sira' => $_POST['urun_sira'],
		'urun_durum' => $_POST['urun_durum'],
		'urun_resim_durum' => $_POST['urun_resim_durum'],
		'urun_resim_baglanti' => $_POST['urun_resim_baglanti'],
		'urun_aciklama' => $_POST['urun_aciklama'],
		'urun_kategori' => $_POST['urun_kategori'],
		'urun_resim_yukleme' => $yeni_adi
		));


	if ($update) {

		if($boyut > 0){

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../img/".$resimsilunlink); }

		Header("location:../urun-duzenle.php?urun_id=$urun_id&durum=yes");

			//Json Veri Oluşturma
		$sorgu = $db->query("SELECT * FROM urunler ORDER BY urun_sira ASC", PDO::FETCH_ASSOC);
		$sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
		$json_veri = json_encode($sonuc, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		file_put_contents('../json/urunler.json', $json_veri);
		//Json Veri Oluşturma


	} else {

		Header("location:../urun-duzenle.php?urun_id=$urun_id&durum=no");
	}

}
/* Ürün Düzenle (End) */

/*************************************************************/


/*Admin Giriş Ayar Tablosudur. (Start) */

	if (isset($_POST['admingiris'])) 
	{
		$yoneticiler_mail=$_POST['yoneticiler_mail'];
		$yoneticiler_pass=md5($_POST['yoneticiler_pass']);

		$kullanicisor=$db->prepare("SELECT * from yoneticiler where yoneticiler_mail=:mail and yoneticiler_pass=:password");
    	$kullanicisor->execute(array(
      	'mail' => $yoneticiler_mail,
      	'password' => $yoneticiler_pass
      	));

      	$sor=$kullanicisor->rowCount();
      	if ($sor==1) 

      	{

      		$_SESSION['yoneticiler_mail']=$yoneticiler_mail;

			header('location:../index.php');
      	}
      	else
      	{
      		header('location:../login.php?durum=no');
      	}

   		 

 
	}

/*Admin Giriş Ayar Tablosudur. (End) */


/* Profi Güncelle (Start) */

if (isset($_POST['profilekle'])) {

	$yoneticiler_id=$_POST['yoneticiler_id'];

	if($_POST['yoneticiler_pass'] == ''){

	$kullanicisor=$db->prepare("SELECT * from yoneticiler where yoneticiler_id=:id");
    $kullanicisor->execute(array(
      'id' => $yoneticiler_id
    ));

     $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
		$yoneticiler_pass=$kullanicicek['yoneticiler_pass'];

	}else{
		
		$yoneticiler_pass=md5($_POST['yoneticiler_pass']);
	}

	
	
	$ayarkaydet=$db->prepare("UPDATE yoneticiler SET
		yoneticiler_mail=:yoneticiler_mail,
		yoneticiler_user=:yoneticiler_user,
		yoneticiler_pass=:yoneticiler_pass
		WHERE yoneticiler_id={$_POST['yoneticiler_id']}");

	$update=$ayarkaydet->execute(array(
'yoneticiler_user' => $_POST['yoneticiler_user'],
'yoneticiler_mail' => $_POST['yoneticiler_mail'],
'yoneticiler_pass' => $yoneticiler_pass
		));


	if ($update) {

		Header("location:../user.php?durum=yes");

	} else {

		Header("location:../user.php?durum=no");
	}

}
/* Porfil Güncelle (End) */



if (isset($_POST['ilac_kayit'])) {
	
	$ilac_id=$_POST['ilac_id'];
	
	$ilackayit=$db->prepare("UPDATE ilac SET
		ilac_adi=:ilac_adi,
		ilac_etken_madde=:ilac_etken_madde,
		ilac_sinif=:ilac_sinif,
		ilac_endikasyon=:ilac_endikasyon,
		ilac_kontrendikasyon=:ilac_kontrendikasyon,
		ilac_etkilesim=:ilac_etkilesim,
		ilac_yan_etki=:ilac_yan_etki,
		ilac_kulanim_sekli=:ilac_kulanim_sekli,
		ilac_gebe_emzirme=:ilac_gebe_emzirme,
		ilac_es_deger=:ilac_es_deger,
		ilac_hemsire_not=:ilac_hemsire_not,
		ilac_resim_url=:ilac_resim_url
		WHERE ilac_id={$_POST['ilac_id']}");

	$update=$ilackayit->execute(array(
		'ilac_adi' => $_POST['ilac_adi'],
		'ilac_etken_madde' => $_POST['ilac_etken_madde'],
		'ilac_sinif' => $_POST['ilac_sinif'],
		'ilac_endikasyon' => $_POST['ilac_endikasyon'],
		'ilac_kontrendikasyon' => $_POST['ilac_kontrendikasyon'],
		'ilac_etkilesim' => $_POST['ilac_etkilesim'],
		'ilac_yan_etki' => $_POST['ilac_yan_etki'],
		'ilac_kulanim_sekli' => $_POST['ilac_kulanim_sekli'],
		'ilac_gebe_emzirme' => $_POST['ilac_gebe_emzirme'],
		'ilac_es_deger' => $_POST['ilac_es_deger'],
		'ilac_hemsire_not' => $_POST['ilac_hemsire_not'],
		'ilac_resim_url' => $_POST['ilac_resim_url']
		));


	if ($update) {

		Header("location:../ilac-duzenle.php?ilac_id=$ilac_id&durum=yes");

	} else {

		Header("location:../ilac-duzenle.php?ilac_id=$ilac_id&durum=no");
	}

}

if (isset($_POST['json_veri'])) {
	
	$sorgu = $db->query("SELECT * FROM ilac", PDO::FETCH_ASSOC);
	$sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
	$json_veri = json_encode($sonuc, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	file_put_contents('ilaclar.json', $json_veri);

	header("location:../index.php");
}

if (isset($_POST['ilac_sil'])) {
	
	$ilac_sil=$db->prepare("DELETE from ilac where ilac_id=:id");
	$kontrol=$ilac_sil->execute(array(
   'id' => $_POST['ilac_id']
	));

   if ($kontrol) 
   {
   	 header('location:../index.php?durum=silyes');
   }else
   {
   	 header('location:../index.php?durum=silno');
   }
}

 ?>