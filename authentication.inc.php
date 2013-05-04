<?php
   function checkUser($user, $pwd, $db) {
      $sql = "select alias, salt, pwd";
      $sql .= " from shadow";
      $sql .= " where alias = '" . $user . "';";
      $db->query($sql);
      $out = $db->fetch_object();
      if ($out->pwd == hash("sha512", $pwd . $out->salt)) {
         $_SESSION['blogUser'] = $out->alias;
      } else {
         throw new Exception("1");
      }
   }
            
   function authenticate($user, $pwd, $return, $db) {
      try {
         checkUser($user, $pwd, $db);
      }
      catch (Exception $e) {
         $return .= "?errorcode=" . $e->getMessage();
         header("Location: " . $return); 
      }
   }
?>
