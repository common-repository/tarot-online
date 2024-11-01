<?php
/**
* Plugin Name: Tarot Online
* Plugin URI: https://wordpress.org/plugins/tarot-online/
* Description: Enter the question, shuffle Tarot deck and read Tarot Online for free.
* Version: 1.5.0
* Author: Sirius Pro
* Author URI: https://siriuspro.pl
* License: GPL v3
* License URI: https://www.gnu.org/licenses/gpl.html
*/

add_action('wp_head', 'tarot_online_styles');
function tarot_online_styles(){ ?>
  <style>
  .tarot-online {
    position: relative;
    width: 100%;
    height: auto;
    display: table;
    border-radius: inherit;
    min-height: 200px;
    height: auto;
    text-align: center;
  }
  .tarot-online .background {
    object-fit: cover;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
    height: 100%;
    border-radius: inherit;
  }
  .tarot-online .overlay {
    width: 100%;
    height: 100%;
    top: 0; 
    left: 0;
    position: absolute;
    background-color: rgba(0, 0, 0, 0.60);
    z-index: 2;
    border-radius: inherit;
  }
  .tarot-online .campaign {
    display: table-cell;
    vertical-align: middle;
    padding-left: 10px;
    padding-right: 10px;
  }
  .tarot-online .campaign .box {
    width: 100%;
    display: block;
    height: 51px;
    z-index: 4;
  }
  .tarot-online .campaign form {
    display: inline-block;
    width: auto;
    height: 51px;
  }
  .tarot-online .logo {
    display: block;
    width: 100%;
    position: absolute;
    height: 34px;
  }
  .tarot-online .logo .brand {
    transition: 0.3s;
    width: 585px;
    max-width: calc(100% - 20px);
    background-color: #111111;
    display: inline-block;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-bottom-left-radius: 25px;
    border-bottom-right-radius: 25px;
    height: 34px;
    line-height: 34px;
    position: absolute;
    top: -34px;
    left: 50%;
    z-index: 4;
    transform: translateX(-50%);
    margin-left: -10px;
  }
  .tarot-online .logo .brand.active {
    top: 0px;
  }
  .tarot-online .logo span {
    font-size: 10px;
    color: #808080;
    font-weight: 300;
    vertical-align: middle;
  }
  .tarot-online .logo img {
    object-fit: contain;
    object-position: center;
    height: 20px;
    width: auto;
    vertical-align: middle;
  }
  .tarot-online .campaign input[type=text] {
    position: relative;
    width: 400px;
    max-width: 100%;
    float: left;
    height: 51px;
    border: none;
    background-color: #e6e6e6;
    padding-left: 25px;
    padding-right: 25px;
    font-size: inherit;
    font-size: inherit;
    border-top-left-radius: 50px;
    border-bottom-left-radius: 50px;
    transition: 0.3s;
    z-index: 5;
  }
  .tarot-online .campaign input[type=text]:focus, .tarot-online .campaign input[type=text]:active {
    outline: none;
  }
  .tarot-online .campaign input[type=submit] {
    position: relative;
    width: 185px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    height: 51px;
    border: none;
    background-color: #efa673;
    font-size: inherit;
    font-size: inherit;
    float: left;
    color: #111111;
    border-top-right-radius: 50px;
    border-bottom-right-radius: 50px;
    transition: 0.3s;
    cursor: pointer;
    z-index: 5;
  }
  .tarot-online .campaign .box.active input[type=text] {
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
    border-top-left-radius: 25px;
    border-top-right-radius: 0px
  }
  .tarot-online .campaign .box.active input[type=submit] {
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
    border-top-left-radius: 0px;
    border-top-right-radius: 25px;
  }
  .tarot-online .campaign input[type=submit]:disabled {
    background-color: #d2d2d2;
    color: #111111;
    cursor: inherit;
  }
  @media (max-width: 661px) {
    .tarot-online .campaign .box, .tarot-online .campaign form {
      height: auto;
    }
    .tarot-online .logo .brand {
      width: 441px;
    }
    .tarot-online .campaign input[type=text] {
      width: 100%;
      float: none;
      max-width: 100%;
      text-align: center;
      border-top-left-radius: 25px;
      border-top-right-radius: 25px;
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
    }
    .tarot-online .campaign input[type=submit] {
      width: 100%;
      float: none;
      max-width: 100%;
      border-bottom-left-radius: 25px;
      border-bottom-right-radius: 25px;
      border-top-left-radius: 0px;
      border-top-right-radius: 0px;
    }
    .tarot-online .campaign .box.active input[type=text] {
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
      border-top-left-radius: 25px;
      border-top-right-radius:25px;
    }
    .tarot-online .campaign .box.active input[type=submit] {
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
      border-top-left-radius: 0px;
      border-top-right-radius: 0px;
    }
  }
  </style>
<?php }

function tarot_online_cdn() {
  echo '<link rel="preconnect" href="//cdn.apitarot.com">';
};
add_action('wp_head', 'tarot_online_cdn');

function tarot_online_assets() {
  $plugin_url = plugins_url();
  $script_path = '/tarot-online/app.js';
  wp_enqueue_script( 'to-scripts', $plugin_url . $script_path, array(), '1.5.0', true );
}

add_action( 'wp_enqueue_scripts', 'tarot_online_assets' );

function tarot_online_scripts_async ($tag) {
 $scripts_to_async = array('app.js');
 foreach ($scripts_to_async as $async_script) {
   if (true == strpos($tag, $async_script) )
   return str_replace( ' src', ' async src', $tag );	
 }
 return $tag;
}

add_filter( 'script_loader_tag', 'tarot_online_scripts_async', 10 );

function tarot_online_shortcode() {

  ob_start();
  ?>  

  <div class="tarot-online">
    <img width="2000" height="200" loading="eager" class="background" title="Tarot Online" alt="Tarot Online" src="https://cdn.apitarot.com/public/img/tarot-online-bg-campaign.webp"/>
    <div class="overlay"></div>
    <div class="campaign">
      <div class="box">
        <form target="_blank" action="https://tarot-online.com.pl" method="POST">
          <input onpaste="return false;" type="text" class="question" name="campaign-question" placeholder="Wpisz pytanie (min. 10 znaków)" required>
          <input name="submit" disabled type="submit" value="POSTAW TAROTA"/>
        </form>
      </div>
      <div class="logo">
        <div class="brand">
          <span>Powered by</span>
          <img width="80" height="20" loading="eager" title="Tarot Online" alt="Tarot Online" src="https://cdn.apitarot.com/public/img/tarot-online-logo.webp"/>
        </div>
      </div>
    </div>
  </div>

  <?php
  return ob_get_clean();
}
add_shortcode("tarot-online", "tarot_online_shortcode");

