<?php

namespace App\Service;

use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Command;
use MongoDB\Driver\Cursor;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;
use MongoDB\Driver\WriteResult;

class MongoDB
{
    /**
     * @var Manager
     */
    protected $manager;

    /**
     * @var string
     */
    protected $database;

    /**
     * Constructor
     *
     * @param string $uri
     * @param string $database
     */
    public function __construct($uri, $database)
    {
        $this->manager = new Manager($uri);
        $this->database = $database;
    }

    /**
     * Get all entities from of collection
     *
     * @param string $collection The collection name
     * @return Cursor
     */
    public function findAll($collection)
    {
        return $this->where($collection, []);
    }

    /**
     * Get the first entity that respects the filter
     *
     * @param string $collection The collection name
     * @param array $filter
     * @return \stdClass|null
     */
    public function find($collection, array $filter)
    {
        $result = $this->where($collection, $filter)->toArray();

        if (!empty($result))
            return $result[0];

        return null;
    }

    /**
     * Get entities that respect the filter
     *
     * @param string $collection
     * @param array $filter
     * @return Cursor
     */
    public function where($collection, array $filter)
    {
        return $this->manager->executeQuery($this->getNamespace($collection), new Query($filter));
    }

    /**
     * Insert document in collection
     *
     * @param string $collection
     * @param mixed $data
     * @return WriteResult
     */
    public function insert($collection, $data)
    {
        $bulkWrite = new BulkWrite();
        $bulkWrite->insert($data);

        return $this->manager->executeBulkWrite($this->getNamespace($collection), $bulkWrite);
    }

    /**
     * Update document in collection
     *
     * @param string $collection
     * @param array $filter
     * @param mixed $data
     * @return WriteResult
     */
    public function update($collection, array $filter, $data)
    {
        $bulkWrite = new BulkWrite();
        $bulkWrite->update($filter, $data);

        return $this->manager->executeBulkWrite($this->getNamespace($collection), $bulkWrite);
    }

    /**
     * Delete document from collection
     *
     * @param string $collection
     * @param array $filter
     * @return WriteResult
     */
    public function delete($collection, array $filter)
    {
        $bulkWrite = new BulkWrite();
        $bulkWrite->delete($filter);

        return $this->manager->executeBulkWrite($this->getNamespace($collection), $bulkWrite);
    }

    /**
     * Execute a MongoDB query
     *
     * @param string $namespace The collection's namespace
     * @param array $filter The query filter
     * @param array $options The query options
     * @return Cursor
     */
    public function query($namespace, array $filter, array $options = [])
    {
        return $this->manager->executeQuery($namespace, new Query($filter, $options));
    }

    /**
     * Execute a MongoDB command
     *
     * @param mixed $command
     * @return Cursor
     */
    public function command($command)
    {
        return $this->manager->executeCommand($this->database, new Command($command));
    }

    /**
     * Get a collection's namespace
     *
     * @param string $collection The collection name
     * @return string
     */
    public function getNamespace($collection)
    {
        return $this->database . '.' . $collection;
    }

    /**
     * Set manager
     *
     * @param Manager $manager
     */
    public function setManager(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Get manager
     *
     * @return Manager
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Set database
     *
     * @param $database
     * @return $this
     */
    public function setDatabase($database)
    {
        $this->database = $database;
        return $this;
    }

    /**
     * Get database
     *
     * @return string
     */
    public function getDatabase()
    {
        return $this->database;
    }
}