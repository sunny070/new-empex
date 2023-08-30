## How To Install

Run below code to install empex

- clone repository
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan storage:link
- php artisan migrate --seed

## Background Command

Using [PM2](https://pm2.keymetrics.io)

- pm2 start empex-queue.yml
- pm2 logs {id} (view log)
- pm2 monit (monitor)

## Task Schedule

Create a task schedule to run `archive:employee`
