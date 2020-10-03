<p align="center">
    <a href="https://avored.com/" target="_blank"><img src="logo.svg" height="86" alt="AvoRed"></a>
</p>

<p align="center">
    <a href="https://circleci.com/gh/avored/framework/tree/master"><img src="https://circleci.com/gh/avored/framework/tree/master.svg?style=shield" alt="CircleCI"></a>
    <a href="https://packagist.org/packages/avored/framework"><img src="https://poser.pugx.org/avored/framework/downloads" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/avored/framework"><img src="https://poser.pugx.org/avored/framework/v/stable" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/avored/framework"><img src="https://poser.pugx.org/avored/framework/license" alt="License"></a>
</p>


# Core package for AvoRed Shopping Cart
AvoRed Framework contains the core features for the AvoRed E-commerce for Laravel. It is the base behind the AvoRed and Laravel Ecommerce.

## Requirements
At this stage the minimum Lavarel version required is 5.8. If you are using an older version, let us know at our [Discussion Forum](https://avored.com/discussion). We can test if it works and add support for that version too.

## Installation
The AvoRed E-commerce framework is provided as a composer package, so it makes installation of AvoRed as easy as:

     composer require avored/framework

Once this is finished, you will need to run a few commands to finish up and then you are ready to roll.

## Publish the files
Publish the AvoRed E-commerce framework config file and assets (JS/CSS and images):

    php artisan vendor:publish --provider="AvoRed\Framework\AvoRedProvider"

Once all the files are published, we can run the command to install the required database tables.

    php artisan avored:install

We are almost there. Now create your Administrator Account by running:

    php artisan avored:admin:make


That's It. 

Now visit:

    yoursiteurl.com/admin
