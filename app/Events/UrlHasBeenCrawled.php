<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UrlHasBeenCrawled implements ShouldBroadcast
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $responseCode;

    public function __construct(string $url, string $responseCode = '')
    {
        echo 'yup event';

        $this->url = $url;

        $this->responseCode = $responseCode;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['crawler'];
    }
}