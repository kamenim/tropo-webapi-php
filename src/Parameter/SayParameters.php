<?php
    namespace Tropo\Parameter;

    /**
     * Contains the parameters for the "Say" action object
     *
     * @package Tropo\Parameter
     */
    class SayParameters {

        /** @var string|string[] */
        private $allow_signals = null;
        /** @var string */
        private $as = null;
        /** @var string Event associated with this say, if used within an ask */
        private $event = null;
        /** @var  boolean */
        private $format_as_ssml = false;
        /** @var string */
        private $voice = null;

        /**
         * @return string|\string[]
         */
        public function getAllowSignals () {
            return $this->allow_signals;
        }

        /**
         * @return string
         */
        public function getAs () {
            return $this->as;
        }

        /**
         * @return string
         */
        public function getEvent () {
            return $this->event;
        }

        /**
         * @return string
         */
        public function getVoice () {
            return $this->voice;
        }

        /**
         * @return boolean
         */
        public function isFormatAsSsml () {
            return $this->format_as_ssml;
        }

        /**
         * @param string|\string[] $allow_signals
         *
         * @return SayParameters
         */
        public function setAllowSignals ($allow_signals) {
            $this->allow_signals = $allow_signals;

            return $this;
        }

        /**
         * @param string $as
         *
         * @return SayParameters
         */
        public function setAs ($as) {
            $this->as = $as;

            return $this;
        }

        /**
         * @param string $event
         *
         * @return SayParameters
         */
        public function setEvent ($event) {
            $this->event = $event;

            return $this;
        }

        /**
         * @param boolean $format_as_ssml
         *
         * @return SayParameters
         */
        public function setFormatAsSsml ($format_as_ssml) {
            $this->format_as_ssml = $format_as_ssml;

            return $this;
        }

        /**
         * @param string $voice
         *
         * @return SayParameters
         */
        public function setVoice ($voice) {
            $this->voice = $voice;

            return $this;
        }

    }
