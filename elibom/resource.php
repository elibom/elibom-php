<?php

    class Resource {

        protected $user;
        protected $token;

        public function __construct($u, $t) {
            $this->user = $u;
            $this->token = $t;
        }
    }
?>