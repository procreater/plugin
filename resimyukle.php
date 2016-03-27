<meta charset="UTF-8">
<?php
ob_start();
if($_POST){

  try{   
		 include "sql.php";
		 
	}
		 catch(PDOException $e){
			echo 'Hata: '.$e->getMessage();
		 }

    if ($_FILES["resim"]["size"]<1024*1024){//Dosya boyutu 1Mb tan az olsun

        if ($_FILES["resim"]["type"]=="image/jpeg" || $_FILES["resim"]["type"]=="image/png"){  //dosya tipi jpeg olsun
			 $name = $_POST['isim'];
			$job = $_POST['meslek'];
			$description = $_POST['aciklama'];
			
            $dosya_adi   =    $_FILES["resim"]["name"];
 
            //Resimi kayıt ederken yeni bir isim oluşturalım
            $uret=array("as","rt","ty","yu","fg");
            $uzanti=substr($dosya_adi,-4,4);
            $sayi_tut=rand(1,10000);
 
            $yeni_ad="images/".$uret[rand(0,4)].$sayi_tut.$uzanti;
 
            //Dosya yeni adıyla uploadklasorune kaydedilecek
 
            if (move_uploaded_file($_FILES["resim"]["tmp_name"],$yeni_ad)){
                echo 'Dosya başarıyla yüklendi.';
                
                //Bilgileri veritabanına kayıt ediyoruz..
 
$sorgu = $db->prepare("INSERT INTO team (photo, name, job, description) VALUES (?,?,?,?)");
 
            $sorgu->execute(array($yeni_ad,$name,$job,$description));
 
            if ($sorgu){
                echo 'Veritabanına kaydedildi.';
                
                function redirect($filename) {
                    if (!headers_sent())
                        header('Location: '.$filename);
                    else {
                        echo '<script type="text/javascript">';
                        echo 'window.location.href="'.$filename.'";';
                        echo '</script>';
                        echo '<noscript>';
                        echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
                        echo '</noscript>';
                    }
                }
                redirect('http://www.webtehayat.net/valuetics/wp-admin/options-general.php?page=Edit');  
                    
            }else{
                echo 'Kayıt sırasında hata oluştu!';
            }
        }else{
            echo 'Dosya Yüklenemedi!';
        }
    }else{
        echo 'Dosya yalnızca jpeg formatında olabilir!';
    }
    }else{          
        echo 'Dosya boyutu 1 Mb ı geçemez!';
    }
}
ob_end_flush();
?>