# Core package for avored shopping cart
AvoRed Framework contains the core features for the AvoRed E commerce for Laravel. It is the base behind the AvoRed an Laravel Ecommerce.

[![Coverage Status](https://coveralls.io/repos/github/avored/framework/badge.svg?branch=master)](https://coveralls.io/github/avored/framework?branch=master)

#### Installation
AvoRed E commerce framework provided as a composer package so it make installation of the avored is much easier as

     composer require avored/framework

At these stage we been using latest laravel framework which is 5.8 if you are using some older version let us know at our [Discussion Forum](https://www.avored.com/discussion). We will do a test and if it works then add support for that version too.

Once these finished then you have to run few command to finished up and then you are ready to roll.

#### Publish the Files
Publish the AvoRed E commerce framework config 
file and assets(JS/CSS and Images).

    php artisan vendor:publish --provider="AvoRed\Framework\AvoRedProvider"


Once the all the file is publish then we run below command to install the required database tables.

    php artisan avored:install

We almost there and now create your Administrator Account by running 

    php artisan avored:admin:make


That's It. 

Now Visit

    yoursiteurl.com/admin
