<?php
  session_start();
  if (!isset($_SESSION['blogUser'])) {  // am I logged on?
    header("Location: ./blogIndex.php?errorcode=2");
  }                                 // if not, go and do it!

  $copy = "&copy; NML, 2013";
  $title = "Muller&apos;s Blog";
  $db = "mullersBlog";
  $today = strftime("%F", time());

  require_once('DbH.inc.php');
  $dbh = new DbH($db);
  require_once('HTML5.inc.php');
  $doc = new HTML5($title, "en");

  print($doc->getTop());
  $doc->prtLink("./ass1M1.css");
  $doc->prtScript("./forumjslib.js");
  print($doc->getNeck());
  $doc->prtHeader("blogIndex.php");

  print("<section><h2>Enter Post</h2>\n");
  printf("<p>\n<b>User:</b> %s\n<b>Date:</b> %s replies to:\n</p>"
      , $_SESSION['blogUser']
      , $today);
  include "./blogPostSelect.inc.php";
  include "./blogPostForm.inc.php";
  printf("</section><footer><p>%s</p></footer>\n", $copy);
  print($doc->getFoot());
?>