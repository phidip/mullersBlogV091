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
  </section>

  <footer>
      <p><?php print($copy);?></p>
  </footer>
<?php
    print($doc->getFoot());
?>