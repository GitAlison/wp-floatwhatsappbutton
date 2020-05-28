<div class="wrap">
  <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
  <form method="post">
    <?php
    wp_register_style('linkWhatsapp', plugins_url('style.css', __FILE__));
    wp_enqueue_style('linkWhatsapp');

    echo phpversion();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $telefone = $_POST['telefone'];
      $animation = $_POST['animation'];
      $repetir = isset($_POST['repetir']) ? 'on' : 'off';
      $text = $_POST['text'];

      update_option('telefone', $telefone);
      update_option('animation', $animation);
      update_option('repetir', $repetir);
      update_option('text', $text);
      echo '<p class="alert" > Dados do Whatsapp Atualizado </p> </br> ';
    } else {
      $telefone_value = get_option('telefone');
      $animation_value = get_option('animation');
      if ($telefone_value) {
      } else {
        echo 'Voçê não tem um numero de telefone registrado <br> ';
      }
    }
    ?>



    <label for="telefone">Seu Telefone:</label>
    <input type="number" maxlength="15" name="telefone" value=<?php echo get_option('telefone'); ?> />
    <br>
    <br>
    <label for="text">Texto da mensagem: </label>
    <textarea name="text" id="" placeholder="Digite aqui a mensagem que sera enviada para você" cols="30" rows="4"><?php echo get_option('text'); ?></textarea>
    <br>
    <br>

    <label for="telefone">Animacao:</label>
    <select id="animations" name="animation">
      <option value="">Sem Animação</option>
    </select>
    <br>
    <br>
    <label for="repetir">Repetir Animação: </label>
    <input <?php
            $repetir =  get_option('repetir');
            if ($repetir == 'on') {
              echo 'checked';
            }
            ?> type="checkbox" name="repetir" />
    <br>
    <br>
    <?php
    // output security fields for the registered setting "wporg_options"
    settings_fields('wporg_options');
    // output setting sections and their fields
    // (sections are registered for "wporg", each field is registered to a specific section)
    do_settings_sections('wporg');
    // output save settings button


    submit_button(__('Salvar', 'textdomain'));



    add_action('wp_enqueue_scripts', 'register_scripts');
    function register_scripts()
    {
      $phpInfo = array(
        'animation_selected' => get_option('animation')
      );
      wp_localize_script('some_handle', 'phpInfo', $phpInfo);
    }



    ?>
  </form>
</div>

<script>
  let animations = document.getElementById('animations');



  let animations_text = `
  Attention-seekers
  bounce
  flash
  pulse
  rubberBand
  shakeX
  shakeY
  headShake
  swing
  tada
  wobble
  jello
  heartBeat
  Back-entrances
  backInDown
  backInLeft
  backInRight
  backInUp
  Back exits
  backOutDown
  backOutLeft
  backOutRight
  backOutUp
  Bouncing-entrances
  bounceIn
  bounceInDown
  bounceInLeft
  bounceInRight
  bounceInUp
  Bouncing-exits
  bounceOut
  bounceOutDown
  bounceOutLeft
  bounceOutRight
  bounceOutUp
  Fading-entrances
  fadeIn
  fadeInDown
  fadeInDownBig
  fadeInLeft
  fadeInLeftBig
  fadeInRight
  fadeInRightBig
  fadeInUp
  fadeInUpBig
  fadeInTopLeft
  fadeInTopRight
  fadeInBottomLeft
  fadeInBottomRight
  Fading-exits
  fadeOut
  fadeOutDown
  fadeOutDownBig
  fadeOutLeft
  fadeOutLeftBig
  fadeOutRight
  fadeOutRightBig
  fadeOutUp
  fadeOutUpBig
  fadeOutTopLeft
  fadeOutTopRight
  fadeOutBottomRight
  fadeOutBottomLeft
  Flippers
  flip
  flipInX
  flipInY
  flipOutX
  flipOutY
  Lightspeed
  lightSpeedInRight
  lightSpeedInLeft
  lightSpeedOutRight
  lightSpeedOutLeft
  Rotating-entrances
  rotateIn
  rotateInDownLeft
  rotateInDownRight
  rotateInUpLeft
  rotateInUpRight
  Rotating exits
  rotateOut
  rotateOutDownLeft
  rotateOutDownRight
  rotateOutUpLeft
  rotateOutUpRight
  Specials
  hinge
  jackInTheBox
  rollIn
  rollOut
  Zooming-entrances
  zoomIn
  zoomInDown
  zoomInLeft
  zoomInRight
  zoomInUp
  Zooming-exits
  zoomOut
  zoomOutDown
  zoomOutLeft
  zoomOutRight
  zoomOutUp
  Sliding-entrances
  slideInDown
  slideInLeft
  slideInRight
  slideInUp
  Sliding exits
  slideOutDown
  slideOutLeft
  slideOutRight
  slideOutUp
`


  let animations_arr = animations_text.split(' ');
  // let selected_animation = 
  let groupoptions;
  let actual_animation = "<?php echo  get_option('animation'); ?>";
  for (i = 0; i < animations_arr.length; i++) {
    if (animations_arr[i]) {
      if (animations_arr[i][0] == animations_arr[i][0].toUpperCase()) {
        let optgroup = document.createElement("optgroup")
        optgroup.setAttribute("label", animations_arr[i]);
        animations.appendChild(optgroup);
        groupoptions = optgroup;
      } else {
        let option = document.createElement('option');
        option.text = animations_arr[i].trim();
        option.value = animations_arr[i].trim();


        if (option.text == actual_animation) {
          option.selected = true;

        }
        groupoptions.appendChild(option);
      }
    }
  }
</script>