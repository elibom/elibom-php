<?php

    class Account extends Resource{

        public function get() {
            $client = new Client($this->user, $this->token);
            $response = $client->get('account');

            return $response;
        }
    }
?>