Usage
=====

To show match lineup for season "s" and team "t" run:

```
php get.php  s t
```

For example:

```
$ php ./get.php 20812 9
```

Output:

```
Current/next match starts at 2016-09-25T17:45:00+00:00:

1. FC Köln
Abwehr: Jonas Hector, Dominique Heintz, Mergim Mavraj, Konstantin Rausch, Frederik Sørensen
Torwart: Timo Horn
Mittelfeld: Matthias Lehmann, Marcel Risse
Sturm: Anthony Modeste, Yuya Osako, Simon Zoller

RB Leipzig
Mittelfeld: Oliver Burke, Stefan Ilsanker, Dominik Kaiser, Naby Keita, Marcel Sabitzer
Abwehr: Marvin Compper, Marcel Halstenberg, Willi Orban, Benno Schmitz
Torwart: Péter Gulácsi
Sturm: Davie Selke
```

If there is no lineup for current / next match following message will be shown:
 
```
$ php ./get.php 20812 9
Current/next match starts at 2016-10-01T15:30:00+00:00:
No line-up info for current or next match
```

For debugging you can specify current datetime as 3rd parameter:
 
```
php ./get.php 20812 9 2016-09-25T00:00:00
```

Installation
============

To install dependencies run:
```
composer install
```

If you don't have composer installed, install it with [instruction from official site](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)


Tests
=====

Run test:

```
./vendor/bin/phpunit
```


Coverage report will be located in ./report folder
