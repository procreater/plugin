<meta charset="UTF-8">
<link rel="stylesheet" href="http://www.webtehayat.net/valuetics/wp-content/themes/valuetics/css/materialize.min.css">
  <h1 class="center-align">Ürün Düzenleme Paneli</h1>     <h2>Düzenlenecek Ürün</h2>
   <?php
ob_start(); 
    try {
      include "sql.php";
        $gelen = $_GET['id'];
        if ($_POST) {
            $name= $_POST['isim']; $cod= $_POST['kod']; $description= $_POST['aciklama'];
            $guncelle = $db->prepare("UPDATE product SET  name='$name', cod='$cod', description='$description'  WHERE urun_id='$gelen'");
            $guncelle->execute();
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
        }
        echo"<table class='bordered'>";
        foreach($db->query("SELECT * FROM product WHERE urun_id = {$gelen}") as $row) {
                         echo "
                                    <tr>
                                        <td><img width='100px' height='100px' src=\"http://webtehayat.net/valuetics/wp-content/plugins/edit/{$row['img']} \"></td> <td>{$row['name']}</td> <td>{$row['cod']}</td> <td>{$row['description']}</td><td>{$row['file']}</td> <td>{$row['category']}</td>
                                    </tr>
                               ";
            $resim= $row['img'];
            $isim= $row['name'];
            $kod= $row['cod'];
            $aciklama= $row['description'];
            $dosya= $row['file'];
            $kategori= $row['category'];
                       }
echo "</table> <br>";
        echo"
        <div style='width:750px; margin:auto'> <table>
            <form action='' method='post' enctype='multipart/form-data'>
               
                <tr><td>Ürün İsmi</td> <td><input type='text' name='isim' value='{$isim}'></td></tr>
                <tr><td>Ürün Kodu</td> <td><input type='text' name='kod' value='{$kod}'></td></tr>
                <tr><td>Ürün Açıklaması</td> <td><input type='text' name='aciklama' value='{$aciklama}'></td></tr>
                <tr><td><input type='submit' value='Verileri Güncelle'></td></tr>
            </form>
        </div></table>";
    
    }catch(PDOException $e){
			echo 'Hata: '.$e->getMessage();
		 }
ob_end_flush(); 
?>