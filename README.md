
## Steps to setup MyBooks SPA App

- rename .env.example file to .env
- enter the DB credentials

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

- to send emails, need to enter smtp credentials
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"


run these commands to install all dependecies
- composer install
- npm install

generate APP_KEY
-php artisan key:generate

run this command to create tables
- php artisan migrate

run this to generate outh key for passport auth:
- php artisan passport:install

to run the application
- php artisan serve

to run npm open another terminal
- npm run wacth 

to send  queued email
- php artisan queue:work
