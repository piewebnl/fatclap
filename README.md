# Fatclap

Food application to maintain a daily menu for meals and keep track of nutrition values  (Calarories, Carbs, Fats and Proteins).

-Create and edit Meals
-Create and edit Mealtypes (Lunch, Diner...)
-Create and edit Cookbooks

-Show a weekly menu
-Show today's menu and edit/re-order the menu

-Show nutrition values (per week, day or meal)


# How to install?

composer dump-autoload

run migrate
php artisan migrate:fresh

db:seed

php artisan storage:link

# Registration

Registration & Profile management is disabled by default, but can be enabled in:

/config/fortify.php
   'features' => [];


# Demo

Running demo at
https://fatclap.pieweb.nl/

Login:
info@pieweb.nl

Pass:
9tjF#ger7De


## Testing

Setup your database in config.php under

TEST_DB_HOST=127.0.0.1
TEST_DB_PORT=3306
TEST_DB_DATABASE=
TEST_DB_USERNAME=root
TEST_DB_PASSWORD=

Run the tests with:

composer test


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information.


# Tech

Created using Laravel, Vue2 and Tailwind CSS.
This package requires PHP 7.3.


## Credits

- [PieWeb] (https://github.com/piewebnl)


## License

Copyright 2021

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.



