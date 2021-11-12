# How to use SQS

## Producer

1. Set up queue configuration, for example for `sqs` connection
```
QUEUE_CONNECTION=sqs
SQS_KEY=IAM_USER_ACCESS_KEY
SQS_SECRET=IAM_USER_SECRET_KEY
SQS_QUEUE=QUEUE_NAME
SQS_REGION=YOUR_REGION
SQS_PREFIX=https://sqs.YOUR_REGION.amazonaws.com/USER_ID
```
2. Create an instance of provided models, for example `HubSpotEmail`
3. Fill it with data
```
$email = new HubSpotEmail();
$email->view = {hubspot_email_id};
$email->to = {recipient@email.com};
$email->from = {from@email.com};
```
4. Dispatch with appropriate job, for example `SendEmailJob`:
```
dispatch(new SendEmailJob($email));
```

NOTE: `QUEUE_CONNECTION` and `SQS_QUEUE` are optional and stands for default values.
If you want to specify another `connection` or `queue` use:
```
dispatch(new SendEmailJob($email, {connection_name}, {queue_name}));
```

## Consumer

1. Set up queue configuration, for example for `sqs` connection
```
QUEUE_CONNECTION=sqs
SQS_KEY=IAM_USER_ACCESS_KEY
SQS_SECRET=IAM_USER_SECRET_KEY
SQS_QUEUE=QUEUE_NAME
SQS_REGION=YOUR_REGION
SQS_PREFIX=https://sqs.YOUR_REGION.amazonaws.com/USER_ID
```
2. For mails register custom `Illuminate\Contracts\Mail\Mailer` service or use `illuminate/mail` package
3. Run queue worker: `php artisan queue:work`


NOTE: `QUEUE_CONNECTION` and `SQS_QUEUE` are optional and stands for default values.
If you want to specify another `connection` or `queue` use:
```
php artisan queue:work {connection_name} --queue={queue_name}
```

# How to use SNS

## Producer

1. Set up notification configuration, for example for `sns` channel
```
SNS_KEY=YOUR_SNS_KEY
SNS_SECRET=YOUR_SNS_SECRET
SNS_REGION=YOUR_SNS_REGION
SNS_TOPIC_ARN=YOUR_DEFAULT_SNS_TOPIC_ARN
```
2. Create an instance of provided notifiable models, for example `SubscriptionStatus`
3. Fill it with data
```
$subStatus = new SubscriptionStatus({user_id}, {subscription_id}, {plan_id}, {status});
```
4. Notify using created model with appropriate notification, for example `SubscriptionStatusChangedNotification`:
```
$subStatus->notify(new SubscriptionStatusChangedNotification());
```

NOTE: `SNS_TOPIC_ARN` is optional and stands for default values.
If you want to specify another `topic` use:
```
$subStatus->notify(new SubscriptionStatusChangedNotification({subject}, {topic}));
```

## Consumer

1. Create endpoint for handling notifications or if using queue follow `How to use SQS` guide
2. For `SubscriptionStatus` register endpoint, for example `/sns/subscriptions`
3. Retrieve message `$snsService->retireve();`
4. Provide endpoint confirmation:
```
if ($this->snsService->isSubscriptionConfirmation($message)) {
    $this->snsService->confirmSubscription($message);
    return response(null);
}
```
5. Get message content `$this->snsService->getMessageContent($message)`