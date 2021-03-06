# Laravel Testing Helpers

Helpers to test your laravel application.

## Usage

```
composer require --dev tjventurini/laravel-testing-helpers
```

## Support Dropping Foreign Keys in SQLite

Add the following to your base test case.

```php
use Marqant\SupportDroppingForeignKeysSqlite;

abstract class TestCase extends BaseTestCase
{
    use SupportDroppingForeignKeysSqlite;

    protected function setUp(): void
    {
        $this->supportDroppingForeignKeys();
        parent::setUp();
    }

    // ...
}
```