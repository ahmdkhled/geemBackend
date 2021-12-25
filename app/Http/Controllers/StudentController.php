<?php

namespace App\Http\Controllers;

use App\Models\exam;
use App\Models\exam_subsection;
use App\Models\material;
use App\Models\question;
use App\Models\section;
use App\Models\subSection;

use App\Models\User_detail;
use Dflydev\DotAccessData\Data;
use http\Env\Response;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;
use function PHPUnit\Framework\isEmpty;

class StudentController extends Controller
{

    public function completeProfile(Request $request)
    {
        //dd($request);
        $rules=[
            'userName'=>'required|unique:user_details,username',
            'fullName'=>'required|string',
            'gov'=>'required|alpha',
            'user_id'=>'required|exists:users,id',
            'category_id'=>'required|exists:category,id',
            //'role_id'=>'required'

        ];
        $data=$request->except('_token');
        $validator=Validator::make($data,$rules);
        if ($validator->fails())
        {
            return response()->json([
                'stat'=>422,
                'error'=>$validator->errors()->first(),
            ],422);
        }
        try {
            User_detail::create([
                'username'=>$request->userName,
                'fullName'=>$request->fullName,
                'gov'=>$request->gov,
                'role_id'=>2,
                'user_id'=>$request->user_id,
                'category_id'=>$request->category_id,
            ]);
            return response()->json([
                'stat'=>200,
                'msg'=>'user created successfully',

            ]);
        }
        catch (Exception $ex)
        {
            DB::rollback();
            return $this->response()->json([
                'stat'=> $ex->getCode(),
                'msg'=>$ex->getMessage()],422);
        }

    }
    public function showmaterial(request $request)
    {
        $rules=[
            'id'=>'required|exists:category,id'
        ];
        $valid=Validator::make($request->all(),$rules);
        if ($valid->fails())
        {

            return response()->json([
                'stat'=>422,
                'error'=> $valid->errors()->first()
            ],422);
        }

//
$materialid=$request->id;
        $material=material::withCount(["section"])->with(['section'=>function($query){
        $query->withCount('sub_section')->get();
    }])->where('category_id',$request->id)->get();
//        $count=0;
//$response=collect();
//        foreach ($material as $sub)
//        {
//            foreach ($sub->section as $num)
//            {
//            $count=$count+$num->sub_section_count;
//            }
////dd($count);
//            $material->setAttribute('sub_count',$count);
//        }
     //   dd($response);
//        dd($count);
//whereHas('section',function ($q)use($materialid)
//        {
//            $q->groupBy('material_id')->select(DB::raw('COUNT(id)'),'material_id')->get();
//        })


        if ($material->isEmpty())
        {
            return response()->json([
                'stat'=>200,
                'msg'=>'no materials for this category',
                'material'=>$material
            ],200);
        }

        return response()->json([
            'stat'=>200,
            'msg'=>'material here successfully',
            'material'=>$material
        ],200);

    }

    public function showsections(request $request)
    {
        try {
       $rules=['id'=>'required|exists:materials,id'];
    $valid=Validator::make($request->all(),$rules);
        if ($valid->fails())
        {
            return response()->json([
                'stat'=>422,
               'error'=> $valid->errors()->first()
            ],422);
        }
        $sections=section::with('sub_section')->where('material_id',$request->id)->get();
        return response()->json([
            'stat'=>200,
            'msg'=>'sections here successfully',
            'sections'=>$sections,
          //  'subsection'=>$sections->sub_section
        ],200);
        }catch (Exception $ex)
        {
            DB::rollback();
            return $this->response()->json([
                'stat'=> $ex->getCode(),
                'msg'=>$ex->getMessage()],422);
        }
    }

    public function showexams(request $request)
    {
        $rules=[
            'id'=>'required|exists:exam_sub_section,subsection_id'
        ];
        $validator=Validator::make($request->all(),$rules);
        if ($validator->fails())
        {
            return response()->json([
                'error'=>'there is an issue',
                'msg'=>$validator->errors()->first(),
            ]);
        }

        $examid=exam_subsection::where('subsection_id',$request->id)->get();
         //   DB::table('exam_sub_section')->select('exam_id')->where('subsection_id',$request->id)->get();

        $exams=[];
            for ($i =0;$i<count($examid);$i++)
            {

                $exams[$i]=DB::table('exams')->select('id','name')->where('id',$examid[$i]->exam_id)->get();


              //  $exams=$data[$i];
            }

//            foreach ($exams as $exam)
//            {
//
//            }
       // dd(array_column($exams,'id'));
        //dd($exams);
        //dd($exam->exam_id);
//        foreach($examid as $exam)
//        {
//            $exams=DB::table('exams')->select('id','name')->where('id',$exam->exam_id)->get();
//        }

          //  dd($exams);
          //$subsection=subSection::find($request->id);
          //$exams=$subsection->exam()->where('subsection_id',$request->id)->get();

            return response()->json([
                'stat'=>200,
                'msg'=>'sections here successfully',
                'exams'=>$exams,
                //  'subsection'=>$sections->sub_section
            ],200);

    }

    public function showquestions(request $request)
    {
        $questions=question::where('exam_id',$request->id)->get();
        return response()->json([
            'stat'=>200,
            'msg'=>'questions here successfully',
            'exams'=>$questions,
            //  'subsection'=>$sections->sub_section
        ],200);

    }
    public function getresult(request $request)
    {
        //auth->user()->id
        //resquest->result
        //exam_id
    }
}
