<?php
    namespace Tropo\Parameter;

    use Tropo\Exception\TropoParameterException;

    /**
     * Base class for parameters
     *
     * @package Tropo\Parameter
     */
    abstract class Base {

        /**
         * Base constructor.
         * Ingests optional array of construction parameters
         *
         * @param string[] $parameters
         *
         * @throws \Tropo\Exception\TropoParameterException
         */
        public function __construct ($parameters = array()) {
            if (is_array($parameters)) {
                foreach ($parameters as $parameter_key => $parameter_value) {
                    if (!property_exists($this, $parameter_key)) {
                        throw new TropoParameterException(sprintf("Invalid parameter '%s' supplied during %s construction", get_class($this), $parameter_key));
                    }

                    $this->$parameter_key = $parameter_value;
                }
            }
        }
    }
