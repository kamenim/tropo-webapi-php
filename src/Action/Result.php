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
     * @package Tropo\Action
     *
     */
    class Result {

        /** @var array|\stdClass */
        private $_actions;
        /** @var  integer */
        private $_attempts;
        /** @var  string */
        private $_callId;
        /** @var  boolean */
        private $_complete;
        /** @var null|string */
        private $_concept;
        /** @var  integer */
        private $_confidence;
        /** @var  string */
        private $_disposition;
        /** @var  string */
        private $_error;
        /** @var  string */
        private $_interpretation;
        /** @var  string */
        private $_name;
        /** @var  integer */
        private $_sequence;
        /** @var  integer */
        private $_sessionDuration;
        /** @var  string */
        private $_sessionId;
        /** @var  string */
        private $_state;
        /** @var null|string Undocumented */
        private $_transcription;
        /** @var  string */
        private $_userType;
        /** @var  string */
        private $_utterance;
        /** @var  string */
        private $_value;

        /**
         * Result constructor.
         *
         * @param null|string $json
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

        /**
         * @return array|\stdClass
         */
        public function getActions () {
            return $this->_actions;
        }

        /**
         * @return integer
         */
        public function getAttempts () {
            return $this->_attempts;
        }

        /**
         * @return string
         */
        public function getCallId () {
            return $this->_callId;
        }

        /**
         * @return null|string
         */
        public function getConcept () {
            return $this->_concept;
        }

        /**
         * @return integer
         */
        public function getConfidence () {
            return $this->_confidence;
        }

        /**
         * @return string
         */
        public function getDisposition () {
            return $this->_disposition;
        }

        /**
         * @return string
         */
        public function getError () {
            return $this->_error;
        }

        /**
         * @return string
         */
        public function getInterpretation () {
            return $this->_interpretation;
        }

        /**
         * @return string
         */
        public function getName () {
            return $this->_name;
        }

        /**
         * @return integer
         */
        public function getSequence () {
            return $this->_sequence;
        }

        /**
         * @return integer
         */
        public function getSessionDuration () {
            return $this->_sessionDuration;
        }

        /**
         * @return string
         */
        public function getSessionId () {
            return $this->_sessionId;
        }

        /**
         * @return string
         */
        public function getState () {
            return $this->_state;
        }

        /**
         * @return null|string
         */
        public function getTranscription () {
            return $this->_transcription;
        }

        /**
         * @return string
         */
        public function getUserType () {
            return $this->_userType;
        }

        /**
         * @return string
         */
        public function getUtterance () {
            return $this->_utterance;
        }

        /**
         * @return string
         */
        public function getValue () {
            return $this->_value;
        }

        /**
         * @return boolean
         */
        public function isComplete () {
            return (bool)$this->_complete;
        }
    }
