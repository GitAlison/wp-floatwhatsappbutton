<?php
/*
Plugin Name: Float Whatsapp
Plugin URI: https://githiub.com/gitalison/wp-floatwhatsappbutton
Description: Um simples plugin
Version: 1.0
Author: Alison aguiar
Author URI: https://gitalison.github.io
License: GPLv2 or later
Text Domain: Alison Aguiar
PHP Version required: 7.4.2
*/


function activatePlugin()
{
  add_option('telefone', '');
  add_option('animation', '');
  add_option('repetir', '');
  add_option('text', '');
}

function deactivatePlugin()
{
  delete_option('telefone');
  delete_option('animation');
  delete_option('repetir');
  delete_option('text');
}

function linkWhatsapp($attr)
{
  wp_register_style('linkWhatsapp', plugins_url('style.css', __FILE__));
  wp_register_style('animatecss', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css");
  wp_enqueue_style('animatecss');
  wp_enqueue_style('linkWhatsapp');
  // echo $attr['pagina']
?>
  <?php
  if (get_option('telefone')) {
    echo "<div id='whatsappbutton' class='float-whatsapp animate__animated'></div>";
  }

  ?>

  <script>
    let animation = "<?php echo  get_option('animation') ?>";
    let repetir = "<?php echo  get_option('repetir') ?>";
    let text = "<?php echo preg_replace("/\r|\n/", "", get_option('text')); ?>".replace(' ', '%20');
    let telefone = "<?php echo  get_option('telefone') ?>";
    let button = document.getElementById('whatsappbutton');

    if (repetir == 'on') {
      button.classList.add('animate__infinite');
    }
    button.classList.add('animate__' + animation);


    button.addEventListener('click', () => {

      window.open(`https://api.whatsapp.com/send?phone=${telefone}&text=${text}`, '_blank')
      console.log('click')
    })
  </script>
<?php
}


if (is_admin()) {
  // we are in admin mode
  // require_once __DIR__ . '/admin/view.php';
}

add_action('admin_menu', 'whatsapp_options_page');
function whatsapp_options_page()
{
  add_menu_page(
    'Whats App',
    'Whats App',
    'manage_options',
    plugin_dir_path(__FILE__) . 'admin/view.php',
    null,
    plugin_dir_url(__FILE__) . 'images/whatsappicon.png',
    1
  );
}

add_shortcode('whatsapp', 'linkWhatsapp');
register_activation_hook(__FILE__, 'activatePlugin');
register_deactivation_hook(__FILE__, 'deactivatePlugin');
