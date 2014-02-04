<?php

    class Client extends Resource {

        private $url = 'https://www.elibom.com/';

        public function post($resource, $data) {
            $data_string = json_encode($data);

            $handler = curl_init($this->url . $resource);

            curl_setopt($handler, CURLOPT_POST, true);
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, true); 

            $this->configureHeaders($handler, $data_string);

            curl_setopt($handler, CURLOPT_POSTFIELDS, $data_string);

            $response = curl_exec ($handler);
            $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);
            if ($code != 200) {
                $errorMessage = $this->getErrorMessage($code, $resource);
                throw new Exception($errorMessage);
            }

            return json_decode($response);
        }

        public function get($resource, $data = '{}') {
            $data_string = json_encode($data);

            $handler = curl_init($this->url . $resource);

            //curl_setopt($handler, CURLOPT_GET, true);
            curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, true); 

            $this->configureHeaders($handler, $data_string);

            curl_setopt($handler, CURLOPT_POSTFIELDS, $data_string);

            $response = curl_exec ($handler);
            $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);
            if ($code != 200) {
                $errorMessage = $this->getErrorMessage($code, $resource);
                throw new Exception($errorMessage);
            }

            return json_decode($response);
        }

        public function delete($resource, $data = '{}') {
            $data_string = json_encode($data);

            $handler = curl_init($this->url . $resource);

            curl_setopt($handler, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, true); 

            $this->configureHeaders($handler, $data_string);

            curl_setopt($handler, CURLOPT_POSTFIELDS, $data_string);

            $response = curl_exec ($handler);
            $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);
            if ($code != 200) {
                $errorMessage = $this->getErrorMessage($code, $resource);
                throw new Exception($errorMessage);
            }

            return json_decode($response);
        }

        private function configureHeaders($handler, $data_string) {
            $auth_string = $this->user .":" . $this->token;
            $auth = base64_encode ($auth_string);
            curl_setopt($handler, CURLOPT_HTTPHEADER, array(
                'Authorization: Basic ' . $auth,
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
                )
            );
        }

        private function getErrorMessage($code, $resource) {
            switch($code) {
                case 0 : {
                    return 'Server not found, check your internet connection or proxy configuration.';
                }
                case 401 : {
                    return 'Unauthorized resource [' . $resource . ']. Check your user credentials';
                }
                default : {
                    return 'Unexpected error [' . $resource . '] [code=' . $code . ']';
                }
            }
        }
    }

?>