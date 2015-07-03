Laravel - Common classes and services
---

## Test

### Configuration

#### Enviroment parameters

We will need to setup the following enviroments parameters in order to make the testing helpers work.

```
FACTORIES_PATH      =   [...]
MIGRATIONS_PATH     =   [...]
MODELS_NAMESPACE    =   [...]
```

Will find the following tratis to be used in our `TestCase`

##### Api.php

This `trait` will provide us with a bunch of methods to help us when testing APIs

```
// Decode as json the response from call and store it on jsonResponse object
getJson()

// Asserts that an object has a specified attributes
assertObjectHasAttributes()
```

##### CleanDatabase.php

Method used to clean the database, this will be a specific method in charge of restart all the autoincrement index, truncate the tables if needed and all the tasks related to prepare the database before each the test case

I was needed to seed the database for each test case independently, however I ran into a problem in where the `autoincrement` value of my tables do not get restarted when `rolling back` or when using a `transaction`

We can use Laravel trait `DatabaseTransactions` to delete all our just saved records after each `test case` however that won't restart the index database's table, which you could need if you need to access any of the elements that you have saved into the database previously.

> Note: This just work at the moment with Postgres database, you could if you whish at a PR for other Database

##### MigrateDatabase.php

Trait used to migrate the database according to our environment parameter MIGRATIONS_PATH

```php
/**
 * @beforeClass
 */
public static function migrateDatabase()
{
    // migrate database according to our environment parameter MIGRATIONS_PATH
    Artisan::call('migrate', ['--path' => env('MIGRATIONS_PATH', 'database/migrations')]);
}
```

##### RelocateFactories.php

Trait used to relocate Factories according to our environment parameter FACTORIES_PATH, by default Laravel use the factories that are on the path `database/factories` however to override this behaviour and use our own path for the factories is no trivial.

[more info](https://laracasts.com/discuss/channels/laravel/l51-how-to-change-factories-path-when-using-model-factories)

##### ResetModelEvent.php

Trait used to reset Models' events after each test to trigger eloquent models events when testing

[more info](https://github.com/laravel/framework/issues/1181)