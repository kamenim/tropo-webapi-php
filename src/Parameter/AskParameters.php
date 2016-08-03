<?php
    /**
     * Created by PhpStorm.
     * User: rjking
     * Date: 8/1/16
     * Time: 5:54 PM
     */
    namespace Tropo\Parameter;

    /**
     * Contains the parameters for the "Ask" action object
     *
     * @package Tropo\Parameter
     */
    class AskParameters {

        /** @var string|string[] */
        private $allowSignals = null;
        /** @var null|integer */
        private $attempts = null;
        /** @var null|boolean */
        private $bargein = null;
        /** @var null|\Tropo\Action\Choices */
        private $choices = null;
        /** @var null|double */
        private $interdigitTimeout = null;
        /** @var null|integer */
        private $minConfidence = null;
        /** @var null|string */
        private $name = null;
        /** @var null|string */
        private $recognizer = null;
        /** @var null|boolean */
        private $required = null;
        /** @var \Tropo\Action\Say[] */
        private $say_events = array();
        /** @var null|double */
        private $sensitivity = null;
        /** @var null|double */
        private $speechCompleteTimeout = null;
        /** @var null|double */
        private $speechIncompleteTimeout = null;
        /** @var null|double */
        private $timeout = null;
        /** @var null|string */
        private $voice = null;

        /**
         * @param \Tropo\Action\Say $say_event
         *
         * @return AskParameters
         */
        public function addSayEvent ($say_event) {
            $this->say_events[] = $say_event;

            return $this;
        }

        /**
         * @return string|\string[]
         */
        public function getAllowSignals () {
            return $this->allowSignals;
        }

        /**
         * @return int|null
         */
        public function getAttempts () {
            return $this->attempts;
        }

        /**
         * @return bool|null
         */
        public function getBargein () {
            return $this->bargein;
        }

        /**
         * @return null|\Tropo\Action\Choices
         */
        public function getChoices () {
            return $this->choices;
        }

        /**
         * @return float|null
         */
        public function getInterdigitTimeout () {
            return $this->interdigitTimeout;
        }

        /**
         * @return int|null
         */
        public function getMinConfidence () {
            return $this->minConfidence;
        }

        /**
         * @return null|string
         */
        public function getName () {
            return $this->name;
        }

        /**
         * @return null|string
         */
        public function getRecognizer () {
            return $this->recognizer;
        }

        /**
         * @return bool|null
         */
        public function getRequired () {
            return $this->required;
        }

        /**
         * @return \Tropo\Action\Say[]
         */
        public function getSayEvents () {
            return $this->say_events;
        }

        /**
         * @return float|null
         */
        public function getSensitivity () {
            return $this->sensitivity;
        }

        /**
         * @return float|null
         */
        public function getSpeechCompleteTimeout () {
            return $this->speechCompleteTimeout;
        }

        /**
         * @return float|null
         */
        public function getSpeechIncompleteTimeout () {
            return $this->speechIncompleteTimeout;
        }

        /**
         * @return float|null
         */
        public function getTimeout () {
            return $this->timeout;
        }

        /**
         * @return null|string
         */
        public function getVoice () {
            return $this->voice;
        }

        /**
         * @param string|\string[] $allowSignals
         *
         * @return AskParameters
         */
        public function setAllowSignals ($allowSignals) {
            $this->allowSignals = $allowSignals;

            return $this;
        }

        /**
         * @param int|null $attempts
         *
         * @return AskParameters
         */
        public function setAttempts ($attempts) {
            $this->attempts = $attempts;

            return $this;
        }

        /**
         * @param bool|null $bargein
         *
         * @return AskParameters
         */
        public function setBargein ($bargein) {
            $this->bargein = $bargein;

            return $this;
        }

        /**
         * @param null|\Tropo\Action\Choices $choices
         *
         * @return AskParameters
         */
        public function setChoices ($choices) {
            $this->choices = $choices;

            return $this;
        }

        /**
         * @param float|null $interdigitTimeout
         *
         * @return AskParameters
         */
        public function setInterdigitTimeout ($interdigitTimeout) {
            $this->interdigitTimeout = $interdigitTimeout;

            return $this;
        }

        /**
         * @param int|null $minConfidence
         *
         * @return AskParameters
         */
        public function setMinConfidence ($minConfidence) {
            $this->minConfidence = $minConfidence;

            return $this;
        }

        /**
         * @param null|string $name
         *
         * @return AskParameters
         */
        public function setName ($name) {
            $this->name = $name;

            return $this;
        }

        /**
         * @param null|string $recognizer
         *
         * @return AskParameters
         */
        public function setRecognizer ($recognizer) {
            $this->recognizer = $recognizer;

            return $this;
        }

        /**
         * @param bool|null $required
         *
         * @return AskParameters
         */
        public function setRequired ($required) {
            $this->required = $required;

            return $this;
        }

        /**
         * @param float|null $sensitivity
         *
         * @return AskParameters
         */
        public function setSensitivity ($sensitivity) {
            $this->sensitivity = $sensitivity;

            return $this;
        }

        /**
         * @param float|null $speechCompleteTimeout
         *
         * @return AskParameters
         */
        public function setSpeechCompleteTimeout ($speechCompleteTimeout) {
            $this->speechCompleteTimeout = $speechCompleteTimeout;

            return $this;
        }

        /**
         * @param float|null $speechIncompleteTimeout
         *
         * @return AskParameters
         */
        public function setSpeechIncompleteTimeout ($speechIncompleteTimeout) {
            $this->speechIncompleteTimeout = $speechIncompleteTimeout;

            return $this;
        }

        /**
         * @param float|null $timeout
         *
         * @return AskParameters
         */
        public function setTimeout ($timeout) {
            $this->timeout = $timeout;

            return $this;
        }

        /**
         * @param null|string $voice
         *
         * @return AskParameters
         */
        public function setVoice ($voice) {
            $this->voice = $voice;

            return $this;
        }
    }
