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
    namespace Tropo\Helper;

    /**
     * Format Helper class.
     *
     * @package TropoPHP_Support
     */
    class Format {

        public        $date;
        public        $duration;
        public static $ordinal = "ordinal";
        public static $digits  = "digits";

        public function __construct ($date = null, $duration = null) {
            $this->date     = $date;
            $this->duration = $duration;
        }
    }
