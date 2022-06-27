AdminLte for Yii2
=================

**AdminLTE for Yii2** is a module for Yii2 framework to get simple administration interface based on [AdminLTE](https://github.com/ColorlibHQ/AdminLTE)
fully responsive administration template and on [Bootstrap 4.6](https://getbootstrap.com/) framework and also the JS/jQuery plugin.

**Warning!** This module is under development! Anything might be changed or even removed! There are no documentation other than comments in code!

## Quick start

There are multiple ways to install the module, but composer from repository would be preferred one until any stable release ready:

    composer config repositories.repo-name vcs https://github.com/ashtokalo/yii2-adminlte
    composer require ashtokalo\yii2-adminlte

Assume you already have Yii2 application, so the only changes you need are:

1. Add module to configuration of web application:

```php
'modules' => [
    // here the other modules
    'adminlte' => [
        'class' => \ashtokalo\yii2\adminlte\Module::class,
    ],
],
```

2. Add the module to bootstrap of web application:

```php
'bootstrap' => [
    // here the other modules
    'adminlte',
],
```

3. Configure sidebar and navbar as web application components:

```php
'components' => [
    // here the other components
    'sidebar' => [
        'class' => \ashtokalo\yii2\adminlte\widgets\Sidebar::class,
        'items' => [
            // here the items of your sidebar
        ],
    ],
    'navbar' => [
        'class' => \ashtokalo\yii2\adminlte\widgets\Navbar::class,
        'items' => [
            // here the items of your navbar
        ],
    ],
],
```

## Contributing

Contributions are **welcome** and will be fully **credited**.

You can take the code and run test application:

```bash
git clone https://github.com/ashtokalo/yii2-adminlte.git
cd yii2-adminlte
composer update
cd test/app
./yii serve &
xdg-open http://localhost:8080
```

Only contributions via Pull Requests on [Github](https://github.com/ashtokalo/yii2-adminlte) is accepted:

- **[PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)**

- **Document any change in behaviour** - Make sure the `readme.txt` and any other relevant documentation are kept up-to-date.

- **Create feature branches** - Don't ask us to pull from your master branch.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

- **Send coherent history** - Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while
developing, please [squash them](http://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages) before submitting.

## License

AdminLTE for Yii2 is an open source project by Alexey Shtokalo that is licensed under [MIT](https://opensource.org/licenses/MIT).

## Credits

- [AdminLTE](https://github.com/ColorlibHQ/AdminLTE)