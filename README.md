silex-orm-skeleton
==================

Silex skeleton with doctrine ORM, bootstrap and CRUD example.

For doctrine documentation see symfony and doctrine docs.


Install composer:
```bash
curl -s https://getcomposer.org/installer | php
```
More information on Composer can be found on [getcomposer.org](http://getcomposer.org/).

And install your dependencies:

```bash
php composer.phar install
```

Set your database information in src/app.php:
```bash
$app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'        => 'pdo_mysql',
        'host'          => 'localhost',
        'dbname'        => 'xxx',
        'user'          => 'xxx',
        'password'      => 'xxx',
    ),
));
```

Create database and generate schema with CLI tool (for acme demo):

```bash
php bin/console doctrine:schema:update --force
```

Commandes available:

```bash
php bin/console --info
```

```bash
Available commands:
  help                             Displays help for a command
  list                             Lists commands
dbal
  dbal:import                      Import SQL file(s) directly to Database.
  dbal:reserved-words              Checks if the current database contains identifiers that are reserved.
  dbal:run-sql                     Executes arbitrary SQL directly from the command line.
orm
  orm:clear-cache:metadata         Clear all metadata cache of the various cache drivers.
  orm:clear-cache:query            Clear all query cache of the various cache drivers.
  orm:clear-cache:result           Clear result cache of the various cache drivers.
  orm:convert-d1-schema            Converts Doctrine 1.X schema into a Doctrine 2.X schema.
  orm:convert-mapping              Convert mapping information between supported formats.
  orm:ensure-production-settings   Verify that Doctrine is properly configured for a production environment.
  orm:generate-entities            Generate entity classes and method stubs from your mapping information.
  orm:generate-proxies             Generates proxy classes for entity classes.
  orm:generate-repositories        Generate repository classes from your mapping information.
  orm:info                         Show basic information about all mapped entities
  orm:run-dql                      Executes arbitrary DQL directly from the command line.
  orm:schema-tool:create           Processes the schema and either create it directly on EntityManager Storage Connection or generate the SQL output.
  orm:schema-tool:drop             Drop the complete database schema of EntityManager Storage Connection or generate the corresponding SQL output.
  orm:schema-tool:update           Executes (or dumps) the SQL needed to update the database schema to match the current mapping metadata.
  orm:validate-schema              Validate that the mapping files.
```
