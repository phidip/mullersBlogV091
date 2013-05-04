<?php
  session_start();
  require_once('DbH.inc.php');
  $dbh = new DbH("mullersBlog");
  require_once("authentication.inc.php");
  require_once('HTML5.inc.php');

  $doc = new HTML5("Muller&apos;s Blog", "en");
  print($doc->getTop());
  print($doc->prtLink("./ass1M1.css"));

  /* 
    if not logged in
     and if yes to data from form
     then authenticate
   */
  if (!isset($_SESSION['blogUser'])) {
    if (isset($_POST['userid']) && isset($_POST['pwd'])) {
      authenticate($_POST['userid'], $_POST['pwd'], '#', $dbh);
    }
  }
  
  print($doc->getNeck());
  printf("<header><h1>%s</h1></header>", $doc->getTitle());
  include "blogNav.inc.php";   // navigation menu
  print("<section id='login'>\n");

  /*
    if error
    or if not logged in
   */
  if ( isset($_GET['errorcode'])
        || !isset($_SESSION['blogUser'])) {

  print("<p class='colred'>Først login!</p>\n");
  printf("<form action='https://localhost%s' 
                method='post'
                id='formLogin'>\n", $_SERVER['PHP_SELF']);
?>
    <ul>
      <li>
        <input type='text' name='userid' size='15' /> User id
      </li>
      <li>
        <input type='password' name='pwd' size='15' /> Pwd
      </li>
      <li>
        <button class="colred" type="submit">Login</button>
      </li>
    </ul>
  </form>
<?php
  } else {
?>
  <p>
    <button class="colgron"
      onclick="window.location='./blogLogout.php'">
      Logout
    </button>
  </p>
<?php
  }
  print("</section>\n");
  print($doc->getFoot());
?>