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

  print("<section><h2>Upload an Image</h2>\n");
  printf("<p>\n<b>User:</b> %s\n<b>Date:</b> %s\n</p>"
        , $_SESSION['blogUser']
        , $today);
?>
    <form action="./blogImagePostDb.php" 
          enctype="multipart/form-data"
          method="post">
      <p>
        <label for="img">Image:</label>
        <br/>
        <input type="file" name="image" id="img"/>
        <input name="MAX_FILE_SIZE" value="65535" type="hidden"/>
      </p>
      <p>
        <label for="alt">Alternate Text:</label>
        <br/>
        <input type="text" name="alttext" id="alt"
           size="64" maxlength="96"/>
      </p>
      <p>
        <label for="cap">Caption:</label>
        <br/>
        <input type="text" name="caption" id="cap"
           size="64" maxlength="96"/>
      </p>
      <p>
        <label for="avaj">Avatar:</label>
        <input type="radio" name="avatar" id="avaj"/>
        <label for="avan">Not Avatar:</label>
        <input type="radio" name="avatar" id="avan" checked/>
      </p>
      <p>
        <label for="copy">Copyright:</label>
        <input type="radio" name="copyright" id="copy" checked/>
        <label for="nocopy">Not Copyright:</label>
        <input type="radio" name="copyright" id="nocopy"/>
      </p>
      <p>
        <input type="submit" value="Post"/>
      </p>
    </form>
  </section>
<?php
  printf("</section><footer><p>%s</p></footer>\n", $copy);
  print($doc->getFoot());
?>