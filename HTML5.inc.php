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

	private $title; 
	private $lang;
	private $top;

	public function __construct($title, $lang='da') {
		$this->title = $title;
		$this->lang = $lang;
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
	public function getTop() {
		return $this->top;
	}
	public function getTitle() {
		return $this->title;
	}
	public function prtHeader($root) {
		printf("<header><h1><a href='%s'>%s</a></h1></header>\n"
		       , $root, $this->getTitle());
	}
	public function prtLink($l) {
		printf(self::LINK."\n", $l);
	}
	public function prtScript($s) {
		printf(self::SCRIPT."\n", $s);
	}
}
?>