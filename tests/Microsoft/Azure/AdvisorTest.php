<?php
namespace Microsoft\Azure;

use GuzzleHttp\Exception\ClientException;
use Microsoft\Azure\Management\Advisor\_2017_04_19\AdvisorManagementClient;

class AdvisorTest extends TestInfo
{
    const API_VERSION = '2017-04-19';

    /**
     * @var AdvisorManagementClient
     */
    private $client;

    /**
     * AdvisorTest constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->client = new AdvisorManagementClient($this->runTime);
    }

    function testRecommendations()
    {
        $recommendations = $this->client->getRecommendations();
        try {
            $recommendations->getGenerateStatus(
                $this->subscriptionId,
                'someoperation',
                self::API_VERSION);
        } catch (ClientException $e) {
            print_r($e->getMessage());
        }
        try {
            // TODO: should it have subscriptionId parameter?
            // https://github.com/Azure/azure-rest-api-specs/blob/current/specification/advisor/resource-manager/Microsoft.Advisor/2017-04-19/advisor.json#L281
            $recommendations->get(
                'example.com',
                'rec',
                self::API_VERSION);
        } catch (ClientException $e) {
            print_r($e->getMessage());
        }
        try {
            $recommendations->list_(
                $this->subscriptionId,
                self::API_VERSION,
                '',
                '',
                '');
        } catch (ClientException $e) {
            print_r($e->getMessage());
        }
        try {
            $recommendations->generate($this->subscriptionId, self::API_VERSION);
        } catch (ClientException $e) {
            print_r($e->getMessage());
        }
    }

    function testOperations()
    {
        $operations = $this->client->getOperations();
        try {
            $operations->list_(self::API_VERSION);
        } catch (ClientException $e) {
            print_r($e->getMessage());
        }
    }
}