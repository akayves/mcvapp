<?php 
    /**
     * cette class va nous permettre de configurer nos routes et les récupérer
     * après sur la page index.php
     */
    namespace Router;
    
     class Router {
        public $url;

        public function __construct($url) {
            $this->url = $url;
        }

        /**
         * cette methode permet d'afficher nos url
         */
        public function show() {
            echo $this->url;
        }
     }