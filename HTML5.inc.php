<?php
class HTML5 {
	const DOCT   	= '<!DOCTYPE html>';
	const HTML      = '<html lang="%s" xml:lang="%s">';
	const CHARSET   = '<meta charset="utf-8"/>';
	const VIEWPORT  = '<meta name="viewport" content="width=device-width"/>';
	const NECK      = "    </head>\n    <body>\n";
	const FOOT      = "    </body>\n</html>\n";
	const LINK      = '        <link rel="stylesheet" href="%s"/>';
	const SCRIPT    = '        <script src="%s"></script>';
	const COPY      = '&copy; NML 2013';

	private $title; 
	private $lang;
	private $top;
	private $root;

	public function __construct($title, $root="./index.php", $lang="en") {
		$this->title = $title;
		$this->lang = $lang;
		$this->root = $root;
		$this->createTop();
	}

	private function createTop() {
		$this->top  = "";
		$this->top .= self::DOCT . "\n";
		$this->top .= self::HTML . "\n";
		$this->top .= "    <head>\n";
		$this->top .= "        ".self::CHARSET."\n"; 
		$this->top .= "        ".self::VIEWPORT."\n";
		$this->top .= "        <title>%s</title>\n";
		$this->top = sprintf($this->top
			, $this->lang, $this->lang, $this->title);
	}
	function getFoot() {
		return self::FOOT;
	}
	function getNeck() {
		return self::NECK;
	}
	function getRoot() {
		return $this->root;
	}
	public function getTop() {
		return $this->top;
	}
	public function getTitle() {
		return $this->title;
	}

	public function toHeader() {
		return sprintf("<header><a href='%s'>%s</a></header>\n"
		       , $this->root, $this->getTitle());
	}

	public function toFooter() {
		return sprintf("<footer>%s</footer>\n"
		       , self::COPY);
	}

	public function toLink($l) {
		return sprintf(self::LINK."\n", $l);
	}
	public function toScript($s) {
		return sprintf(self::SCRIPT."\n", $s);
	}
}
?>