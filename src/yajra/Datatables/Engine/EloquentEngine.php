<?php namespace yajra\Datatables\Engine;

/**
 * Laravel Datatables Eloquent Engine
 *
 * @package    Laravel
 * @category   Package
 * @author     Arjay Angeles <aqangeles@gmail.com>
 */

use Illuminate\Database\Eloquent\Builder;

class EloquentEngine extends BaseEngine implements EngineContract
{

    /**
     * @param Builder|HasMany|... $model
     * @param $request
     */
    public function __construct($model, $request)
    {
        $this->query_type = 'eloquent';
        $this->query = $model instanceof Builder ? $model : $model->getQuery();
        $this->columns = $this->query->getQuery()->columns;
        $this->connection = $this->query->getQuery()->getConnection();

        if ($this->isDebugging()) {
            $this->connection->enableQueryLog();
        }

        parent::__construct($request);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getResults()
    {
        return $this->result_object->toArray();
    }

}