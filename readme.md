# Backoffice [![Framework](https://img.shields.io/badge/Laravel-v5.7.20-green.svg)](https://packagist.org/packages/laravel/framework) [![License](https://poser.pugx.org/laravel/framework/license)](https://packagist.org/packages/laravel/framework)

This repo contains the source code of our backoffice.

## Example

<img style="max-width:100%; height: auto" src="https://github.com/rguerreiro7/Backoffice/blob/master/public/images/backoffice_preview.png">

Our basic version of the backoffice has the following options:

- Dashboard with simple graphs to preview some google analytics data
- Services (CRUD)
- Slider (CRUD)
- News (CRUD)
- Privacy Policy (CRUD)
- Contacts (CRUD)
- Logs
- Users (CRUD)

## How it works

Fully functional and customizable Backoffice to manage all dynamic data of a website Frontend.
Developed with the purpose of having a dynamic Backoffice ready to support any kind of website and it's needs.

## Installation

Install this package by cloning this repository and install like you normally install Laravel.

- Run `composer install` and `npm install`
- Run `npm run dev` to generate assets
- Copy `.env.example` to `.env` and fill your values (`php artisan key:generate`, database, etc)
- Run `php artisan migrate --seed`, this will seed a default user (values can be verified in the file `database/seeds/AdminsSeeder.php`).
- Run `php artisan serve`.
- Open the backoffice in your browser (don't forget to add `/admin` at the end), login and done.

## Support

This backoffice is tailormade to our needs, for our personal use on a daily basis.
We do not follow [semver](http://semver.org) for this project and do not provide support whatsoever. However if you're a bit familiar with Laravel you should easily find your way.

For more details on the project, feel free to contact us.

## Developed by

- [Fábio Fernandes](https://github.com/fabiomiguelmfernandes)
- [Ricardo Guerreiro](https://github.com/rguerreiro7)

## License

This project and the Laravel framework are open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
