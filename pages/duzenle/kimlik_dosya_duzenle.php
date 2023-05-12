<?php
    $id = intval($_GET["id"]);
    $uyefoto = $db->prepare("SELECT * FROM uye_kimlik_dosyalari WHERE id = ? AND uye_id=?");
    $uyefoto->execute(array($id,$_SESSION['id']));
    if ($uyefoto) {
        $uye = $uyefoto->fetch(PDO::FETCH_OBJ);
    }
?>
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Kimlik Dosya Düzenle</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Anasayfa</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Menü</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Dosya Düzenle</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Kimlik Dosya Düzenleme Sayfası</a></li> 
      </ol>
    </section>
     
    <section class="content container-fluid">
      <div class="row">
      <div class="col-lg-12">
          <div class="chart-box">
            <div class="head-title">
              <h4 style="text-align: center;">Kimlik Dosyanı Güncelle </h4>
              <p class="text-center m-top-2">Gönderdiğiniz Dosyaları Bu Ekrandan Güncelleyebilirsiniz</p>
            </div>
            <br><br>
 
            <?php

if($uye) { 

if($_POST['yuklekimlik']){



   $gecici_ad=$_FILES["uye_kimlik"]["tmp_name"];
   $rand =substr(md5(uniqid(rand())),0,10);
   $kalici_yol_ad="uploads_kimlik/".$randomubunaal=$rand.($_FILES["uye_kimlik"]["name"]);

   if ($_FILES["uye_kimlik"]["error"]) // hata oluştu ise
      echo "<font color='green'>Hata : ",$_FILES["uye_kimlik"]["error"],"</font>";
   else{
      if (file_exists($kalici_yol_ad)) // yüklenen dosya upload dizininde varsa
         echo "<font color='red'>Yazdığınız ad ile bir dosya zaten kayıtlıdır.</font>";
      else{
         if ( move_uploaded_file($gecici_ad,$kalici_yol_ad)) {

          $resim_tarih = date("Y-m-d H:i:s");
          $uye_kimlik = $randomubunaal=$rand.($_FILES["uye_kimlik"]["name"]);

       
          $uye_guncelle_kimlik = $db->prepare("UPDATE uye_kimlik_dosyalari SET uye_kimlik = ? , resim_tarih = ? WHERE id = ? AND uye_id=?");
          $uye_guncelle_kimlik->execute(array($uye_kimlik,$resim_tarih, $id,$_SESSION['id']));

          echo "<font color='green'>Dosya başarı ile yüklendi.</font>";

         

           
           
         } // eğer dosya kaydedilirse
         
            
         else
             echo "<font color='red'>Dosya yükleme başarısız.</font>";
      }
   }
}

?>




 


            <form method="post" action="" enctype="multipart/form-data">
   
            <div class="row">
            <div class="col-md-12 form-group border">
            <table border="0">
<tr>
<td class="bg-success">Kimlik Seçiniz:</td>
<td  class="bg-success"><input type="file" name="uye_kimlik"></td>
</tr>

                        <div  class="col-md-4"></div>
                        <div style="margin-bottom: 20px;" class="col-md-4"><a href="uploads_kimlik/<?php echo $uye->uye_kimlik; ?>" download><img width="100%;" height="150px;" src="uploads_kimlik/<?php echo $uye->uye_kimlik; ?>"></a></div>
                        <div  class="col-md-4"></div>

                       


                      </table>
                    </div>
                      <input class="btn btn-primary" type="submit" name="yuklekimlik" value="Seçilen Dosyayı Yükle" style="width: 100%;" >

                </div>

          </form>

            </div>
           
          </div>
        </div>
         
      </div>
       
    </section> 
  </div>
  <?php } else { 
                                header("Location:pages/duzenle/hata.php");

   } ?> 