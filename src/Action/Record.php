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
     * Plays a prompt (audio file or text to speech) and optionally waits for a response from the caller that is recorded.
     *
     * @package TropoPHP_Support
     *
     */
    class Record extends BaseClass {

        private $_allowSignals;
        private $_attempts;
        private $_bargein;
        private $_beep;
        private $_choices;
        private $_format;
        private $_interdigitTimeout;
        private $_maxSilence;
        private $_maxTime;
        private $_method;
        private $_minConfidence;
        private $_password;
        private $_required;
        private $_say;
        private $_timeout;
        private $_transcription;
        private $_url;
        private $_username;
        private $_voice;

        /**
         * Class constructor
         *
         * @param int                   $attempts
         * @param string|array          $allowSignals
         * @param boolean               $bargein
         * @param boolean               $beep
         * @param \Tropo\Action\Choices $choices
         * @param string                $format
         * @param int                   $maxSilence
         * @param string                $method
         * @param string                $password
         * @param boolean               $required
         * @param Say                   $say
         * @param int                   $timeout
         * @param string                $username
         * @param string                $url
         * @param string                $voice
         * @param int                   $minConfidence
         * @param int                   $interdigitTimeout
         */
        public function __construct ($attempts = null, $allowSignals = null, $bargein = null, $beep = null, \Tropo\Action\Choices $choices = null, $format = null, $maxSilence = null, $maxTime = null, $method = null, $password = null, $required = null, $say = null, $timeout = null, Transcription $transcription = null, $username = null, $url = null, $voice = null, $minConfidence = null, $interdigitTimeout = null) {
            $this->_attempts     = $attempts;
            $this->_allowSignals = $allowSignals;
            $this->_bargein      = $bargein;
            $this->_beep         = $beep;
            $this->_choices      = isset($choices) ? sprintf('%s', $choices) : null;
            $this->_format       = $format;
            $this->_maxSilence   = $maxSilence;
            $this->_maxTime      = $maxTime;
            $this->_method       = $method;
            $this->_password     = $password;
            if (!is_object($say)) {
                $say = new Say($say);
            }
            $this->_say               = isset($say) ? sprintf('%s', $say) : null;
            $this->_timeout           = $timeout;
            $this->_transcription     = isset($transcription) ? sprintf('%s', $transcription) : null;
            $this->_username          = $username;
            $this->_url               = $url;
            $this->_voice             = $voice;
            $this->_minConfidence     = $minConfidence;
            $this->_interdigitTimeout = $interdigitTimeout;
        }

        /**
         * Renders object in JSON format.
         *
         */
        public function __toString () {
            if (isset($this->_attempts)) {
                $this->attempts = $this->_attempts;
            }
            if (isset($this->_allowSignals)) {
                $this->allowSignals = $this->_allowSignals;
            }
            if (isset($this->_bargein)) {
                $this->bargein = $this->_bargein;
            }
            if (isset($this->_beep)) {
                $this->beep = $this->_beep;
            }
            if (isset($this->_choices)) {
                $this->choices = $this->_choices;
            }
            if (isset($this->_format)) {
                $this->format = $this->_format;
            }
            if (isset($this->_maxSilence)) {
                $this->maxSilence = $this->_maxSilence;
            }
            if (isset($this->_maxTime)) {
                $this->maxTime = $this->_maxTime;
            }
            if (isset($this->_method)) {
                $this->method = $this->_method;
            }
            if (isset($this->_password)) {
                $this->password = $this->_password;
            }
            if (isset($this->_say)) {
                $this->say = $this->_say;
            }
            if (isset($this->_timeout)) {
                $this->timeout = $this->_timeout;
            }
            if (isset($this->_transcription)) {
                $this->transcription = $this->_transcription;
            }
            if (isset($this->_username)) {
                $this->username = $this->_username;
            }
            if (isset($this->_url)) {
                $this->url = $this->_url;
            }
            if (isset($this->_voice)) {
                $this->voice = $this->_voice;
            }
            if (isset($this->_minConfidence)) {
                $this->minConfidence = $this->_minConfidence;
            }
            if (isset($this->_interdigitTimeout)) {
                $this->interdigitTimeout = $this->_interdigitTimeout;
            }

            return $this->unescapeJSON(json_encode($this));
        }
    }
