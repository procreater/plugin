<?php
    ob_start(); 
    try{   
     include "sql.php";
        $gelen = $_GET['sil'];  
        if (isset($_GET['sil'])) {
          //Silme işlemi için SQL sorgusunu çalıştıralım
          $sonuc = $db->query("DELETE FROM team WHERE id={$_GET['sil']}");
          echo $gelen ."nolu silindi";
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
    }
    catch(PDOException $e){
        echo 'Hata: '.$e->getMessage();
    } 
    ob_flush(); 
?>