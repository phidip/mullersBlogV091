<?php
  session_start();
  require_once('blogParams.inc.php');
  if (!isset($_SESSION[$loginToken])) {  // am I logged on?
    header("Location: ./blogIndex.php?errorcode=2");
  }                                 // if not, go and do it!

  require_once('DbH.inc.php');
  $dbh = new DbH($db);
  require_once('Table.inc.php');
  require_once('Tablee.inc.php');
  require_once('HTML5.inc.php');
  require_once('HTML5e.inc.php');
  $doc = new HTML5e("Umlaute");
  
  print($doc->getTop());
  print($doc->toLink("./blog1.css"));
  print($doc->toLink("./blog2.css"));
  print($doc->toScript("./blogJsLib.js"));
  print($doc->getNeck());
  print($doc->toHeader());

  print("<section><h2>Enter Post</h2>\n");
  printf("<p>\n<b>User:</b> %s\n<b>Date:</b> %s replies to:\n</p>"
      , $_SESSION[$loginToken]
      , $today);
  include "./blogPostSelect.inc.php";
  include "./blogPostForm.inc.php";
  print("</section>\n");
  print($doc->toFooter().$doc->getFoot());
?>