<?php
namespace SoftDelete;


use yii\db\ActiveQuery;

/**
 * for building query without the rows that were soft-deleted,
 * we just need to add the filter (like `table`.`deleted_at` is null) condition
 * before where structure built
 * @property mixed $softDeleteCondition - condition that filtered the soft-deleted rows,if empty,would select all
 * including  soft-deleted rows
 * Class SoftDeleteActiveQuery
 * @package common\traits\SoftDelete
 */
class SoftDeleteActiveQuery extends ActiveQuery{

    public $softDeleteCondition = '';

    public function all($db = null)
    {
        //before where structure built,add the soft-deleted filter to the model where mapper
        if ($this->softDeleteCondition){
            $this->andWhere($this->softDeleteCondition);
        }

        return parent::all($db); // TODO: Change the autogenerated stub
    }

    public function one($db = null)
    {
        //before where structure built,add the soft-deleted filter to the model where mapper
        if ($this->softDeleteCondition){
            $this->andWhere($this->softDeleteCondition);
        }

        return parent::one($db); // TODO: Change the autogenerated stub
    }

    /**
     * search all, the soft-deleted rows included
     * @return $this
     */
    public function withSoftDelete(){
        $this->softDeleteCondition = '';
        return $this;
    }
}