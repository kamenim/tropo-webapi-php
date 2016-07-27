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

    use Tropo\Exception\TropoException;

    /**
     * Returned anytime a request is made to the Tropo Web API.
     *
     * @package TropoPHP
     *
     */
    class Result {

        private $_sessionId;
        private $_callId;
        private $_state;
        private $_sessionDuration;
        private $_sequence;
        private $_complete;
        private $_error;
        private $_actions;
        private $_name;
        private $_attempts;
        private $_disposition;
        private $_confidence;
        private $_interpretation;
        private $_concept;
        private $_userType;
        private $_utterance;
        private $_value;
        private $_transcription;

        /**
         * Class constructor
         *
         * @param string $json
         *
         * @throws \Tropo\Exception\TropoException
         */
        public function __construct ($json = null) {
            if (empty($json)) {
                $json = file_get_contents("php://input");
                // if $json is still empty, there was nothing in
                // the POST so throw an exception
                if (empty($json)) {
                    throw new TropoException('No JSON available.');
                }
            }
            $result = json_decode($json);
            if (!is_object($result) || !property_exists($result, "result")) {
                throw new TropoException('Not a result object.');
            }
            $this->_sessionId       = $result->result->sessionId;
            $this->_callId          = $result->result->callId;
            $this->_state           = $result->result->state;
            $this->_sessionDuration = $result->result->sessionDuration;
            $this->_sequence        = $result->result->sequence;
            $this->_complete        = $result->result->complete;
            $this->_error           = $result->result->error;
            $this->_userType        = $result->result->userType;
            $this->_actions         = $result->result->actions;
            $this->_name            = $result->result->actions->name;
            $this->_attempts        = $result->result->actions->attempts;
            $this->_disposition     = $result->result->actions->disposition;
            $this->_confidence      = $result->result->actions->confidence;
            $this->_interpretation  = $result->result->actions->interpretation;
            $this->_utterance       = $result->result->actions->utterance;
            $this->_value           = $result->result->actions->value;
            $this->_concept         = isset($result->result->actions->concept) ? $result->result->actions->concept : null;
            $this->_transcription   = isset($result->result->transcription) ? $result->result->transcription : null;
        }

        public function getSessionId () {
            return $this->_sessionId;
        }

        public function getCallId () {
            return $this->_callId;
        }

        public function getState () {
            return $this->_state;
        }

        public function getSessionDuration () {
            return $this->_sessionDuration;
        }

        public function getSequence () {
            return $this->_sequence;
        }

        public function isComplete () {
            return (bool)$this->_complete;
        }

        public function getError () {
            return $this->_error;
        }

        public function getUserType () {
            return $this->_userType;
        }

        public function getActions () {
            return $this->_actions;
        }

        public function getName () {
            return $this->_name;
        }

        public function getAttempts () {
            return $this->_attempts;
        }

        public function getDisposition () {
            return $this->_disposition;
        }

        public function getConfidence () {
            return $this->_confidence;
        }

        public function getInterpretation () {
            return $this->_interpretation;
        }

        public function getConcept () {
            return $this->_concept;
        }

        public function getUtterance () {
            return $this->_utterance;
        }

        public function getValue () {
            return $this->_value;
        }

        public function getTranscription () {
            return $this->_transcription;
        }
    }
