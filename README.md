# Usage

1.clone it

```sh
git clone https://github.com/NZRicky/demo2.git demo2
```

2.install package

```
composer install
```

3.start the web server(change the port if you want)

```
php -S localhost:8000
```

4.test it in the browser

```
http://localhost:8000
```

5.for unit test

```
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/ServerTest
```

