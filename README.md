[Demo](http://3.139.115.130:8000/login)

## Google Login
````
app/Http/Controllers/Auth/LoginController.php
app/Library/GoogleOAuthLogin.php
app/Library/Contracts/GoogleOAuthLoginInterface.php
app/Providers/GoogleOAuthLoginServiceProvider.php
````

## DB
````
DB/collects.sql
DB/DB_Schema.sql
DB/users.sql
````

## Custom auth
````
app/Http/Controllers/Auth/LoginController.php
app/Http/Controllers/Auth/RegisterController.php
app/Library/CustomAuth.php
app/Library/Contracts/CustomAuthInterface.php
app/Providers/CustomAuthServiceProvider.php
````

## web crawler
````
app/Console/Commands/CollectData.php
app/Library/CollectHelper.php
app/Console/Commands/Kernel.php
````