<?php

namespace argofire;

	require dirname(__FILE__) . '/lib/global.lib.php';

    class Config {
        private static $argofireConfig = null;

        function __construct($baseConfigDir = '') {
            # Load Zend AutoLoader Object
                require_once 'Zend/Loader/Autoloader.php';
                    \Zend_Loader_Autoloader::getInstance();

            if (!self::$argofireConfig = new \Zend_Config_Ini("{$baseConfigDir}argofire.config.ini")) {
                // Error
                echo "Error Loading ArgoFire Config";
                die();
            }
        }

        static public function getConfigOption($option = null) {
            if ($option && self::$argofireConfig->argofire->{$option})
                return self::$argofireConfig->argofire->{$option};
            else return false;
        }
    }