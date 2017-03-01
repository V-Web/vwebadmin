<?php

/**
 * @author    Phil Taylor <phil@phil-taylor.com>
 * @copyright Copyright (C) 2011, 2012, 2013, 2014, 2015 Blue Flame IT Ltd. All rights reserved.
 * @license   Commercial License - Not to be distributed!
 * @link      https://manage.myjoomla.com
 * @source    https://github.com/PhilETaylor/bfnetwork
 *
 */

/**
 * If we have got here then we have already passed through decrypting
 * the encrypted header and so we are sure we are now secure and no one
 * else cannot run the code below.
 */
final class bfPreferences
{
    /**
     * @var array
     */
    public $default_alerting_filewatchlist = array(
        '/includes/defines.php',
        '/includes/framework.php',
        '/configuration.php'
    );

    /**
     * @var string
     */
    private $dieStatement = "<?php\nheader('HTTP/1.0 404 Not Found');\ndie();\n?>\n";

    /**
     * Incoming decrypted vars from the request
     * @var stdClass
     */
    private $_dataObj;

    /**
     * @var string
     */
    private $_configFile;

    /**
     * @var mixed|stdClass
     */
    private $prefs;

    /**
     * PHP 5 Constructor,
     * I inject the request to the object
     *
     * @param stdClass $dataObj
     */
    public function __construct($dataObj = NULL)
    {
        $this->_configFile = dirname(__FILE__) . '/tmp/bfLocalConfig.php';

        // Set the request vars
        $this->_dataObj = $dataObj;

        $this->prefs = $this->getPreferences();

    }

    public function getPreferences()
    {
        $this->ensurePrefsFileCreated();

        $prefs = file_get_contents($this->_configFile);
        $prefs = trim(str_replace($this->dieStatement, '', $prefs));

        if (trim($prefs)) {
            $data = json_decode($prefs);
        } else {
            $data = new stdClass();
        }

        if (!is_object($data)) {
            $data = new stdClass();
        }

        if (!property_exists($data, '_BF_LOG')) {
            $data->_BF_LOG = FALSE;
        }

        $this->prefs = $data;

        return $this->prefs;
    }

    public function ensurePrefsFileCreated()
    {
        if (!file_exists($this->_configFile)) {
            $this->prefs = new stdClass();
            $this->prefs->_BF_LOG = FALSE;
            $this->writeFile();
        }
    }

    public function writeFile()
    {
        file_put_contents($this->_configFile, $this->dieStatement);
        file_put_contents($this->_configFile, json_encode($this->prefs), FILE_APPEND);
    }

    /**
     * I'm the controller - I run methods based on the request integer
     */
    public function run($action)
    {
        return $this->$action();
    }

    public function savePreferencesFromService()
    {
        $this->prefs = json_decode($this->_dataObj->preferences);
        $this->writeFile();

    }

    public function savePreference()
    {
        $preference = $this->_dataObj->preference;
        $value = $this->_dataObj->value;

        $this->prefs->$preference = $value;

        $this->writeFile();
    }
}