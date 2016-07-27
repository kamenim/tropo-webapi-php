<?php
    /**
     * This file contains PHP classes that can be used to interact with the Tropo WebAPI/
     *
     * @see       https://www.tropo.com/docs/webapi/
     *
     * @copyright 2010 Mark J. Headd (http://www.voiceingov.org)
     * @package   TropoPHP
     * @author    Mark Headd
     * @author    Adam Kalsey
     */
    namespace Tropo\Action;

    /**
     * Allows Tropo applications to begin recording the current session.
     * The resulting recording may then be sent via FTP or an HTTP POST/Multipart Form.
     *
     * @package TropoPHP_Support
     *
     */
    class StartRecording extends BaseClass {

        private $_format;
        private $_method;
        private $_password;
        private $_url;
        private $_username;
        private $_transcriptionID;
        private $_transcriptionEmailFormat;
        private $_transcriptionOutURI;

        /**
         * Class constructor
         *
         * @param string $format
         * @param string $method
         * @param string $password
         * @param string $url
         * @param string $username
         * @param string $transcriptionID
         * @param string $transcriptionEmailFormat
         * @param string $transcriptionOutURI
         */
        public function __construct ($format = null, $method = null, $password = null, $url = null, $username = null, $transcriptionID = null, $transcriptionEmailFormat = null, $transcriptionOutURI = null) {
            $this->_format                   = $format;
            $this->_method                   = $method;
            $this->_password                 = $password;
            $this->_url                      = $url;
            $this->_username                 = $username;
            $this->_transcriptionID          = $transcriptionID;
            $this->_transcriptionEmailFormat = $transcriptionEmailFormat;
            $this->_transcriptionOutURI      = $transcriptionOutURI;
        }

        /**
         * Renders object in JSON format.
         *
         */
        public function __toString () {
            if (isset($this->_format)) {
                $this->format = $this->_format;
            }
            if (isset($this->_method)) {
                $this->method = $this->_method;
            }
            if (isset($this->_password)) {
                $this->password = $this->_password;
            }
            if (isset($this->_url)) {
                $this->url = $this->_url;
            }
            if (isset($this->_username)) {
                $this->username = $this->_username;
            }
            if (isset($this->_transcriptionID)) {
                $this->transcriptionID = $this->_transcriptionID;
            }
            if (isset($this->_transcriptionEmailFormat)) {
                $this->transcriptionEmailFormat = $this->_transcriptionEmailFormat;
            }
            if (isset($this->_transcriptionOutURI)) {
                $this->transcriptionOutURI = $this->_transcriptionOutURI;
            }

            return $this->unescapeJSON(json_encode($this));
        }
    }
