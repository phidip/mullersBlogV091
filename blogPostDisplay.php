<?php
  session_start();
  require_once('blogParams.inc.php');
  require_once('DbH.inc.php');
  require_once('Authentication.inc.php');
  require_once('authenticator.inc.php');
  require_once('Table.inc.php');
  require_once('Tablee.inc.php');
  require_once('HTML5.inc.php');
  require_once('HTML5e.inc.php');

  $dbh = new DbH($db);
  $auth = new Authenticator($dbh, $root, $loginToken);
  $auth->isLoggedIn(); //check login - new way
  $doc = new HTML5e("Umlaute");
  
  print($doc->getTop());
  print($doc->toLink("./blog1.css"));
  print($doc->toLink("./blog2.css"));
  print($doc->getNeck());
  print($doc->toHeader());

  include "blogPostSelect.inc.php";
  $qs = sprintf("./blogPostReply.php?au=%s&amp;cl=%s", $_GET['au'], $_GET['cl']);
         
  print("<nav>\n<ul>\n");
  printf("<li><a href='%s'>Reply</a></li>", $qs);
  printf("<li><a href='%s'>Back to Menu</a></li>", $root);
  print("</ul>\n</nav>\n");

  print("</section>\n");
  print($doc->toFooter().$doc->getFoot());
?>
