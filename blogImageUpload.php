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
  print($doc->toScript("./blogJsLib.js"));
  print($doc->getNeck());
  print($doc->toHeader());

  print("<section><h2>Upload an Image</h2>\n");
  printf("<p>\n<b>User:</b> %s\n<b>Date:</b> %s\n</p>"
        , $_SESSION[$loginToken]
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
  print("</section>\n");
  print($doc->toFooter().$doc->getFoot());
?>