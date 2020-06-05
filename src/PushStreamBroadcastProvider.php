<?php


namespace twinkle\pusher;


use Illuminate\Broadcasting\BroadcastManager;
use Illuminate\Support\ServiceProvider;
use twinkle\pusher\Broadcasters\PushStreamBroadcaster;

class PushStreamBroadcastProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app->make(BroadcastManager::class)->extend('push-stream', function ($app, $config) {
            $pusher = new PushStream($config['pub_path'], $config['base_uri']);
            return new PushStreamBroadcaster($pusher);
        });
    }

}
