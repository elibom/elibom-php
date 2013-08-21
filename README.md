
<h1>Elibom PHP API Client</h1>
==========

A php client of the Elibom REST API. <a href="http://www.elibom.com/developers/reference">The full API reference is here</a>


<h2>Requisites</h2>

cURL (apt-get install php5-curl)

<h2>Getting stared</h2>

1. Install

    pear install https://github.com/carlossepulveda/elibom-php/raw/master/download/ElibomClient-0.0.1.tgz
    
    or
    
    download sources files https://github.com/carlossepulveda/elibom-php/raw/master/download/ElibomSRC.zip and decompress
    in your project folder.

2. Create an ElibomRestClient object passing your credentials:

    require('elibom/elibom.php');

    $elibom = new ElibomClient('your.email@domain','your_api_token');
    
    Note: You can find your api password at http://www.elibom.com/api-password (make sure you are logged in).
    
    You are now ready to start calling the API methods!

<h2>API Methods</h2>

* [Send SMS](#send-sms)
* [Schedule SMS](#schedule-sms)
* [Show Delivery](#show-delivery)
* [List Scheduled SMS Messages](#list-scheduled-sms-messages)
* [Show Scheduled SMS Message](#show-scheduled-sms-message)
* [Cancel Scheduled SMS Message](#cancel-scheduled-sms-message)
* [List Users](#list-users)
* [Show User](#show-user)
* [Show Account](#show-account)

### Send SMS
```php
//Return string
$deliveryId = $elibom->sendMessage('3201111111','PHP - TEST');
```

### Show Delivery
```php
//Return json object
$delivery = $elibom->getDelivery('<delivery_token>');
```

### Schedule SMS 
```php
//Return string
$scheduleId  = $elibom->scheduleMessage('3204470262', 'Test PHP', 'dd/MM/yyyy hh:mm');
```

### List Scheduled SMS Messages
```php
//Return json array
$scheduledMessages = $elibom->getScheduledMessages();
```

### Show Scheduled SMS Message
```php
//Return json object
$schedule = $elibom->getScheduledMessage('<schedule_id>');
```

### Cancel Scheduled SMS Message
```php
//Void
$elibom->unscheduleMessage('<schedule_id>');
```

### List Users
```php
//Return json array
$users = $elibom->getUsers();
for($users as $user) {
    echo json_encode($user);
}
```

### Show User
```php
//Return json object
$user = $elibom->getUser('<user_id>');
```

### Show Account
```php
//Return json object
$account = $elibom->getAccount();
```
