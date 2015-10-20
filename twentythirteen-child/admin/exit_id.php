<?php
global $wpdb;
if($_POST['edit'])
  {   
    extract($_POST);
    if(empty($cashback))
    {
        $msg= "Enter Cashback";

    }
    else{
         $sql="UPDATE  exit_id_table SET  cashback ='".$cashback."' WHERE `exit_id_table`.`id` =".$row_id;
              $res=$wpdb->prepare($sql,$arr);
              $r=$wpdb->query($res);  
            if($r)
          {
          ?>
          <script>
                alert("Cashback updated successfully");
                document.location.href="<?php print site_url().'/wp-admin/admin.php?page=exit_id';?>";
          </script>
      
          <?php 
            }
       }
          
  }
?>
<?php 
   if(isset($_GET['id']))
    {
             $idss= $wpdb->get_results("SELECT * FROM exit_id_table where id=".$_GET['id']);
             $r=$wpdb->query("DELETE FROM exit_id_table WHERE id=".$_GET['id']);
             if($r)
             {
                    $msg="Row deleted successfully";
                  wp_safe_redirect( site_url().'/wp-admin/admin.php?page=exit_id', 302 ); 
             }
    }


?>

<?php
global $wpdb; 
    $exit_id_array= $wpdb->get_results("SELECT * FROM exit_id_table");
    if(count($exit_id_array)>0)
    {

    ?>
     <table class="wp-list-table widefat fixed post_status">
        <thead>
       <tr>
        <th>ID</th>
        <th>Exit ID</th>
        <th>User ID</th>   
        <th>Retailer</th>
        <th>Url</th>
        <th>Cashback</th>
        <th>Date/Time</th>    
        <th>Action</th>
    </tr>
        </thead>

    <tbody>
    <?php
    foreach ($exit_id_array as $exit_id) {
        ?>
        <tr>
        <td><?php echo $exit_id->id;?></td>
        <td><?php echo $exit_id->exit_id;?></td>
        <td><?php echo $exit_id->user_id;?></td>    
        <td><?php echo $exit_id->retailer;?></td>
        <td><?php echo $exit_id->url;?></td>
        <td>
         <?php 
        if(isset($_GET['idd']))
        {        
          $exit_id_array= $wpdb->get_results("SELECT * FROM exit_id_table where id=".$_GET['idd']);
         ?>
         <p class="error"><?php if($msg) echo$msg;?></p>
        <form action="" method="post">
            <input type="text" name="cashback" value="<?php echo $exit_id_array[0]->cashback;?>"/>
            <input type="hidden" name="row_id" value="<?php echo $_GET['idd'];?>"/> 
            <input type="submit" name="edit" value="Update cashback"/>
        </form>
        <?php }else{  ?>
        <?php echo $exit_id->cashback;?><a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=exit_id&idd=<?php echo $exit_id->id; ?>">Edit</a>
        <?php }?>
        </td>
        <td><?php echo $exit_id->date1;?></td>
        <td><a href="?page=exit_id&id=<?php echo $exit_id->id; ?>&s=d" onclick="return confirm('Are you sure want to delete this row?');">Delete</a></td>
    </tr>

<?php
 }
    ?>
</tbody>
</table>
<?php
}
else{
?>
<div align="center">No data Founds</div>
<?php
}
 
?>