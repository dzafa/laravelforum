<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\User;

abstract class Filters
{
    protected $request; 
    
    protected $query; 
    
    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($query)
    {
        $this->query = $query;

        $this->getFilters()
            ->filter(function ($filter){
               return method_exists($this, $filter);
            })
            ->each(function ($filter, $value){
               $this->$filter($value);
            });

        return $this->query;
    }

    /**
     * @return static
     */
    public function getFilters()
    {
        return collect($this->request->only($this->filters))->flip();
    }
}
