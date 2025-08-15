<?php

class Model_Movement { }

class Model_Movement_Collector
{
    /**
     * @param Model_Movement $movement
     * @throws Exception
     */
    public function add(Model_Movement $movement)
    {
        return;
    }
}

class Mage_AdminNotification_Model_Inbox extends Model_Abstract
{
    /**
     * @param int $severity
     * @param string $title
     * @param string|array $description
     * @param string $url
     * @param bool $isInternal
     * @return $this
     */
    public function add($severity, $title, $description, $url = '', $isInternal = true)
    {
        return $this;
    }
}

try {
    $movement = new Model_Movement();
    Mage::getSingleton('movement_collector')->add($movement); // GOOD
    Mage::getSingleton('movement_collector')->add(2, 'foo', 'bar', 'baz', true); // GOOD: Should have error: Expected parameter of type 'Model_Movement', 'int' provided
} catch (Exception $e) { }
