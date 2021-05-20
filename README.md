[Demo](http://kyrie.ddns.net:8000/login)

使用Laravel實作以下功能
## Custom auth
註冊、登入登出功能
````
app/Http/Controllers/Auth/LoginController.php
app/Http/Controllers/Auth/RegisterController.php
app/Library/CustomAuth.php
app/Library/Contracts/CustomAuthInterface.php
app/Providers/AuthServiceProvider.php
````

## Google Login
Google帳號登入功能
````
app/Http/Controllers/Auth/LoginController.php
app/Library/GoogleOAuthLogin.php
app/Library/Contracts/OAuthLoginInterface.php
app/Providers/AuthServiceProvider.php
````

## web crawler
定時爬蟲
````
app/Console/Commands/CollectData.php
app/Library/CollectHelper.php
app/Console/Commands/Kernel.php
````


## DB Schema
````
DB/collects.sql
DB/DB_Schema.sql
DB/users.sql
````