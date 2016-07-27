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
     * Transcribes spoken text.
     *
     * @package TropoPHP_Support
     *
     */
    class Transcription extends BaseClass {

        private $_url;
        private $_id;
        private $_emailFormat;

        /**
         * Class constructor
         *
         * @param string $url
         * @param string $id
         * @param string $emailFormat
         */
        public function __construct ($url, $id = null, $emailFormat = null) {
            $this->_url         = $url;
            $this->_id          = $id;
            $this->_emailFormat = $emailFormat;
        }

        /**
         * Renders object in JSON format.
         *
         */
        public function __toString () {
            if (isset($this->_id)) {
                $this->id = $this->_id;
            }
            if (isset($this->_url)) {
                $this->url = $this->_url;
            }
            if (isset($this->_emailFormat)) {
                $this->emailFormat = $this->_emailFormat;
            }

            return $this->unescapeJSON(json_encode($this));
        }
    }
