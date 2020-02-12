<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Numbers\V2\RegulatoryCompliance;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Rest\Numbers\V2\RegulatoryCompliance\Bundle\ItemAssignmentList;
use Twilio\Values;
use Twilio\Version;

/**
 * @property ItemAssignmentList $itemAssignments
 * @method \Twilio\Rest\Numbers\V2\RegulatoryCompliance\Bundle\ItemAssignmentContext itemAssignments(string $sid)
 */
class BundleContext extends InstanceContext {
    protected $_itemAssignments;

    /**
     * Initialize the BundleContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid The unique string that identifies the resource.
     */
    public function __construct(Version $version, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['sid' => $sid, ];

        $this->uri = '/RegulatoryCompliance/Bundles/' . \rawurlencode($sid) . '';
    }

    /**
     * Fetch a BundleInstance
     *
     * @return BundleInstance Fetched BundleInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): BundleInstance {
        $params = Values::of([]);

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new BundleInstance($this->version, $payload, $this->solution['sid']);
    }

    /**
     * Update the BundleInstance
     *
     * @param array|Options $options Optional Arguments
     * @return BundleInstance Updated BundleInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($options = []): BundleInstance {
        $options = new Values($options);

        $data = Values::of([
            'Status' => $options['status'],
            'StatusCallback' => $options['statusCallback'],
            'FriendlyName' => $options['friendlyName'],
            'Email' => $options['email'],
        ]);

        $payload = $this->version->update(
            'POST',
            $this->uri,
            [],
            $data
        );

        return new BundleInstance($this->version, $payload, $this->solution['sid']);
    }

    /**
     * Access the itemAssignments
     */
    protected function getItemAssignments(): ItemAssignmentList {
        if (!$this->_itemAssignments) {
            $this->_itemAssignments = new ItemAssignmentList($this->version, $this->solution['sid']);
        }

        return $this->_itemAssignments;
    }

    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return ListResource The requested subresource
     * @throws TwilioException For unknown subresources
     */
    public function __get($name): ListResource {
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call($name, $arguments): InstanceContext {
        $property = $this->$name;
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Numbers.V2.BundleContext ' . \implode(' ', $context) . ']';
    }
}