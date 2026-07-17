<?php
if(!class_exists('Elanding')){
    class Elanding {
        public function __construct() {
            $this->init_run();
        }
    
        public function init_run() {
            if ( class_exists( 'ChengChivas\\ElandingInit' ) ) {
                ChengChivas\ElandingInit::st_services();
            }
        }
    }
}
?>