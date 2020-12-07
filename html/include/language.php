<?php
class Language
{
  public $language_area;
  public $language_country;
  public $language_dir;
  public $dir;
  public function __construct()
  {
    $this->dir = str_replace("\\", "/", dirname(__FILE__)) . "/language/";
    $this->initDefaultLanguage();
    if (empty($this->language_country) && !empty($this->language_area)) {
        $this->language_country = substr($this->language_area, 0, strpos($this->language_area, "-"));
    }
    $this->initLanguageDir();
  }
  public function getFileDir($file)
  {
    $dir = $this->dir;
    if (file_exists($this->getLanguageDir() . $file)) {
      return $this->getLanguageDir() . $file;
    } else {
      if (file_exists($dir . $this->language_area . "/" . $file)) {
        return $dir . $this->language_area . "/" . $file;
      } else {
        if (file_exists($dir . $this->language_country . "/" . $file)) {
          return $dir . $this->language_country . "/" . $file;
        } else {
          if (file_exists($dir . "en-US/" . $file)) {
            return $dir . "en-US/" . $file;
          } else {
            return false;
          }
        }
      }
    }
  }
  public function getLanguageDir()
  {
    return $this->language_dir;
  }
  private function initLanguageDir()
  {
      $dir = $this->dir;
      
      //Seta Inglês manualmente
      $this->language_dir = $dir . 'en-US/';

      //Pega idioma do chache
      //if (file_exists($dir . $this->language_area) && !empty($this->language_area)) {
      //    $this->language_dir = $dir . $this->language_area . '/';
      //} else {
      //    if (file_exists($dir . $this->language_country) && !empty($this->language_country)) {
      //        $this->language_dir = $dir . $this->language_country . '/';
      //    } else {
      //        $this->language_dir = $dir . 'en-US/';
      //    }
      //}
  }
  public function initDefaultLanguage()
  {
    if ($this->getCookieLanguage()) {
      return;
    }
    $language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    preg_match_all("/[\\w-]+/", $language, $language);
    $this->language_area = $language[0][0];
    @($this->language_country = $language[0][1]);
    $this->setCookieLanguage();
  }
  /* 
  cookie
  */
  public function getCookieLanguage()
  {
    if (!@empty($_COOKIE['lang'])) {
      $language = $_COOKIE['lang'];
      if (strpos($language, "-")) {
        $this->language_area = $language;
      } else {
        $this->language_country = $language;
      }
      return true;
    }
    return false;
  }
  /*
  cookie
  */
  public function setCookieLanguage($lang = "")
  {
    if (empty($lang)) {
      $lang = $this->language_area;
    }
    if (empty($lang)) {
      $lang = $this->language_country;
    }
    if (empty($lang)) {
      return false;
    }
    setcookie("lang", $lang, time() + 365 * 24 * 3600, "/", $this->getDomain());
    return true;
  }
  public function getDomain()
  {
    if (empty($this->domain)) {
      $domain = $_SERVER['SERVER_NAME'];
      if (strcasecmp($domain, "localhost") === 0) {
        $this->domain = $domain;
        return $this->domain;
      }
      if (preg_match("/^(\\d+\\.){3}\\d+\$/", $domain, $domain_temp)) {
        $this->domain = $domain_temp[0];
        return $this->domain;
      }
      preg_match_all("/\\w+\\.\\w+\$/", $domain, $domain);
      $this->domain = $domain[0][0];
      return $this->domain;
    } else {
      return $this->domain;
    }
  }
}
