# Meetio
> Simple platform for creating and joining meetings.

Browse meetings which are added to site, create your own meeting letting people to know about it, or join
meetings yourself :)

![Meetio](meetio.png?raw=true)

## Installation

Front-end (Vue)
```sh
cd app
npm install
npm run build # npm run watch when developing :)
```

Set your database details in config.env file, then run those commands.

config.env should like like this

```javascript
DB_HOST=
DB_NAME=
DB_USER=
DB_PASS=
```

Back-end
```sh
composer install
vendor/bin/doctrine orm:schema-tool:create --dump-sql
cd public
php -S localhost:8000 # or use Heorku?
```

Make sure that you serve "/public" directory.

Navigate to "/app/" to access front-end of app.

## Made with those libraries

* [Symfony Components](https://symfony.com/components) - HttpFoundation, DotEnv, HttpKernel, EventDispatcher, Routing
* [Doctrine/ORM](https://www.doctrine-project.org/projects/orm.html) - Database
* [Vue.js](https://vuejs.org/) - Front-end framework
* [Bootstrap](http://getbootstrap.com/) - CSS Framework
* [Font-Awesome](https://fontawesome.com/icons?d=gallery) - Icons
* [Axios](https://github.com/axios/axios) - HTTP Requests
* [Moment](https://github.com/moment/moment/) - Dates
* [querystring](https://github.com/Gozala/querystring)

## Meta

Damian Balandowski – balandowski@icloud.com

[https://github.com/damianbal](https://github.com/damianbal)


