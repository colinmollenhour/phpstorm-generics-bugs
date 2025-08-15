<?php

final class Mage
{
    /**
     * @param   string $modelClass
     * @param   array $arguments
     * @return  object|false
     */
    public static function getSingleton(string $modelClass = '', array $arguments = [])
    {
        // Not the actual logic - just something simple and opaque to the IDE for testing
        if ($modelClass) {
            $className = ucwords($modelClass, '_');
            return new $className();
        }
        return false;
    }
}

#[\AllowDynamicProperties]
class Varien_Object { }

abstract class Model_Abstract extends Varien_Object { }

/**
 * @template-covariant T of Varien_Object
 * @implements IteratorAggregate<T>
 */
class Varien_Data_Collection implements IteratorAggregate
{
    /**
     * @return Traversable<T>
     */
    public function getIterator(): Traversable
    {
        $className = get_class($this).'_Testing';
        return new ArrayIterator([
            'item1' => new $className(),
            'item2' => new $className(),
        ]);
    }

    /**
     * @param int|string $idValue
     * @return  T|null
     */
    public function getItemById(int|string $idValue)
    {
        $className = get_class($this).'_Testing';
        return new $className($idValue);
    }
}
