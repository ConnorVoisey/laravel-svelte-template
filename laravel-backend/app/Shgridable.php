<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait Shgridable
{
    public function getIndex(Request $request, array $columns, string $tableName, string $resource)
    {
        $limit = min((int) ($request->get('limit') ?? 15), 200);
        $offset = (int) ($request->get('offset') ?? 0);
        $sorters = [];
        $sortReq = $request->get('sort');
        if ($sortReq) {
            $sorters = json_decode($sortReq) ?? [];
        }
        foreach ($sorters as $key => $sorter) {
            if (! (in_array($sorter[0], $columns) && (strtoupper($sorter[1]) === 'ASC' || strtoupper($sorter[1]) === 'DESC'))) {
                unset($sorters[$key]);
            }
        }
        if (count($sorters) === 0) {
            $sorters = [['updated_at', 'desc']];
        }

        $filters = [];
        $filtersReq = $request->get('filters');
        if ($filtersReq) {
            $filters = json_decode($filtersReq) ?? [];
        }
        foreach ($filters as $key => $filter) {
            if (! (in_array($filter[0], $columns) && (is_string($filter[1])))) {
                unset($sorters[$key]);
            }
        }

        $getBuilder = function () use ($filters, $sorters, $tableName) {
            $builder = DB::table($tableName);
            foreach ($filters as $filter) {
                $builder->where($filter[0], 'LIKE', "%$filter[1]%");
            }
            foreach ($sorters as $sorter) {
                $builder->orderBy($sorter[0], strtolower($sorter[1]));
            }

            return $builder;
        };

        $data = $getBuilder()->limit($limit)->offset($offset)->get();
        $data = $this->mapToResource($data, $resource);

        return [
            'data' => $data,
            'count' => $getBuilder()->count(),
        ];
    }

    public function mapToResource(Collection $arr, string $resource)
    {
        return $arr->map(fn ($val) => new $resource($val));
    }
}
