<?php
    class TableE extends Table {
        public function __construct($headers) {
            parent::__construct($headers);
        }
        /*
         * display the table
         * special case override
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
                printf("<td><a href='./blogPostDisplay.php?au=%s&amp;cl=%s'>%s</a></td>
                    <td>%s</td>
                    <td>%s</td>\n"
                           , $row['author']
                           , $row['clocked']
                           , $row['author']
                           , $row['clocked']
                           , $row['subject']);
                print("</tr>\n");
            }
            print("</table>\n");
        }
    }
?>