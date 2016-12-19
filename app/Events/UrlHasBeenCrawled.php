<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UrlHasBeenCrawled implements ShouldBroadcast
{
    /** @var string */
    public $url;

    /** @var string */
    public $responseCode;

    /** @var string */
    public $title;

    public function __construct(string $url, string $responseCode = '', string $title = '')
    {
        $this->url = $url;

        $this->responseCode = $responseCode;

        $this->title = $title;
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