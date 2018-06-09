<?php

    class generateJSON {
        private $_db,
            $jsonContent;

        public function __construct() {
            $this->_db = DB::getInstance();
        }

        public function generateFile() {
            $this->jsonContent = $this->_db->simpleQuery('SELECT * from `users`');

            // header('Content-disposition: attachment; filename=raport.json');
            // header('Content-type: application/json');

            // var_dump($this->jsonContent);
            foreach ($this->jsonContent as $row) {
                echo $row['id'] . ' | ' . $row['username'];
                // var_dump($row);
                echo '<br>';
            };
        }
    }

?>