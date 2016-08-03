<?php
    /**
     * Created by PhpStorm.
     * User: rjking
     * Date: 8/1/16
     * Time: 4:50 PM
     */
    namespace Tropo\Parameter;

    /**
     * Contains the parameters for the "On" action object
     *
     * @package Tropo\Parameter
     */
    class OnParameters {

        /** @var string */
        private $event = null;
        /** @var string */
        private $next = null;
        /** @var \Tropo\Action\Say */
        private $say = null;

        /**
         * @return string
         */
        public function getEvent () {
            return $this->event;
        }

        /**
         * @return string
         */
        public function getNext () {
            return $this->next;
        }

        /**
         * @return \Tropo\Action\Say
         */
        public function getSay () {
            return $this->say;
        }

        /**
         * @param string $event
         *
         * @return OnParameters
         */
        public function setEvent ($event) {
            $this->event = $event;

            return $this;
        }

        /**
         * @param string $next
         *
         * @return OnParameters
         */
        public function setNext ($next) {
            $this->next = $next;

            return $this;
        }

        /**
         * @param \Tropo\Action\Say $say
         *
         * @return OnParameters
         */
        public function setSay ($say) {
            $this->say = $say;

            return $this;
        }

    }
