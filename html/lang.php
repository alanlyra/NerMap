<?php
include_once (dirname ( __FILE__ ) . '/include/language.php');
$lang = new Language();
// print_r($lang->language_area);
$current_language = getCurrentLanguage();
// print_r($current_language);

function getCurrentLanguage() {
  global $lang, $languages;
  $languages = array(
    'en-US'  => 'English',
    'pt-BR'  => 'Português'
  );
  if (array_key_exists ( $lang->language_area, $languages )) {
    return $lang->language_area;
  } else if (array_key_exists ( $lang->language_country, $languages )) {
    return $lang->language_country;
  } else {
    return 'en-US';
  }
}
$language_file=$lang->getFileDir('language.php');  
include($language_file);
?>

<script type="text/javascript">
  var domain="<?php echo $_SERVER['HTTP_HOST']; ?>";
  var cur_language="en-US";
  function change_language (x) {
    setCookie("lang", x, 1, "/", domain, false);
    if(cur_language == x) {
      return;
    }
        document.location.reload();
      }
  // writeCookie("myCookie", "my name", 24);  
  // Stores the string "my name" in the cookie "myCookie" which expires after 24 hours.
  function setCookie( name, value, expires, path, domain, secure ) {
    var today = new Date();
    today.setTime( today.getTime() );
    if ( expires ) {
    expires = expires * 1000 * 60 * 60 * 24;
    }
    var expires_date = new Date( today.getTime() + (expires) );
    document.cookie = name+'='+escape( value ) +
    ( ( expires ) ? ';expires='+expires_date.toGMTString() : '' ) + //expires.toGMTString()
    ( ( path ) ? ';path=' + path : '' ) +
    ( ( domain ) ? ';domain=' + domain : '' ) +
    ( ( secure ) ? ';secure' : '' );
  }
</script>
