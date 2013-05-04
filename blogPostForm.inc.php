    <form action="./blogPostDb.php" 
          method="post" 
          onsubmit="return validate();">
    <p>
      <label for="sub">Subject:</label>
      <br/>
<?php
      $val = "";
      if (isset($post['subject'])) {
        $val = sprintf("value='%s' readonly", $post['subject']);
      }
      printf("<input type='text' 
                     name='subject' 
                     id='sub' 
                     size='60' 
                     %s/>\n"
             , $val);
?>
    </p>
    <p>
      <label for="cont">Content:</label>
      <br/>
      <textarea cols="60" 
                rows="12" 
                name="content" 
                id="cont"></textarea>
    </p>
    <p>
      <label for="tag">Tags:</label>
      <br/>
      <input type="text" name="tags[]" id="tag"/>&nbsp;
      <input type="text" name="tags[]" id="tag"/>&nbsp;
      <input type="text" name="tags[]" id="tag"/>&nbsp;
      <input type="text" name="tags[]" id="tag"/>
    </p>
    <p>
      <input type="submit" value="Post"/>
    </p>
    </form>
