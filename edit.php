<?php
/*
Plugin Name: Edit
Plugin URI: htpp://www.webtehayat.net
Description: Bir bölmü editleyebilmeyi sağlar.
Version: 0.1
Author: Batuhan Akkaya
Author URI: htpp://www.webtehayat.net
License: GNU
*/
    register_activation_hook(__FILE__, 'deger');
    function deger( ) {
        add_option('var_value', 'Hello World!');
    } // varsayılan değer

    register_deactivation_hook(__FILE__, 'delete_plugin');
    function delete_plugin( ) {
        delete_option('var_value');
    } // eklentiyi sil

    add_action('admin_menu', 'yonetim'); //admin menüye menü ekleme
    function yonetim()
    {
        add_options_page('Edit','Edit', '8', 'Edit', 'edit_function');
    } // admin menüyü ve sayfasını ayarladık
    function edit_function() {
        
    if ($_POST['gizli'] == 'tmm') {
    //Gönderdiğimiz veriyi alalım
    $veri = $_POST['merhaba'];
    update_option('var_value', $veri);
    ?>
    <div class="updated"><p><strong><?php _e('Options saved.'); ?></strong></p></div>
    <?php
    }
    ?>
<link rel="stylesheet" href="http://webtehayat.net/psd/psd-9/css/materialize.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://www.webtehayat.net/psd/psd-9/js/materialize.min.js"></script>
<style>
    .list li{padding:10px; background:black; color:#fff; float: left; margin-right: 10px; cursor: pointer;} .aktif {background:red!important;} .clear {clear: both;} select {display: block;}
</style>
<script>
    $(function() {
        $(".menuler ul li:first").addClass("aktif");
        $(".menuler .islem").hide();
        $(".menuler .islem:first").show();
        $(".menuler ul li").click(function() {
            var index = $(this).index();
            $(".menuler ul li").removeClass("aktif");
            $(this).addClass("aktif");
            $(".menuler .islem").hide();
            $(".menuler .islem:eq("+ index +")").show("slide");
        });
            $('select').material_select();
    })
</script>
    <div style="margin-top:10px;">
           <div class="menuler">
               <ul class="list">
                   <li>Team - TR</li>
                   <li>Team - EN</li>
                   <li>Product - TR</li>
                   <li>Product - EN</li>
               </ul> <div class="clear"></div>
           
           <div class="islem">
           
            <h2>Takım Üyesi Ekle</h2>
                <form  action="http://webtehayat.net/valuetics/wp-content/plugins/edit/resimyukle.php" method="post" enctype="multipart/form-data"> 
                    <table style="width:70%">
                        <tr>
                            <td>Resim Yükleyin</td> <td><input type="file" name="resim"></td>
                        </tr>
                        <tr>
                            <td>Ad Soyad</td> <td><input type="text" name="isim"></td>
                        </tr>
                        <tr>
                            <td>Yaptığı İş</td> <td><input type="text" name="meslek"></td>
                        </tr>
                        <tr>
                            <td>Açıklama</td> <td><input type="text" name="aciklama"></td>
                        </tr>
                    </table> 
                    <input type="submit" value="ekle">
                </form> 
                <h2>Eklenmiş Takım Üyeleri</h2>
                <table class='bordered'>
                                    <tr>
                                        <td>No</td> <td>Resim</td> <td>İsim</td> <td>Yaptığı İş</td> <td>Açıklaması</td> <td>İşlemler</td>
                                    </tr>
                <?php
                    try{   
                     include "sql.php";

                     foreach($db->query("SELECT * FROM team") as $row) {
                         echo "
                                    <tr>
                                        <td>{$row['id']}</td> <td><img width='100px' height='100px' src=\"http://webtehayat.net/valuetics/wp-content/plugins/edit/{$row['photo']} \"></td> <td>{$row['name']}</td> <td>{$row['job']}</td> <td>{$row['description']}</td> <td><a href='http://webtehayat.net/valuetics/wp-content/plugins/edit/sil.php?sil=". $row['id'] ."' >sil</a> | <a href='http://webtehayat.net/valuetics/wp-content/plugins/edit/takim-duzenle.php?id=". $row['id'] ."' '>Düzenle</a></td>
                                    </tr>
                               ";
                       }
                    
                ?>
               </table></div>
               <div class="islem"><h2>Add Team Member</h2>
                <form  action="http://webtehayat.net/valuetics/wp-content/plugins/edit/add-image.php" method="post" enctype="multipart/form-data"> 
                    <table style="width:70%">
                        <tr>
                            <td>Add Image</td> <td><input type="file" name="image"></td>
                        </tr>
                        <tr>
                            <td>Name UserName</td> <td><input type="text" name="name"></td>
                        </tr>
                        <tr>
                            <td>Job</td> <td><input type="text" name="job"></td>
                        </tr>
                        <tr>
                            <td>Description</td> <td><input type="text" name="description"></td>
                        </tr>
                    </table> 
                    <input type="submit" value="add">
                </form> 
                <h2>Added Team Member</h2>
                <table class='bordered'>
                                    <tr>
                                        <td>No</td> <td>Image</td> <td>Name</td> <td>Code</td> <td>Description</td> <td>Category</td>
                                    </tr>
                <?php

                     foreach($db->query("SELECT * FROM team_en") as $row) {
                         echo "
                                    <tr>
                                        <td>{$row['id']}</td> <td><img width='100px' height='100px' src=\"http://webtehayat.net/valuetics/wp-content/plugins/edit/{$row['photo']} \"></td> <td>{$row['name']}</td> <td>{$row['job']}</td> <td>{$row['description']}</td> <td><a href='http://webtehayat.net/valuetics/wp-content/plugins/edit/delete.php?delete=". $row['id'] ."' >Delete</a> | <a href='http://webtehayat.net/valuetics/wp-content/plugins/edit/team-edit.php?id=". $row['id'] ."' '>Edit</a></td>
                                    </tr>
                               ";
                       }
                    
                ?>
               </table></div>
               <div class="islem">
                   <h2>Ürün Ekle</h2>
                   <form  action="http://webtehayat.net/valuetics/wp-content/plugins/edit/urun-ekle.php" method="post" enctype="multipart/form-data"> 
                   <table style="width:70%">
                       <tr><td>Ürün Resmi</td> <td><input type="file" name="urun_resim"></td></tr>
                       <tr><td>Ürün İsmi</td> <td><input type="text" name="urun_isim"></td></tr>
                       <tr><td>Ürün Kodu</td> <td><input type="text" name="urun_kod"></td></tr>
                       <tr><td>Ürün Açıklaması</td> <td><input type="text" name="urun_aciklama"></td></tr>
                       <tr><td>Ürün Dosyaları</td> <td><input type="file" name="dosya[]" multiple="multiple"></td></tr>
                       <tr><td>Ürün Kategorisi</td> <td><select multiple="multiple" name="urunkat[]"><?php foreach($db->query("SELECT * FROM kategori") as $row) {
                    echo "<option value={$row['kat_name']}> {$row['kat_name']} <option>";
                } ?></select></td></tr>
                       <tr><td><input type="submit" value="Ürün Ekle"></td></tr>
                   </table> </form>
                   <h2>Eklenmiş Ürünler</h2>
                   <table class="bordered">
                       <tr><td>Ürün Resmi</td><td>Ürün İsmi</td><td>Ürün Kodu</td><td>Ürün Açıklaması</td><td>Ürün Dosyaları</td><td>Ürün Kategorisi</td><td>İşlemler</td></tr> 
                                           <?php
                       foreach ($db->query("SELECT * FROM product") as $row) {
                           $doc=explode(",",$row['file']); // resimle alakası yok sadece dsoyalar sütun ismi ne dosya isismlerinin file
                           ?>
                    <tr>
                            <td><img width='100px'height='100px' src='http://webtehayat.net/valuetics/wp-content/plugins/edit/<?php echo $row['img'] ?>' alt=''></td><td><?php echo $row['name'] ?> </td><td><?php echo $row['cod'] ?></td><td><?php echo $row['description'] ?></td> 
                            
                            <td>
                                 <?php $doc=explode(",",substr($row['file'],0,-1));
                                    for($ds=0;$ds<count($doc); $ds++){
                                        
                                        echo "<a href='http://webtehayat.net/valuetics/wp-content/plugins/edit/files/".$doc[$ds]."'>".$doc[$ds]."</a><br />";
                                        
                                    }
                                ?>
                            </td>
                               <td><?php
                                $bol=explode(",",$row["category"]);
                           for($i=0; $i<count($bol); $i++){ 
                               echo "<span style='margin-right:10px'>".$bol[$i]."</span>";  
                           } ?>
                               </td>
                               <td><a href='http://www.webtehayat.net/valuetics/wp-content/plugins/edit/urun-sil.php?sil=<?php echo $row["urun_id"]; ?>' >Sil</a> | <a href='http://www.webtehayat.net/valuetics/wp-content/plugins/edit/urun-duzenle.php?id=<?php echo $row["urun_id"]; ?>'>Düzenle</a></td>
                           </tr>
                           <?php
                       }
                       ?>
                   </table> 
               </div>
               <div class="islem">
                   <h2>Product Add</h2>
                   <form  action="http://www.webtehayat.net/valuetics/wp-content/plugins/edit/product-add.php" method="post" enctype="multipart/form-data"> 
                   <table style="width:70%">
                       <tr><td>Product Image</td> <td><input type="file" name="urun_resim"></td></tr>
                       <tr><td>Product Name</td> <td><input type="text" name="urun_isim"></td></tr>
                       <tr><td>Product Code</td> <td><input type="text" name="urun_kod"></td></tr>
                       <tr><td>Product Description</td> <td><input type="text" name="urun_aciklama"></td></tr>
                       <tr><td>Product Files</td> <td><input type="file" name="dosya[]" multiple="multiple"></td></tr>
                       <tr><td>Product Category</td> <td class="input-field"><select multiple="multiple" name="urunkat[]"><?php foreach($db->query("SELECT * FROM kategori") as $row) {
                    echo "<option value={$row['kat_name']}> {$row['kat_name']} <option>";
                } ?></select></td></tr>
                       <tr><td><input type="submit" value="Product Add"></td></tr>
                   </table> </form>
                   <h2>Added Product</h2>
                   <table class="bordered">
                       <tr><td>Product Image</td><td>Product Name</td><td>Product Code</td><td>Product Description</td><td>Product Files</td><td>Product Category</td><td>Operation</td></tr> 
                                           <?php
                       foreach ($db->query("SELECT * FROM product_en") as $row) {
                           $doc=explode(",",$row['file']); 
                           ?>
                    <tr>
                            <td><img width='100px'height='100px' src='http://webtehayat.net/valuetics/wp-content/plugins/edit/<?php echo $row['img'] ?>' alt=''></td><td><?php echo $row['name'] ?> </td><td><?php echo $row['cod'] ?></td><td><?php echo $row['description'] ?></td> 
                            
                            <td>
                                 <?php $doc=explode(",",substr($row['file'],0,-1));
                                    for($ds=0;$ds<count($doc); $ds++){
                                        
                                        echo "<a href='http://webtehayat.net/valuetics/wp-content/plugins/edit/files/".$doc[$ds]."'>".$doc[$ds]."</a><br />";
                                        
                                    }
                                ?>
                            </td>
                               <td><?php
                                $bol=explode(",",$row["category"]);
                           for($i=0; $i<count($bol); $i++){ 
                               echo "<span style='margin-right:10px'>".$bol[$i]."</span>";  
                           } ?>
                               </td>
                               <td><a href='http://www.webtehayat.net/valuetics/wp-content/plugins/edit/product-delete.php?delete=<?php echo $row["urun_id"]; ?>' >Delete</a> | <a href='http://www.webtehayat.net/valuetics/wp-content/plugins/edit/product-edit.php?id=<?php echo $row["urun_id"]; ?>'>Edit</a></td>
                           </tr>
                           <?php
                       }
                       
                       
                       }
                    catch(PDOException $e){
                        echo 'Hata: '.$e->getMessage();
                    } ?>
                   </table> 
                   
               </div>
               </div>
               </div>
<?php }
    
        /* Fonksiyon yazalım */
    function islem($content) {
    if (is_home()) {
        $edit_veri    =    get_option('var_value');
        $content =     $edit_veri;
        }
        return $content;
    }

    add_filter('the_content','islem');// işlemlerimiz

$tumveri = get_option("var_value");
?>