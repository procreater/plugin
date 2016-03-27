<?php
ob_start(); 
    try{   
     include "sql.php";
        $gelen = $_GET['delete'];  
        if (isset($_GET['delete'])) {
          //Silme işlemi için SQL sorgusunu çalıştıralım
          $sonuc = $db->query("DELETE FROM team_en WHERE id={$_GET['delete']}");
          echo $gelen ."deleted";
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
        echo 'error: '.$e->getMessage();
    } 
ob_flush(); 
?>