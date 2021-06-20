<?php

function whatsapp_menuadmin(){
 
    //menambahkan menu di page
    add_menu_page('Whatsapp Setting', 'Whatsapp', '', 'whatsappmenu', 'fungsi_submenuwhatsapp', 'dashicons-whatsapp',5);
    //menambahkan submenu di page
    add_submenu_page('whatsappmenu', 'Whatsapp Setting', 'Settings WA', 'manage_options', 'submenuwhatsapp', 'fungsi_submenuwhatsapp');

}

    //fungsi submenu -> submenu
    function fungsi_submenuwhatsapp(){

        if ($_POST['nomerwhatsapp'] != ''){
            //print_r($_POST); untuk menampilkan data dalam bentuk post yang disimpan

            //untuk mengupdate data yang disimpan
            update_option('wa_nomerwhatsapp', $_POST['nomerwhatsapp']);
            update_option('wa_textwhatsapp', $_POST['textwhatsapp']);
            update_option('wa_pesanwhatsapp', $_POST['pesanwhatsapp']);
            echo 'Update Berhasil!';
        }
        echo "<h1>Setting Whatsapp</h1>
        <p>Ini adalah fasilitas untuk mengatur Whatsapp</p>
        <h3><form action='' method='post'>
        Nomer: <input type='text' name='nomerwhatsapp' value='".get_option('wa_nomerwhatsapp')."'/><br />
        Text: <input type='text' name='textwhatsapp' value='".get_option('wa_textwhatsapp')."'/><br />
        Pesan: <input type='text' name='pesanwhatsapp' value='".get_option('wa_pesanwhatsapp')."'/><br />
        <input type='submit' value='Update Data'/>
        </form></h3>
        ";

}
add_action('admin_menu', 'whatsapp_menuadmin');


//membuat shortcode whatsappp
function ifungsi_whatsapp($atts){

    $nomerwhatsapp = get_option('wa_nomerwhatsapp');
    $textwhatsapp = get_option('wa_textwhatsapp');
    $pesanwhatsapp = get_option('wa_pesanwhatsapp');

    $var = shortcode_atts(

        array(

            'nomer' => $nomerwhatsapp,
            'pesan' => $textwhatsapp,
            'text' => $pesanwhatsapp

        ), $atts

    );

    //return '<a href="https://wa.me/nomer?text=pesan">Chat disini</a>';
    return '<a href="https://wa.me/'.$var['nomer'].'?text='.urlencode($var['pesan']).'" target="_blank">'.$var['text'].'</a>';
    
}
add_shortcode( 'iwhatsapp', 'ifungsi_whatsapp');


?>