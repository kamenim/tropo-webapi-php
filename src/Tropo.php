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
    namespace Tropo;

    use Exception;
    use Tropo\Action\Ask;
    use Tropo\Action\Say;
    use Tropo\Action\BaseClass;
    use Tropo\Exception\TropoException;
    use Tropo\Parameter\SayParameters;

    /**
     * The main Tropo WebAPI class.
     * The methods on this class can be used to invoke specific Tropo actions.
     *
     * @property string[] say
     *
     * @package TropoPHP
     * @see     https://www.tropo.com/docs/webapi/tropo.htm
     *
     */
    class Tropo extends BaseClass {

        /** @var string[]  The container for JSON actions. */
        public $tropo;

        /** @var  string  The language to use when rendering content. */
        private $_language;
        /** @var  string  The TTS voice to use when rendering content. */
        private $_voice;

        /**
         * Class constructor for the Tropo class.
         *
         * @access private
         */
        public function __construct () {
            $this->tropo = array();
        }

        /**
         * Allows undefined methods to be called.
         * This method is invloked by Tropo class methods to add action items to the Tropo array.
         *
         * @param string $name
         * @param mixed  $value
         *
         * @access private
         */
        public function __set ($name, $value) {
            array_push($this->tropo, array($name => $value));
        }

        /**
         * Controls how JSON structure for the Tropo object is rendered.
         *
         * @return string
         * @access private
         */
        public function __toString () {
            // Remove voice and language so they do not appear in the rendered JSON.
            unset($this->_voice);
            unset($this->_language);

            // Call the unescapeJSON() method in the parent class.
            return parent::unescapeJSON(json_encode($this));
        }

        /**
         * Sends a prompt to the user and optionally waits for a response.
         *
         * The ask method allows for collecting input using either speech
         * recognition or DTMF (also known as Touch Tone). You can either
         * pass in a fully-formed Ask object or a string to use as the
         * prompt and an array of parameters.
         *
         * @param string|Ask $ask
         * @param array      $params
         *
         * @see https://www.tropo.com/docs/webapi/ask.htm
         */
        public function ask ($ask, Array $params = null) {
            if (!is_object($ask)) {
                $p = array(
                    'as',
                    'event',
                    'voice',
                    'attempts',
                    'bargein',
                    'minConfidence',
                    'name',
                    'required',
                    'timeout',
                    'allowSignals',
                    'recognizer',
                    'interdigitTimeout',
                    'sensitivity',
                    'speechCompleteTimeout',
                    'speechIncompleteTimeout'
                );
                foreach ($p as $option) {
                    $$option = null;
                    if (is_array($params) && array_key_exists($option, $params)) {
                        $$option = $params[$option];
                    }
                }
                if (is_array($event)) {
                    // If an event was passed in, add the events to the Ask
                    foreach ($event as $e => $val) {
                        $say[] = new Say($val, $as, $e, $voice);
                    }
                }
                $say[]                = new Say($ask, $as, null, $voice);
                $params["mode"]       = isset($params["mode"]) ? $params["mode"] : null;
                $params["dtmf"]       = isset($params["dtmf"]) ? $params["dtmf"] : null;
                $params["terminator"] = isset($params["terminator"]) ? $params["terminator"] : null;
                if (!isset($voice) && isset($this->_voice)) {
                    $voice = $this->_voice;
                }
                $choices = isset($params["choices"]) ? new Choices($params["choices"], $params["mode"], $params["terminator"]) : null;
                $ask     = new Ask($attempts, $bargein, $choices, $minConfidence, $name, $required, $say, $timeout, $voice, $allowSignals, $recognizer, $interdigitTimeout, $sensitivity, $speechCompleteTimeout, $speechIncompleteTimeout);
            }
            $this->ask = sprintf('%s', $ask);
        }

        /**
         * Places a call or sends an an IM, Twitter, or SMS message. To start a call, use the Session API to tell Tropo to launch your code.
         *
         * @param string|Call $call
         * @param array       $params
         *
         * @see https://www.tropo.com/docs/webapi/call.htm
         */
        public function call ($call, Array $params = null) {
            if (!is_object($call)) {
                $p = array(
                    'to',
                    'from',
                    'network',
                    'channel',
                    'answerOnMedia',
                    'timeout',
                    'headers',
                    'recording',
                    'allowSignals',
                    'machineDetection',
                    'voice'
                );
                foreach ($p as $option) {
                    $$option = null;
                    if (is_array($params) && array_key_exists($option, $params)) {
                        $$option = $params[$option];
                    }
                }
                $call = new Call($call, $from, $network, $channel, $answerOnMedia, $timeout, $headers, $recording, $allowSignals, $machineDetection, $voice);
            }
            $this->call = sprintf('%s', $call);
        }

        /**
         * This object allows multiple lines in separate sessions to be conferenced together so that the parties on each line can talk to each other simultaneously.
         * This is a voice channel only feature.
         *
         * @param string|Conference $conference
         * @param array             $params
         *
         * @see https://www.tropo.com/docs/webapi/conference.htm
         */
        public function conference ($conference, Array $params = null) {
            if (!is_object($conference)) {
                $p = array(
                    'name',
                    'id',
                    'mute',
                    'on',
                    'playTones',
                    'required',
                    'terminator',
                    'allowSignals',
                    'interdigitTimeout',
                    'joinPrompt',
                    'leavePrompt',
                    'voice'
                );
                foreach ($p as $option) {
                    $$option = null;
                    if (is_array($params) && array_key_exists($option, $params)) {
                        $$option = $params[$option];
                    }
                }
                $id         = (empty($id) && !empty($conference)) ? $conference : $id;
                $name       = (empty($name)) ? (string)$id : $name;
                $conference = new Conference($name, $id, $mute, $on, $playTones, $required, $terminator, $allowSignals, $interdigitTimeout, $joinPrompt, $leavePrompt, $voice);
            }
            $this->conference = sprintf('%s', $conference);
        }

        /**
         * Creates a new Tropo Application
         * (Pass through to ProvisioningAPI class).
         *
         * @param string $userid
         * @param string $password
         * @param array  $params
         *
         * @return string JSON
         *
         * @throws \Tropo\Exception\TropoException
         */
        public function createApplication ($userid, $password, Array $params) {
            $p = array('href', 'name', 'voiceUrl', 'messagingUrl', 'platform', 'partition');
            foreach ($p as $property) {
                $$property = null;
                if (is_array($params) && array_key_exists($property, $params)) {
                    $$property = $params[$property];
                }
            }
            try {
                $provision = new ProvisioningAPI($userid, $password);
                $result    = $provision->createApplication($href, $name, $voiceUrl, $messagingUrl, $platform, $partition);

                return $result;
            } // If an exception occurs, wrap it in a TropoException and rethrow.
            catch (Exception $ex) {
                throw new TropoException($ex->getMessage(), $ex->getCode());
            }
        }

        /**
         * Launches a new session with the Tropo Session API.
         * (Pass through to SessionAPI class.)
         *
         * @param string $token  Your outbound session token from Tropo
         * @param array  $params An array of key value pairs that will be added as query string parameters
         *
         * @return bool True if the session was launched successfully
         *
         * @throws \Tropo\Exception\TropoException
         */
        public function createSession ($token, Array $params = null) {
            try {
                $session = new SessionAPI();
                $result  = $session->createSession($token, $params);

                return $result;
            } // If an exception occurs, wrap it in a TropoException and rethrow.
            catch (Exception $ex) {
                throw new TropoException($ex->getMessage(), $ex->getCode());
            }
        }

        /**
         * Delete an existing Tropo application.
         * (Pass through to ProvisioningAPI class).
         *
         * @param string $userid
         * @param string $password
         * @param string $applicationID
         *
         * @return string JSON
         */
        public function deleteApplication ($userid, $password, $applicationID) {
            $provision = new ProvisioningAPI($userid, $password);

            return $provision->deleteApplication($applicationID);
        }

        /**
         * Delete an address for an existing Tropo application.
         * (Pass through to ProvisioningAPI class).
         *
         * @param string $userid
         * @param string $password
         * @param string $applicationID
         * @param        $addresstype
         * @param        $address
         *
         * @return string JSON
         *
         */
        public function deleteApplicationAddress ($userid, $password, $applicationID, $addresstype, $address) {
            $provision = new ProvisioningAPI($userid, $password);

            return $provision->deleteApplicationAddress($applicationID, $addresstype, $address);
        }

        /**
         * This function instructs Tropo to "hang-up" or disconnect the session associated with the current session.
         *
         * @see https://www.tropo.com/docs/webapi/hangup.htm
         */
        public function hangup () {
            $hangup       = new Hangup();
            $this->hangup = sprintf('%s', $hangup);
        }

        /**
         * A shortcut method to create a session, say something, and hang up, all in one step. This is particularly useful for sending out a quick SMS or IM.
         *
         * @param string|Message $message
         * @param array          $params
         *
         * @see https://www.tropo.com/docs/webapi/message.htm
         */
        public function message ($message, Array $params = null) {
            if (!is_object($message)) {
                $say = new Say($message);
                $to  = $params["to"];
                $p   = array('channel', 'network', 'from', 'voice', 'timeout', 'answerOnMedia', 'headers');
                foreach ($p as $option) {
                    $$option = null;
                    if (is_array($params) && array_key_exists($option, $params)) {
                        $$option = $params[$option];
                    }
                }
                $message = new Message($say, $to, $channel, $network, $from, $voice, $timeout, $answerOnMedia, $headers);
            }
            $this->message = sprintf('%s', $message);
        }

        /**
         * Adds an event callback so that your application may be notified when a particular event occurs.
         * Possible events are: "continue", "error", "incomplete" and "hangup".
         *
         * @param array $on
         *
         * @see      https://www.tropo.com/docs/webapi/on.htm
         */
        public function on ($on) {
            if (!is_object($on) && is_array($on)) {
                $params = $on;
                if ((array_key_exists('say', $params) && ((array_key_exists('voice', $params) || isset($this->_voice))))) {
                    $v   = isset($params["voice"]) ? $params["voice"] : $this->_voice;
                    $say = new Say($params["say"], null, null, $v);
                } else {
                    $say = (array_key_exists('say', $params)) ? new Say($params["say"]) : null;
                }
                $next = (array_key_exists('next', $params)) ? $params["next"] : null;
                $on   = new On($params["event"], $next, $say);
            }
            $this->on = array(sprintf('%s', $on));
        }

        /**
         * Plays a prompt (audio file or text to speech) and optionally waits for a response from the caller that is recorded.
         * If collected, responses may be in the form of DTMF or speech recognition using a simple grammar format defined below.
         * The record funtion is really an alias of the prompt function, but one which forces the record option to true regardless of how it is (or is not) initially set.
         * At the conclusion of the recording, the audio file may be automatically sent to an external server via FTP or an HTTP POST/Multipart Form.
         * If specified, the audio file may also be transcribed and the text returned to you via an email address or HTTP POST/Multipart Form.
         *
         * @param array|Record $record
         *
         * @see https://www.tropo.com/docs/webapi/record.htm
         */
        public function record ($record) {
            if (!is_object($record) && is_array($record)) {
                $params = $record;
                $p      = array('as', 'voice', 'emailFormat', 'transcription', 'terminator');
                foreach ($p as $option) {
                    $params[$option] = array_key_exists($option, $params) ? $params[$option] : null;
                }
                $choices = isset($params["choices"])
                    ? new Choices(null, null, $params["choices"])
                    : null;
                $choices = isset($params["terminator"])
                    ? new Choices(null, null, $params["terminator"])
                    : $choices;
                if (!isset($params['voice'])) {
                    $params['voice'] = $this->_voice;
                }
                $say = new Say($params["say"], $params["as"], null, null);
                if (is_array($params['transcription'])) {
                    $p = array('url', 'id', 'emailFormat');
                    foreach ($p as $option) {
                        $$option = null;
                        if (!is_array($params["transcription"]) || !array_key_exists($option, $params["transcription"])) {
                            $params["transcription"][$option] = null;
                        }
                    }
                    $transcription = new Transcription($params["transcription"]["url"], $params["transcription"]["id"], $params["transcription"]["emailFormat"]);
                } else {
                    $transcription = $params["transcription"];
                }
                $p = array(
                    'attempts',
                    'allowSignals',
                    'bargein',
                    'beep',
                    'format',
                    'maxTime',
                    'maxSilence',
                    'method',
                    'password',
                    'required',
                    'timeout',
                    'username',
                    'url',
                    'voice',
                    'minConfidence',
                    'interdigitTimeout'
                );
                foreach ($p as $option) {
                    $$option = null;
                    if (is_array($params) && array_key_exists($option, $params)) {
                        $$option = $params[$option];
                    }
                }
                $record = new Record($attempts, $allowSignals, $bargein, $beep, $choices, $format, $maxSilence, $maxTime, $method, $password, $required, $say, $timeout, $transcription, $username, $url, $voice, $minConfidence, $interdigitTimeout);
            }
            $this->record = sprintf('%s', $record);
        }

        /**
         * The redirect function forwards an incoming call to another destination / phone number before answering it.
         * The redirect function must be called before answer is called; redirect expects that a call be in the ringing or answering state.
         * Use transfer when working with active answered calls.
         *
         * @param string|Redirect $redirect
         * @param array           $params
         *
         * @see https://www.tropo.com/docs/webapi/redirect.htm
         */
        public function redirect ($redirect, Array $params = null) {
            if (!is_object($redirect)) {
                $to       = isset($params["to"]) ? $params["to"] : null;
                $from     = isset($params["from"]) ? $params["from"] : null;
                $redirect = new Redirect($to, $from);
            }
            $this->redirect = sprintf('%s', $redirect);
        }

        /**
         * Allows Tropo applications to reject incoming sessions before they are answered.
         * For example, an application could inspect the callerID variable to determine if the user is known, and then use the reject call accordingly.
         *
         * @see https://www.tropo.com/docs/webapi/reject.htm
         *
         */
        public function reject () {
            $reject       = new Reject();
            $this->reject = sprintf('%s', $reject);
        }

        /**
         * Renders the Tropo object as JSON.
         *
         */
        public function renderJSON () {
            header('Content-type: application/json');
            echo $this;
        }

        /**
         * When the current session is a voice channel this key will either play a message or an audio file from a URL.
         * In the case of an text channel it will send the text back to the user via instant messaging or SMS.
         *
         * @param string|Say                     $say
         * @param \Tropo\Parameter\SayParameters $params
         *
         * @see https://www.tropo.com/docs/webapi/say.htm
         */
        public function say ($say, SayParameters $params = null) {
            if (!is_object($say)) {
                $value = $say;
                $say   = new Say($value, $params->as, $params->event, (!empty($params->voice) ? $params->voice : $this->_voice), $params->allowSignals);
            }
            $this->say = array(sprintf('%s', $say));
        }

        public function sendEvent ($session_id, $value) {
            try {
                $event  = new EventAPI();
                $result = $event->sendEvent($session_id, $value);

                return $result;
            } catch (Exception $ex) {
                throw new TropoException($ex->getMessage(), $ex->getCode());
            }
        }

        /**
         * Set a default language to use in speech recognition.
         *
         * When recognizing spoken input, Tropo allows you to set a language
         * to let the platform know which language is being spoken and which
         * recognizer to use. The default is en-us (US English), but you can
         * set a different default to be used in your application here.
         *
         * @param string $language
         */
        public function setLanguage ($language) {
            $this->_language = $language;
        }

        /**
         * Set a default voice for use with all Text To Speech.
         *
         * Tropo's text to speech engine can pronounce your text with
         * a variety of voices in different languages. All elements where
         * you can create text to speech (TTS) accept a voice parameter.
         * Tropo's default is "Allison" but you can set a default for this
         * script here.
         *
         * @param string $voice
         */
        public function setVoice ($voice) {
            $this->_voice = $voice;
        }

        /**
         * Allows Tropo applications to begin recording the current session.
         * The resulting recording may then be sent via FTP or an HTTP POST/Multipart Form.
         *
         * @param array|StartRecording $startRecording
         *
         * @see https://www.tropo.com/docs/webapi/startrecording.htm
         */
        public function startRecording ($startRecording) {
            if (!is_object($startRecording) && is_array($startRecording)) {
                $params = $startRecording;
                $p      = array(
                    'format',
                    'method',
                    'password',
                    'url',
                    'username',
                    'transcriptionID',
                    'transcriptionEmailFormat',
                    'transcriptionOutURI'
                );
                foreach ($p as $option) {
                    $$option = null;
                    if (is_array($params) && array_key_exists($option, $params)) {
                        $$option = $params[$option];
                    }
                }
                $startRecording = new StartRecording($format, $method, $password, $url, $username, $transcriptionID, $transcriptionEmailFormat, $transcriptionOutURI);
            }
            $this->startRecording = sprintf('%s', $startRecording);
        }

        /**
         * Stops a previously started recording.
         *
         * @see https://www.tropo.com/docs/webapi/stoprecording.htm
         */
        public function stopRecording () {
            $stopRecording       = new stopRecording();
            $this->stopRecording = sprintf('%s', $stopRecording);
        }

        /**
         * Transfers an already answered call to another destination / phone number.
         * Call may be transferred to another phone number or SIP address, which is set through the "to" parameter and is in URL format.
         *
         * @param string|Transfer $transfer
         * @param array           $params
         *
         * @see https://www.tropo.com/docs/webapi/transfer.htm
         */
        public function transfer ($transfer, Array $params = null) {
            if (!is_object($transfer)) {
                $choices = isset($params["choices"]) ? $params["choices"] : null;
                $choices = isset($params["terminator"])
                    ? new Choices(null, null, $params["terminator"])
                    : $choices;
                $to      = isset($params["to"]) ? $params["to"] : $transfer;
                $p       = array('answerOnMedia', 'ringRepeat', 'timeout', 'from', 'allowSignals', 'headers', 'machineDetection', 'voice');
                foreach ($p as $option) {
                    $$option = null;
                    if (is_array($params) && array_key_exists($option, $params)) {
                        $$option = $params[$option];
                    }
                }
                $on = null;
                if (array_key_exists('playvalue', $params) && isset($params['playvalue'])) {
                    $on = new On('ring', null, new Say($params['playvalue']));
                } elseif (array_key_exists('on', $params) && isset($params['on'])) {
                    if (is_object($params['on'])) {
                        $on = $params['on'];
                    } else {
                        if (strtolower($params['on']['event']) == 'ring') {
                            $on = on(array('ring', null, new Say($params['on']['say']), null, null));
                        } elseif (strtolower($params['on']['event']) == 'connect') {

                            $comma = "";
                            $on    = "";

                            if (isset($params['on']['ring'])) {
                                $on    = new On('ring', null, new Say($params['on']['ring']), null, null);
                                $comma = ",";
                            }
                            foreach ($params['on']['whisper'] as $key) {
                                foreach ($key as $k => $v) {

                                    switch ($k) {
                                        case 'ask':
                                            $on = $on . $comma . new On('connect', null, null, null, $v, null, null, "ask");
                                            break;
                                        case 'say':
                                            $on = $on . $comma . new On('connect', null, $v, null, null, null, null, "say");
                                            break;
                                        case 'wait':
                                            $on = $on . $comma . new On('connect', null, null, null, null, null, $v, "wait");
                                            break;
                                        case 'message':
                                            $on = $on . $comma . new On('connect', null, null, null, null, $v, null, "message");
                                            break;
                                    }
                                    $comma = ",";
                                }
                            }

                        } else {
                            throw new TropoException("The only event allowed on transfer is 'ring' or 'connect'");
                        }
                    }
                }
                $on       = $on == null ? null : sprintf('%s', $on);
                $transfer = new Transfer($to, $answerOnMedia, $choices, $from, $ringRepeat, $timeout, $on, $allowSignals, $headers, $machineDetection, $voice);
            }
            $this->transfer = sprintf('%s', $transfer);
        }

        /**
         * Add/Update an address (phone number, IM address or token) for an existing Tropo application.
         * (Pass through to ProvisioningAPI class).
         *
         * @param string $userid
         * @param string $passwd
         * @param string $applicationID
         * @param array  $params
         *
         * @return string JSON
         *
         * @throws \Tropo\Exception\TropoException
         */
        public function updateApplicationAddress ($userid, $passwd, $applicationID, Array $params) {
            $p = array('type', 'prefix', 'number', 'city', 'state', 'channel', 'username', 'password', 'token');
            foreach ($p as $property) {
                $$property = null;
                if (is_array($params) && array_key_exists($property, $params)) {
                    $$property = $params[$property];
                }
            }
            try {
                $provision = new ProvisioningAPI($userid, $passwd);
                $result    = $provision->updateApplicationAddress($applicationID, $type, $prefix, $number, $city, $state, $channel, $username, $password, $token);

                return $result;
            } // If an exception occurs, wrap it in a TropoException and rethrow.
            catch (Exception $ex) {
                throw new TropoException($ex->getMessage(), $ex->getCode());
            }
        }

        /**
         * Update a property (name, URL, platform, etc.) for an existing Tropo application.
         * (Pass through to ProvisioningAPI class).
         *
         * @param string $userid
         * @param string $password
         * @param string $applicationID
         * @param array  $params
         *
         * @return string JSON
         *
         * @throws \Tropo\Exception\TropoException
         */
        public function updateApplicationProperty ($userid, $password, $applicationID, Array $params) {
            $p = array('href', 'name', 'voiceUrl', 'messagingUrl', 'platform', 'partition');
            foreach ($p as $property) {
                $$property = null;
                if (is_array($params) && array_key_exists($property, $params)) {
                    $$property = $params[$property];
                }
            }
            try {
                $provision = new ProvisioningAPI($userid, $password);
                $result    = $provision->updateApplicationProperty($applicationID, $href, $name, $voiceUrl, $messagingUrl, $platform, $partition);

                return $result;
            } // If an exception occurs, wrap it in a TropoException and rethrow.
            catch (Exception $ex) {
                throw new TropoException($ex->getMessage(), $ex->getCode());
            }
        }

        /**
         * View the addresses for a specific Tropo application.
         * (Pass through to ProvisioningAPI class).
         *
         * @param string $userid
         * @param string $password
         * @param string $applicationID
         *
         * @return string JSON
         */
        public function viewAddresses ($userid, $password, $applicationID) {
            $provision = new ProvisioningAPI($userid, $password);

            return $provision->viewAddresses($applicationID);
        }

        /**
         * View a list of Tropo applications.
         * (Pass through to ProvisioningAPI class).
         *
         * @param string $userid
         * @param string $password
         *
         * @return string JSON
         */
        public function viewApplications ($userid, $password) {
            $provision = new ProvisioningAPI($userid, $password);

            return $provision->viewApplications();
        }

        /**
         * View a list of available exchanges for assigning a number to a Tropo application.
         * (Pass through to ProvisioningAPI class).
         *
         * @param string $userid
         * @param string $password
         *
         * @return string JSON
         */
        public function viewExchanges ($userid, $password) {
            $provision = new ProvisioningAPI($userid, $password);

            return $provision->viewExchanges();
        }

        /**
         * View the details of a specific Tropo application.
         * (Pass through to ProvisioningAPI class).
         *
         * @param string $userid
         * @param string $password
         * @param string $applicationID
         *
         * @return string JSON
         */
        public function viewSpecificApplication ($userid, $password, $applicationID) {
            $provision = new ProvisioningAPI($userid, $password);

            return $provision->viewSpecificApplication($applicationID);
        }

        /**
         * Makes the Tropo sleep an active call in milliseconds
         *
         * @param Interger $milliseconds
         * @param          String or Array $allowSignals
         *
         * @see https://www.tropo.com/docs/webapi/wait.htm
         */
        public function wait ($wait) {
            if (!is_object($wait) && is_array($wait)) {
                $params = $wait;
                $signal = isset($params['allowSignals']) ? $params['allowSignals'] : null;
                $wait   = new Wait($params["milliseconds"], $signal);
            }
            $this->wait = sprintf('%s', $wait);

        }
    }
