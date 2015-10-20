<?php 
add_action( 'admin_menu', 'create_admin_pages' );
function create_admin_pages()
{
    add_menu_page(
        'Exit ID',
        'Exit ID',
        'manage_options',
        'exit_id',
        'exit_id_fn'
        );
   
}
function exit_id_fn()
{
    include 'exit_id.php';
}
?>