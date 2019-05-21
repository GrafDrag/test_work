## For install application:
1. Clone repository
2. Install dependencies with Composer
```
    composer install  
```
3. Edit the file `config/db.php` with real data, for example:   
```php
   return [
       'class' => 'yii\db\Connection',
       'dsn' => 'mysql:host=localhost;dbname=yii2basic',
       'username' => 'root',
       'password' => '1234',
       'charset' => 'utf8',
   ];
```
4. Create database and update it by applying migrations.
```
    php yii migrate
```