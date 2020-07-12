# SchoolFAQs Shop
 The official repo for the SchoolFAQs Shop
 ### Installation

1. ```bash composer install && npm install```
2. Copy `.env.example` to `.env`
3. Update appropriate `.env` attributes && generate app key with ```bash php artisan key:generate```

### ENV Configuration
4. Set `SMS_NUMBER=<your orange sms number>` 
5. Set `CLIENT_ID=<your orange sms client id>` gotten from your profile in the Orange SMS API platform.
6. Set `CLIENT_SECRET=<your orange client secret>` gotten from your profile in the Orange SMS API platform.
7. Set `APPLICATION_ID=<your orange application id>` gotten from your profile in the Orange SMS API platform.
8. Set `SMS_RATE=<your sms rate>` which is how much a single sms cost (= 22).
9. Set `RATE=<your commision percentage>` which is the percentage of commision earned per sale (= 0.4).
10. Run `php artisan migrate --seed` to create test data

11. In `config\app.php`, set the following attributes:
```
	'sms_number' => env('SMS_NUMBER', <your orange sms number>),
    'client_id' => env('CLIENT_ID'),
    'client_secret' => env('CLIENT_SECRET'),
    'application_id' => env('APPLICATION_ID'),
    'rate' => env('RATE'),
    'sms_rate' => env('SMS_RATE'),

```


### Structure

```
Version Control
|
|--- master (Production Branch)
|
|--- pre-built (Copy of production code) This is where all the minor updates go to
|
|--- dev (ACtive Development branch) (New Features, major updates)
```

	No Code should be pushed to master except reviewed DevOps.
