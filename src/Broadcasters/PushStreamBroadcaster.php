<?php


namespace twinkle\pusher\Broadcasters;


use Illuminate\Broadcasting\Broadcasters\Broadcaster;
use Illuminate\Broadcasting\Broadcasters\UsePusherChannelConventions;
use twinkle\pusher\PushStream;

class PushStreamBroadcaster extends Broadcaster
{
    use UsePusherChannelConventions;

    protected $pusher;

    public function __construct(PushStream $pusher)
    {
        $this->pusher = $pusher;
    }

    /**
     * Authenticate the incoming request for a given channel.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function auth($request)
    {
        // TODO: Implement auth() method.
    }

    /**
     * Return the valid authentication response.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $result
     * @return mixed
     */
    public function validAuthenticationResponse($request, $result)
    {
        // TODO: Implement validAuthenticationResponse() method.
    }

    /**
     * Broadcast the given event.
     *
     * @param array $channels
     * @param string $event
     * @param array $payload
     * @return void
     */
    public function broadcast(array $channels, $event, array $payload = [])
    {
        foreach ($channels as $channel) {
            $payload = [
                'text' => array_merge(['eventtype' => $event], $payload)
            ];
            $this->pusher->trigger($channel, ['json' => $payload]);
        }
        $this->pusher->send();
    }

}
