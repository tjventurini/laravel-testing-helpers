<?php

namespace Tjventurini\LaravelTestingHelpers\Traits;

use \Illuminate\Support\Fluent;
use \Illuminate\Database\Connection;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\SQLiteConnection;
use \Illuminate\Database\Schema\SQLiteBuilder;

/**
 * Trait SupportDroppingForeignKeysSqlite
 *
 * @package Tests
 */
trait SupportDroppingForeignKeysSqlite
{
    /**
     * Add support dropping foreign keys to Sqlite
     */
    public function supportDroppingForeignKeys()
    {
        Connection::resolverFor('sqlite', function ($connection, $database, $prefix, $config) {
            return new class($connection, $database, $prefix, $config) extends SQLiteConnection {
                public function getSchemaBuilder()
                {
                    if ($this->schemaGrammar === null) {
                        $this->useDefaultSchemaGrammar();
                    }
                    return new class($this) extends SQLiteBuilder {
                        protected function createBlueprint($table, \Closure $callback = null)
                        {
                            return new class($table, $callback) extends Blueprint {
                                public function dropForeign($index)
                                {
                                    return new Fluent();
                                }
                            };
                        }
                    };
                }
            };
        });
    }
}
