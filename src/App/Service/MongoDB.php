<?php

namespace App\Service;

use MongoDB\BSON\ObjectID;
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
     * @var BulkWrite
     */
    protected $bulkWrite;

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
        $this->bulkWrite = new BulkWrite();
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
     * Get the entity with this id
     *
     * @param string $collection
     * @param string $id
     * @return \stdClass|null
     */
    public function findById($collection, $id)
    {
        $result = $this->where($collection, ['_id' => $this->getObjectId($id)])->toArray();

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
     * @param mixed $data
     * @return $this
     */
    public function insert($data)
    {
        $this->bulkWrite->insert($data);
        return $this;
    }

    /**
     * Update document in collection
     *
     * @param array $filter
     * @param mixed $data
     * @return $this
     */
    public function update(array $filter, $data)
    {
        $this->bulkWrite->update($filter, $data);
        return $this;
    }

    /**
     * Delete document from collection
     *
     * @param array $filter
     * @return $this
     */
    public function delete(array $filter)
    {
        $this->bulkWrite->delete($filter);
        return $this;
    }

    /**
     * Execute bulk write
     *
     * @param string $collection
     * @return WriteResult
     */
    public function flush($collection)
    {
        return $this->manager->executeBulkWrite($this->getNamespace($collection), $this->bulkWrite);
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
     * Get ObjectId from $id
     *
     * @param string $id
     * @return ObjectID
     */
    public function getObjectId($id)
    {
        return new ObjectID($id);
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
     * @return $this
     */
    public function setManager(Manager $manager)
    {
        $this->manager = $manager;
        return $this;
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

    /**
     * Set bulk write
     *
     * @param BulkWrite $bulkWrite
     * @return $this
     */
    public function setBulkWrite(BulkWrite $bulkWrite)
    {
        $this->bulkWrite = $bulkWrite;
        return $this;
    }

    /**
     * Get bulk write
     *
     * @return BulkWrite
     */
    public function getBulkWrite()
    {
        return $this->bulkWrite;
    }
}
