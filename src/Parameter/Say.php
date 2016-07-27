<?php
    namespace Tropo\Parameter;

    use Tropo\Helper\SayAs;

    /**
     * Contains the parameters for the "Say" action object
     *
     * @package Tropo\Parameter
     */
    class Say extends Base {

        /** @var SayAs */
        private $_as           = null;
        /** @var string */
        private $_format       = null;
        private $_event        = null;
        private $_voice        = null;
        private $_allowSignals = null;

    }
