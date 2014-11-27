<?php


require_once(LIB_PATH . "propel/runtime/lib/Propel.php");

function airtimeCheckDependencies() {
    $deps = array();
    $deps["zend"] = file_exists('/usr/share/php/libzend-framework-php');

    return $deps;
}

/**
 * Check that the database exists and is configured correctly
 *
 * @return boolean true if the database exists and is configured correctly, false otherwise
 */
function airtimeCheckDatabase() {
    if (!file_exists(BUILD_PATH . AIRTIME_CONFIG)) {
        return false;
    }

    $config = parse_ini_file(BUILD_PATH . AIRTIME_CONFIG, true);

    try {
        Propel::getConnection($config["database"]["dbname"]);
    } catch (Exception $e) {
        return false;
    }

    return true;
}

function airtimeConfigureDatabase() {

    Propel::init(APPLICATION_PATH . "/configs/airtime-conf-production.php");

}