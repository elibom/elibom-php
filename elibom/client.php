<?php

    class Client extends Resource {

        private $url = 'https://www.elibom.com/';

        private $version = 'php-1.0.6';

        public function post($resource, $data) {
            $data_string = json_encode($data);

            $handler = curl_init($this->url . $resource);

            curl_setopt($handler, CURLOPT_POST, true);
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);

            $this->configureHeaders($handler, $data_string);

            curl_setopt($handler, CURLOPT_POSTFIELDS, $data_string);

            $response = curl_exec ($handler);
            $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);
            if ($code != 200) {
                $errorMessage = $this->getErrorMessage($handler, $resource);
                throw new Exception($errorMessage);
            }

            return json_decode(utf8_encode($response));
        }

        public function get($resource, $data = '{}') {
            $data_string = json_encode($data);

            $handler = curl_init($this->url . $resource);

            //curl_setopt($handler, CURLOPT_GET, true);
            curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);

            $this->configureHeaders($handler, $data_string);

            curl_setopt($handler, CURLOPT_POSTFIELDS, $data_string);

            $response = curl_exec ($handler);
            $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);
            if ($code != 200) {
                $errorMessage = $this->getErrorMessage($handler, $resource);
                throw new Exception($errorMessage);
            }

            return json_decode(utf8_encode($response));
        }

        public function delete($resource, $data = '{}') {
            $data_string = json_encode($data);

            $handler = curl_init($this->url . $resource);

            curl_setopt($handler, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);

            $this->configureHeaders($handler, $data_string);

            curl_setopt($handler, CURLOPT_POSTFIELDS, $data_string);

            $response = curl_exec ($handler);
            $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);
            if ($code != 200) {
                $errorMessage = $this->getErrorMessage($handler, $resource);
                throw new Exception($errorMessage);
            }

            return json_decode(utf8_encode($response));
        }

        private function configureHeaders($handler, $data_string) {
            $auth_string = $this->user .":" . $this->token;
            $auth = base64_encode ($auth_string);
            curl_setopt($handler, CURLOPT_HTTPHEADER, array(
                'Authorization: Basic ' . $auth,
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'X-API-Source: ' . $this->version
                )
            );
        }

        private function getErrorMessage($handler, $resource) {
            $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);
            $error_description = curl_error($handler);
            switch($code) {
                case 0 : {
                    return 'Server not found, check your internet connection or proxy configuration. [' . $error_description . ']';
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