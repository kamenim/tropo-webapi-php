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
     * When the current session is a voice channel this key will either play a message or an audio file from a URL.
     * In the case of an text channel it will send the text back to the user via instant messaging or SMS.
     *
     * @property null|string       event
     * @property string            value
     * @property null|string       as
     * @property null|string       voice
     * @property null|string|array allowSignals
     *
     * @package Tropo\Action
     *
     */
    class Say extends BaseClass {

        /** @var null|string|array */
        private $_allowSignals;
        /** @var null|string */
        private $_as;
        /** @var null|string */
        private $_event;
        /** @var string */
        private $_value;
        /** @var null|string */
        private $_voice;

        /**
         * Say constructor.
         *
         * @param string            $value
         * @param null|string       $as
         * @param null|string       $event
         * @param null|string       $voice
         * @param null|string|array $allowSignals
         */
        public function __construct ($value, $as = null, $event = null, $voice = null, $allowSignals = null) {
            $this->_value        = $value;
            $this->_as           = $as;
            $this->_event        = $event;
            $this->_voice        = $voice;
            $this->_allowSignals = $allowSignals;
        }

        /**
         * Renders object in JSON format.
         *
         * @return string
         */
        public function __toString () {
            $this->value = $this->_value;
            if (isset($this->_as)) {
                $this->as = $this->_as;
            }
            if (isset($this->_event)) {
                $this->event = $this->_event;
            }
            if (isset($this->_voice)) {
                $this->voice = $this->_voice;
            }
            if (isset($this->_allowSignals)) {
                $this->allowSignals = $this->_allowSignals;
            }

            return $this->unescapeJSON(json_encode($this));
        }
    }
