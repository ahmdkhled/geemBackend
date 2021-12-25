<?php
namespace App\Http\Traits;


trait GeneralTrait{

    public static function DatabaseError($msg)
    {
        return response()->json([
            "stat"=>422,
            "error"=>$msg
        ],422);
    }
}
