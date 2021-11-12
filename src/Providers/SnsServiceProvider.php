<?php

namespace MedSchoolCoach\LumenNotifications\Providers;

use Aws\Sns\MessageValidator;
use Aws\Sns\SnsClient;
use Illuminate\Notifications\NotificationServiceProvider;
use Illuminate\Support\Arr;
use MedSchoolCoach\LumenNotifications\Services\SnsService;

class SnsServiceProvider extends NotificationServiceProvider
{
    /**
     * @inheritDoc
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->app->configure('sns');
        $this->mergeConfigFrom(realpath(__DIR__.'/../../config/sns.php'), 'sns');

        $this->app->when(SnsChannel::class)
            ->needs(SnsService::class)
            ->give(function () {
                return new SnsService($this->app->make(SnsClient::class));
            });

        $this->app->bind(SnsClient::class, function () {
            $config = array_merge(['version' => 'latest'], $this->app['config']['sns']);

            if (! empty($config['key']) && ! empty($config['secret'])) {
                $config['credentials'] = Arr::only($config, ['key', 'secret', 'token']);
            }

            return new SnsClient($config);
        });
    }
}