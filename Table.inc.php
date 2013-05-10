<?php
    class Table {
        protected $headers;
        protected $rows = array();

        public function __construct($headers) {
            $this->headers = $headers;
            $this->rows = array();
        }

        public function addRow($row) {
            if (count($row) != count($this->headers)) {
                die ("Wrong column count ".count($row).":".count($this->headers));
            }
            array_push($this->rows, $row);
            return true;
        }

        /*
         * display the table
         * consider possibility of parm for style
         */
        public function displayTable($caption) {
            print("<table>\n");
            if (isset($caption)) {
                printf("<caption>%s</caption>\n", $caption);
            }
            print("<tr>\n");
            foreach ($this->headers as $col) {
                printf("<th>%s</th>\n", $col);
            }
            print("</tr>\n");

            foreach ($this->rows as $row) {
                print("<tr>\n");
                foreach ($row as $col) {
                    printf("<td>%s</td>\n", $col);
                }
                print("</tr>\n");
            }
            print("</table>\n");
        }
    }
?>