<meta charset="UTF-8">
<link rel="stylesheet" href="http://www.webtehayat.net/valuetics/wp-content/themes/valuetics/css/materialize.min.css">
  <h1 class="center-align">Takım Üyesi Düzenleme Paneli</h1>     <h2>Düzenlenecek Takım Üyesi</h2>
   <?php
ob_start(); 
    try {
      include "sql.php";
        $gelen = $_GET['id'];
        if ($_POST) {
            $name= $_POST['isim']; $job= $_POST['meslek']; $description= $_POST['aciklama'];
            $guncelle = $db->prepare("UPDATE team SET  name='$name', job='$job', description='$description'  WHERE id='$gelen'");
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
        foreach($db->query("SELECT * FROM team WHERE id = {$gelen}") as $row) {
                         echo "
                                    <tr>
                                        <td>{$row['id']}</td> <td><img width='100px' height='100px' src=\"http://webtehayat.net/valuetics/wp-content/plugins/edit/{$row['photo']} \"></td> <td>{$row['name']}</td> <td>{$row['job']}</td> <td>{$row['description']}</td> 
                                    </tr>
                               ";
            $resim= $row['photo'];
            $isim= $row['name'];
            $meslek= $row['job'];
            $aciklama= $row['description'];
                       }
echo "</table> <br>";
        echo"
        <div style='width:750px; margin:auto'> <table>
            <form action='' method='post' enctype='multipart/form-data'>
               
                <tr><td>Üye İsmi</td> <td><input type='text' name='isim' value='{$isim}'></td></tr>
                <tr><td>Yaptığı İş</td> <td><input type='text' name='meslek' value='{$meslek}'></td></tr>
                <tr><td>Açıklama</td> <td><input type='text' name='aciklama' value='{$aciklama}'></td></tr>
                <tr><td><input type='submit' value='Verileri Güncelle'></td></tr>
            </form>
        </div></table>";
    
    }catch(PDOException $e){
			echo 'Hata: '.$e->getMessage();
		 }
ob_end_flush(); 
?>