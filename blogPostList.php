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
  print("<section>\n");

    $sql = sprintf("select author, clocked, subject 
                   from post 
                   order by clocked desc;");
    if (isset($_GET['t'])) {
      $sql = sprintf("select post.author, post.clocked, post.subject, post.content
                      from post left join thread 
                      on thread.author = post.author 
                      and thread.clocked = post.clocked 
                      order by post.subject, post.clocked;");
    }
    $dbh->query($sql);
    print("<table>");
    $caption = "Most Recent Posts";
    if (isset($_GET['t'])) {
      $caption = "Threads";
    }
    printf("<caption>%s</caption>", $caption);
    while ($post = $dbh->fetch_array()) {
      printf("<tr>
              <td>%s</td>
              <td>%s</td>
              <td><a href='./blogPostDisplay.php?au=%s&amp;cl=%s'>%s</a></td>
              </tr>\n"
              , $post['author']
              , $post['clocked']
              , $post['author']
              , $post['clocked']
              , $post['subject']);
    }
    print("</table>");            
?>
    <nav>
      <ul>
        <li>
          <a href="./blogIndex.php">Go Back to the Menu</a>
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