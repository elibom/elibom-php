<?php

    class Message extends Resource {

        public function send($to, $txt) {
            $client = new Client($this->user, $this->token);
            $data = array("destinations" => $to, "text" => $txt);
            $response = $client->post('messages', $data);

            return $response->deliveryToken;
        }
    }
?>