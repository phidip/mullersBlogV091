<?php
class Authenticator implements Authentication {
   protected $db;
   protected $loginProgram;
   protected $loginToken;

   public function __construct($db, $lP, $lT) {
      $this->db = $db;
      $this->loginProgram = $lP;
      $this->loginToken = $lT;
   }
   private function checkUser($user, $pwd) {
      $sql = "select alias, salt, pwd";
      $sql .= " from shadow";
      $sql .= " where alias = '" . $user . "';";
      $this->db->query($sql);
      $out = $this->db->fetch_object();
      if ($out->pwd == hash("sha512", $pwd . $out->salt)) {
         $_SESSION[$this->loginToken] = $out->alias;
      } else {
         throw new Exception("1");
      }
   }

   public function authenticate($user, $pwd) {
      try {
         $this->checkUser($user, $pwd);
      }
      catch (Exception $e) {
         $return = $this->loginProgram . "?errorcode=" . $e->getMessage();
         header("Location: " . $return); 
      }
   }

   public function isLoggedIn() {
      if (!isset($_SESSION[$this->loginToken])) {
         header("Location: ".$this->loginProgram."?errorcode=2");
      } else {
         return true;
      }
   }
}
?>