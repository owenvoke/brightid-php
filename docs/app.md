# App API

[Back to the navigation](README.md)

Allows interacting with the App API.

### Get a list of all apps

```php
$response = $client->apps()->all();
```

### Get details about an app

```php
$response = $client->app()->show($id);
```
