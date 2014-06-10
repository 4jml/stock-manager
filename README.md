# Stock Manager

## Installation

Clone the project and run the following commands at the repository root:

```
php composer.phar install # Install all the dependencies
php server/artisan migrate --seed # Run the database migrations
```

## Contributing

When contributing, the assets can be automatically compiled with Gulp, to activate this feature, run these commands:

```
cd client
gulp watch
```

To run a unique compilation by hand, simply run `gulp`.