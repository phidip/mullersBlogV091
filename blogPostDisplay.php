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
  print($doc->getNeck());
  print($doc->toHeader());

  include "blogPostSelect.inc.php";
  $qs = sprintf("./blogPostReply.php?au=%s&amp;cl=%s", $_GET['au'], $_GET['cl']);
?>
    <nav>
      <ul>
        <li>
<?php           
        printf("<a href='%s'>Reply</a>", $qs);
?>
        </li>
        <li>
          <a href="./blogIndex.php">Back to Menu</a>
        </li>
      </ul>
    </nav>  
<?php
  print("</section>\n");
  print($doc->toFooter().$doc->getFoot());
?>
