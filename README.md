# chat-laravel-redis
This is an Implementation for a realtime chat application using Laravel, Redis real-time, laravel-echo-server, Socket-IO, Blade, and SQL

## Installation Steps

1. Clone the repository.
2. Create a MySQL database with your favorite name ex:"blogs".
3. Run the following commands:

```
composer install
```

```
cat .env.example > .env
```

```
php artisan key:generate
```

4. Customize the vars in the `.env` file with your database info.
5. Run migration and seed:

```
php artisan migrate --seed
```

6. Install redis-server:

```
sudo apt install redis-server
```
--> MAKE SURE redis is working <---

7. install laravel-echo-server and run it
```
sudo npm install -g laravel-echo-server

laravel-echo-server start
```

8. Start the application:

```
php artisan serve
```
9. Start vite:

```
npm install
npm run dev
```

and open this URL in your browser `127.0.0.1:8000`
use this these credentials for login email: `super_admin@app.com` pass: `12345678`

## Usage

create two users in separate browsers then go ahead :)

## Donation

If you find this helpful, consider buying me a coffee :)

<center>

[![QR Code for Donation](https://github.com/islamsamy214/admin-laravel-vue-bootstrap/blob/master/public/bmc_qr.png?raw=true)](https://www.buymeacoffee.com/islamsamy)

</center>