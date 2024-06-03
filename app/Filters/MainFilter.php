<?php

namespace App\Filters;

use Illuminate\Http\Request;

class MainFilter
{
	public $entity;
	public $primary_key;

	public function filter(Request $request)
	{
	    if(($request->has('search')) || ($request->has('search_id')))
        {
            set_time_limit(60 * 60 * 5);
            $filter = $this->entity;

            if($request->has($this->primary_key) && ($request->get($this->primary_key) != ''))
            {
                $filter->where('id', $this->primary_key);
            } else {
                $request->request->remove($this->primary_key);
                if($request->has('status') && ($request->get('status') != '')){
                    switch ($request->get('status')){
                        case 0:
                            $filter = $filter->inactive();
                            break;
                        case 1:
                            $filter = $filter->active();
                            break;
                    }

                }
            }

            $this->entity = $filter;
        }
	}

	public function preFilter(Request $request, $entity)
	{
        $this->entity = $entity;
        if($request->has('search') || $request->has('search_id')) {
            $this->filter($request);
        } else {
            $this->entity->active();
        }
        return $this->entity;
	}

	public function map(Request $request, $entity, $pagination = false)
	{
		if($request->has('search') || $request->has('search_id')){
            $this->preFilter($request, $entity);
			if(!is_a($this->entity, 'Illuminate\Database\Eloquent\Collection')) {
                $filter = $this->makeResponse($this->entity);
			};
		} else {
			return [];
		}

        if($pagination){
            return [
                'filter'=>$filter,
                'items' =>$filter->getCollection()->transform(function($s){
                    return $this->makeResponse($s);
                })
            ];
        }
        return $filter->map(function($s){
            return $this->makeResponse($s);
        });
	}

    public function makeResponse($filter)
    {
        return $filter;
    }
}
