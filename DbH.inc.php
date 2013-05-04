<?php
class DbH extends mysqli {
    private $connection;
    private $result;

    public function __construct($db, 
                         $host='localhost', 
                         $user='nobody', 
                         $pwd='test') {
        parent::__construct($host, $user, $pwd, $db);
        if ($this->connect_error) {
            die('Connect Error (' . $this->connect_errno . ') '
            . $this->connect_error);
        }
    }

    public function close() {
        $this->close();
    }

    function query($declaration) {
        try {
            if (! $this->result = parent::query($declaration)) {
                $s = sprintf("Query error: %s: %s<br/>%s"
                             , $this->errno, $this->error, $declaration);
                throw new Exception($s);
            }
        }
        catch (Exception $e) {
            die($e->getMessage());
        }
        return $this->result;
    }
    
    function fetch_array() {
        return $rowArray = $this->result->fetch_array();
    }
    
    function fetch_object() {
        return $rowObject = $this->result->fetch_object();
    }

}
?>