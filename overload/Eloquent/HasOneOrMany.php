<?php

namespace Illuminate\Database\Eloquent\Relations;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class HasOneOrMany extends HasOneOrManyOld
{
    const SPECIAL_NORMAL = 0;
    const SPECIAL_SELF_SEPARATE = 1;
    const SPECIAL_ELSE_SEPARATE = 2;

    protected $special;

    /**
     * 赋值special
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Database\Eloquent\Model  $parent
     * @param  string  $foreignKey
     * @param  string  $localKey
     * @param  int  $special
     */
    public function __construct(Builder $query, Model $parent, $foreignKey, $localKey, $special = self::SPECIAL_NORMAL)
    {
        $this->special = $special;
        parent::__construct($query, $parent, $foreignKey, $localKey);
    }

    /**
     * 重载方法
     * Set the base constraints on the relation query.
     *
     * @return void
     */
    public function addConstraints()
    {
        if (static::$constraints) {
            $parentKey = $this->getParentKey();

            switch ($this->special){
                case self::SPECIAL_NORMAL:
                    $this->query->where($this->foreignKey, '=', $this->getParentKey());
                    break;
                case self::SPECIAL_SELF_SEPARATE:
                    $parentKeyArr = explode(',', $parentKey);

                    $this->query->whereIn($this->foreignKey, $parentKeyArr);
                    $this->query->orderByRaw(\DB::raw("FIELD(id,$parentKey)"));
                    break;
                case self::SPECIAL_ELSE_SEPARATE:
                    $this->getParentKey();
                    $this->query->whereRaw(\DB::raw("FIND_IN_SET($parentKey,$this->foreignKey)"));
                    break;
            }

            $this->query->whereNotNull($this->foreignKey);
        }
    }

}
