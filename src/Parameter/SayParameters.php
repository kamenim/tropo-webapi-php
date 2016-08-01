<?php
    namespace Tropo\Parameter;

    /**
     * Contains the parameters for the "Say" action object
     *
     * @package Tropo\Parameter
     */
    class SayParameters extends Base {

        /** @var string|array */
        public $allowSignals = null;
        /** @var string */
        public $as = null;
        /** @var string */
        public $event = null;
        /** @var string */
        public $format = null;
        /** @var string */
        public $voice = null;

    }
