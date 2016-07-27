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
     * Sends a prompt to the user and optionally waits for a response.
     *
     * @package TropoPHP_Support
     *
     */
    class Ask extends BaseClass {

        private $_allowSignals;
        private $_attempts;
        private $_bargein;
        private $_choices;
        private $_interdigitTimeout;
        private $_minConfidence;
        private $_name;
        private $_recognizer;
        private $_required;
        private $_say;
        private $_sensitivity;
        private $_speechCompleteTimeout;
        private $_speechIncompleteTimeout;
        private $_timeout;
        private $_voice;

        /**
         * Class constructor
         *
         * @param int          $attempts
         * @param boolean      $bargein
         * @param Choices      $choices
         * @param float        $minConfidence
         * @param string       $name
         * @param boolean      $required
         * @param Say          $say
         * @param int          $timeout
         * @param string       $voice
         * @param string|array $allowSignals
         * @param integer      $interdigitTimeout
         * @param integer      $sensitivity
         * @param float        $speechCompleteTimeout
         * @param float        $speechIncompleteTimeout
         */
        public function __construct ($attempts = null, $bargein = null, Choices $choices = null, $minConfidence = null, $name = null, $required = null, $say = null, $timeout = null, $voice = null, $allowSignals = null, $recognizer = null, $interdigitTimeout = null, $sensitivity = null, $speechCompleteTimeout = null, $speechIncompleteTimeout = null) {
            $this->_attempts                = $attempts;
            $this->_bargein                 = $bargein;
            $this->_choices                 = isset($choices) ? sprintf('%s', $choices) : null;
            $this->_minConfidence           = $minConfidence;
            $this->_name                    = $name;
            $this->_required                = $required;
            $this->_say                     = isset($say) ? $say : null;
            $this->_timeout                 = $timeout;
            $this->_voice                   = $voice;
            $this->_allowSignals            = $allowSignals;
            $this->_recognizer              = $recognizer;
            $this->_interdigitTimeout       = $interdigitTimeout;
            $this->_sensitivity             = $sensitivity;
            $this->_speechCompleteTimeout   = $speechCompleteTimeout;
            $this->_speechIncompleteTimeout = $speechIncompleteTimeout;
        }

        /**
         * Renders object in JSON format.
         *
         */
        public function __toString () {
            if (isset($this->_attempts)) {
                $this->attempts = $this->_attempts;
            }
            if (isset($this->_bargein)) {
                $this->bargein = $this->_bargein;
            }
            if (isset($this->_choices)) {
                $this->choices = $this->_choices;
            }
            if (isset($this->_minConfidence)) {
                $this->minConfidence = $this->_minConfidence;
            }
            if (isset($this->_name)) {
                $this->name = $this->_name;
            }
            if (isset($this->_required)) {
                $this->required = $this->_required;
            }
            if (isset($this->_say)) {
                $this->say = $this->_say;
            }
            if (is_array($this->_say)) {
                foreach ($this->_say as $k => $v) {
                    $this->_say[$k] = sprintf('%s', $v);
                }
            }
            if (isset($this->_timeout)) {
                $this->timeout = $this->_timeout;
            }
            if (isset($this->_voice)) {
                $this->voice = $this->_voice;
            }
            if (isset($this->_allowSignals)) {
                $this->allowSignals = $this->_allowSignals;
            }
            if (isset($this->_recognizer)) {
                $this->recognizer = $this->_recognizer;
            }
            if (isset($this->_interdigitTimeout)) {
                $this->interdigitTimeout = $this->_interdigitTimeout;
            }
            if (isset($this->_sensitivity)) {
                $this->sensitivity = $this->_sensitivity;
            }
            if (isset($this->_speechCompleteTimeout)) {
                $this->speechCompleteTimeout = $this->_speechCompleteTimeout;
            }
            if (isset($this->_speechIncompleteTimeout)) {
                $this->speechIncompleteTimeout = $this->_speechIncompleteTimeout;
            }

            return $this->unescapeJSON(json_encode($this));
        }

        /**
         * Adds an additional Say to the Ask
         *
         * Used to add events such as a prompt to say on timeout or nomatch
         *
         * @param Say $say A say object
         */
        public function addEvent (Say $say) {
            $this->_say[] = $say;
        }
    }
