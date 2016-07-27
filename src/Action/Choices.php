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
     * Defines the input to be collected from the user.
     *
     * @property null|string value
     * @property null|string mode
     * @property null|string terminator
     *
     * @package TropoPHP_Support
     */
    class Choices extends BaseClass {

        private $_mode;
        private $_terminator;
        private $_value;

        /**
         * Class constructor
         *
         * @param string $value
         * @param string $mode
         * @param string $terminator
         */
        public function __construct ($value = null, $mode = null, $terminator = null) {
            $this->_value      = $value;
            $this->_mode       = $mode;
            $this->_terminator = $terminator;
        }

        /**
         * Renders object in JSON format.
         *
         */
        public function __toString () {
            if (isset($this->_value)) {
                $this->value = $this->_value;
            }
            if (isset($this->_mode)) {
                $this->mode = $this->_mode;
            }
            if (isset($this->_terminator)) {
                $this->terminator = $this->_terminator;
            }

            return $this->unescapeJSON(json_encode($this));
        }
    }
