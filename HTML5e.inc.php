<?php
class HTML5e extends HTML5 {
  private $charLogo;
  private $punchLine;

  public function __construct($title
                              , $root="./blogIndex.php"
                              , $punch="Muller&apos;s Blog"
                              , $cl="Üü") {
    parent::__construct($title, $root);
    $this->setPunchLine($punch);
    $this->setCharLogo($cl);
  }

  public function getCharLogo() {
    return $this->charLogo;
  }
  public function setCharLogo($text) {
    $this->charLogo = $text;
  }

  public function getPunchLine() {
    return $this->punchLine;
  }
  public function setPunchLine($text) {
    $this->punchLine = $text;
  }

  public function toHeader() {
    return sprintf("
    <header>
       <p>
       <a href='%s'>%s</a>
       </p>
       <p>
       %s
       </p>
    </header>\n"
    , $this->getRoot(), $this->getCharLogo(), $this->getTitle());
  }
}
?>