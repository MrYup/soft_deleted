<?php
namespace SoftDelete;

trait SoftDelete{

    /**
     * value for marked the row is deleted
     * @var int
     */
    protected static $deletedValue = 1;

    /**
     * value for marked the row is not deleted
     * @var int
     */
    protected static $unDeletedValue = 0;

    /**
     * table column for marking whether the row is deleted
     * @var string
     */
    protected static $softDeleteColumn = 'is_delete';

    /**
     * @return SoftDeleteActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public static function find(){
        /**
         * @var SoftDeleteActiveQuery $query
         */
        $query =  \Yii::createObject(SoftDeleteActiveQuery::className(), [get_called_class()]);
        $query->softDeleteCondition = [self::$softDeleteColumn => self::$unDeletedValue];
        return $query;
    }

    /**
     * @param null $condition
     * @param array $params
     * @param bool $force
     * @return mixed
     */
    public static function deleteAll($condition = null, $params = [],$force = false)
    {
        if ($force){
            return parent::deleteAll($condition,$params);
        }else{
            return parent::updateAll([self::$softDeleteColumn=>self::$deletedValue],$condition,$params);
        }
    }

    public function delete(){
        $column = self::$softDeleteColumn;

        $this->$column = self::$deletedValue;
        $this->save(true,[$column]);
        return true;
    }

    /**
     * @return mixed
     */
    public function forceDelete(){
        $condition = $this->getOldPrimaryKey(true);
        $lock = $this->optimisticLock();
        if ($lock !== null) {
            $condition[$lock] = $this->$lock;
        }

        $command = static::getDb()->createCommand();
        $command->delete(static::tableName(), $condition);

        return $command->execute();
    }




}