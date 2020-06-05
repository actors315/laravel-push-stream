<?php


namespace twinkle\pusher;


use GuzzleHttp\Client;
use function GuzzleHttp\Promise\unwrap;

class PushStream
{

    protected $client;

    protected $promises;

    protected $pubPath;

    public function __construct($pubPath, $baseUri, $options = [])
    {
        $this->client = new Client([
            'base_uri' => $baseUri,
        ]);
        $this->pubPath = $pubPath;
    }

    public function trigger($channel, array $data)
    {
        $this->promises[] = $this->client->postAsync($this->pubPath . $channel, $data);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function send()
    {
        return $results = unwrap($this->promises);
    }
}
