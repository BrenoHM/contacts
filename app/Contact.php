<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone'
    ];

    public static function index($request)
    {
        $paginacao = json_decode($request->pagination);

        $list = self::where('user_id', auth()->user()->id)
            ->orderBy('name')
            ->paginate($paginacao->per_page, '*', '', $paginacao->current_page);

        return $list;

    }

    public static function store($request)
    {       

        $validate = [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ];

        $params = $request->all(); 
        $validator = Validator::make($params, $validate);

        if( $validator->fails() ) {
            return [
                'success' => false,
                'validators' => $validator->errors()->all()
            ];
        }

        $params['user_id'] = auth()->user()->id;

        $create = self::create($params);

        return [
            'success' => true,
            'data' => $create
        ];

    }

    public static function getbyid($id)
    {

        $getbyid = self::where('id', $id)->first();

        return $getbyid;
    }

    public static function edit($request)
    {

        $updated = self::where('id', $request->id)->update($request->all());

        return $updated;

    }

    public static function remove($request)
    {
        $deleted = self::where('id', $request->id)->delete();

        return $deleted;

    }
}
