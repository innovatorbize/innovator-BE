<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cors {
    public function __construct() {
        $this->CI =& get_instance();
    }

    public function enable() {
        $allowedOrigins = array(
            'http://localhost:4200', // Angular development server
            // Add more allowed origins if necessary
        );

        if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins)) {
            header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
            header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
            header("Access-Control-Allow-Credentials: true");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit; // Exit early if it's an OPTIONS request
        }
    }
}
