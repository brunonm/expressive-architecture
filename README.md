# The Expressive Architecture

This repository was created to show some concepts from "Projetando uma arquitetura expressiva" talk. Slides [here](https://www.slideshare.net/brunonm/projetando-uma-arquitetura-expressiva).

## That Book

Platform to find opportunities for book trade among readers.

### Features

 - Symfony 4
 - GraphQL
 - Command Bus by Tactician
 - DDDish

### Setup

```bash
$ composer install
$ php bin/console doctrine:database:create
$ php bin/console doctrine:migrations:migrate
```

### Tests

```bash
$ bin/phpunit
```

### License

Code licensed under MIT
