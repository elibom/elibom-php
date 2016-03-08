<?php

    class Message extends Resource {

        public function send($to, $txt, $campaign = null) {
            $client = new Client($this->user, $this->token);
            $data = array("destinations" => $to, "text" => $txt);
            if (isset($campaign)) {
                $data['campaign'] = $campaign;
            }

            $response = $client->post('messages', $data);

            return $response->deliveryToken;
        }
    }
?>