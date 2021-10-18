# How to use

## Producer

1. Create an instance of provided models, for example `HubSpotEmail`
2. Fill it with data
```
$email = new HubSpotEmail();
$email->view = {hubspot_email_id};
$email->to = {recipient@email.com};
$email->from = {from@email.com};
```
3. Dispatch with appropriate job, for example `SendEmailJob`:
```
dispatch(new SendEmailJob($email));
```

## Consumer

1. Set up queue configuration, for example for `sqs` connection
2. For mails register custom `Illuminate\Contracts\Mail\Mailer` service or use `illuminate/mail` package
3. Run queue worker: `php artisan queue:work`