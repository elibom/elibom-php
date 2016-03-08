<?php

    class Scheduler extends Resource{

        public function schedule($to, $txt, $date, $campaign = null) {
            $client = new Client($this->user, $this->token);
            $data = array("destinations" => $to, "text" => $txt, "scheduleDate" => $date);
            if (isset($campaign)) {
                $data['campaign'] = $campaign;
            }
            $response = $client->post('messages', $data);

            return $response->scheduleId;
        }

        public function get($id) {
            $client = new Client($this->user, $this->token);
            $response = $client->get('schedules/' . $id);

            return $response;
        }

        public function getAll() {
            $client = new Client($this->user, $this->token);
            $response = $client->get('schedules/scheduled');

            return $response;
        }

        public function unschedule($id) {
            $client = new Client($this->user, $this->token);
            $client->delete('schedules/' . $id);
        }
    }
?>