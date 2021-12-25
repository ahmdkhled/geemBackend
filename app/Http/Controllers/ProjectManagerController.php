<?php

namespace App\Http\Controllers;
use App\Models\exam;
use App\Models\governorate;
use App\Models\question;
use App\Models\result;
use App\Models\subSection;
use http\Env\Response;
use App\Http\Traits\GeneralTrait;
use App\Models\category;
use App\Models\material;
use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Monolog\Handler\IFTTTHandler;
use mysql_xdevapi\Exception;


class ProjectManagerController extends Controller
{
    use GeneralTrait;
    public function SendData()
    {

        $governorate=governorate::all();
        $category=category::all();
        $data=['governorate'=>$governorate,
                'category'=>$category];
        return response()->json([
            'stat'=>200,
            'msg'=>'here is categories',
            'data'=>$data
        ]);

    }

    public function finalExam()
    {

    }
    public function CreateMaterial(Request $request)
    {
        try
        {
            $rules= [
            "name"=>'required',
            'category_id'=>'required|exists:category,id',
            'photo'=>'required|mimes:jpeg,jpg,png,gif|max:10000'
            ];

            $valid=Validator::make($request->all(),$rules);
            if($valid->fails())
            {
             return $this->DatabaseError($valid->errors()->first());
            }
            $image=$request->file('photo');
            $image_name=time().'_'.$image->getClientOriginalName();
            $pathname=public_path().'/materials';
            $image->move($pathname,$image_name);
            $path=asset('public/materials/'.$image_name);
                material::create([
                    'name'=>$request->name,
                    'photo'=>$path,
                    'category_id'=>$request->category_id,

                ]);
            return response()->json([
                'stat'=>200,
                'msg'=>'material created successfully'
            ]);

        } catch (\Exception $ex)
        {
                DB::rollback();
                return response()->json([
                           'stat'=> $ex->getCode(),
                           'msg'=>$ex->getMessage()],422);
        }
    }
    public function CreateSectionSub(Request $request)
    {
        try
        {
            $rules=[
            'section_name'=>'required',
            'material_id'=>'required|exists:materials,id',
            ];
            $subrules=[
              //  'sub_section'=>'required|array',
                'sub_section.*'=>'required|string'
            ];
            //$val=count($request->sub_section);
            //dd($val);
            $data=$request->only('section_name','material_id');
            //$sub_data=$request->sub_section[]

           $secvalid=Validator::make($data,$rules);
            if ($secvalid->fails())
            {return $this->DatabaseError($secvalid->errors()->first());}

            $newsec=section::create([
                'name'=>$request->section_name,
                'material_id'=>$request->material_id
            ]);
            $subvalid=Validator::make($request->sub_section,$subrules);
            if ($subvalid->fails())
            {return $this->DatabaseError($subvalid->errors()->first());}
                $subID=[];
                foreach($request->sub_section as $sub)
                {
                    $subID=subSection::create([
                        'name'=>$sub,
                        'section_id'=>$newsec->id
                    ]);
                }
            return response()->json([
              'stat'=>200,
                'msg'=>'section and subsection is added successfully',
                //'subsectionids'=>$subID
            ],200);
            //$subvalid=Validator::make();

        } catch (\Exception $ex)
        {
            DB::rollback();
            return response()->json([
            'stat'=> $ex->getCode(),
            'msg'=>$ex->getMessage()],422);
        }

    }
    public function CreateExamQue(Request $request)
    {
//dd($request->questions[0]['rightChoice']);
        try {
            $examrules=[
                'name'=>'required',
                'subsection_id'=>'required|exists:sub_sections,id',
                'active'=>'required'
            ];
            $querules=[
                'textQuestion.*'=>'required|string',
                'choices.*'=>'required|string',
                'rightChoice.*'=>'required'
            ];
            $data=$request->only('name','subsection_id','active');
            $exam=Validator::make($data,$examrules);
            if ($exam->fails())
            {
                return $this->DatabaseError($exam->errors()->first());
            }
            $exame=exam::create([
                'name'=>$request->name,
                'active'=>$request->active
            ]);
           $exame->examsubsection()->attach($request->subsection_id);
            $qdata=$request->only('textQuestion','exam_id','choices','rightChoice');
            $ques=Validator::make($qdata,$querules);
            if ($ques->fails())
            {
                return $this->DatabaseError($ques->errors()->first());
            }
            $val=count($request->questions);
$choices   =[];
            for ($i =0 ;$i<$val;$i++)
            {
                $choices=json_encode($request->questions[$i]['choices']);

                question::create([
                    'textQuestion'=>$request->questions[$i]['textQuestion'],
                    'exam_id'=>$exame->id,
                    'choices'=>$choices,
                    'rightChoice'=>$request->questions[$i]['rightChoice'],
                ]);
            }
            return response()->json([
                'stat'=>200,
                'msg'=>'exam and questions added successfully'
            ],200);
            //dd($choices[0]);
        }
        catch (Exception $ex)
        {
            DB::rollback();
            return response()->json([
                'stat'=> $ex->getCode(),
                'msg'=>$ex->getMessage()],422);
        }

    }
    public function LeaderBoard()
    {
      //  DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");->groupBy('user_id')
     $leaderboard=result::with('user')
         ->select(DB::raw('SUM(result)'),'user_id',DB::raw('count(exam_id)'))
         ->orderBy('SUM(result)','DESC')
         ->groupBy('user_id')->get();

        //$leaderboard=DB::table('results')->select('count(result)','user_id','exam_id')->groupBy('user_id')->get();
        if(!filled($leaderboard))
        {
            return response()->json([
                'stat'=>200,
                'msg'=>'no current data',
            ]);
        }
     return response()->json(
         [
         'stat'=>200,
         'msg'=>'here is all student result',
         'leaderboard'=>$leaderboard
            ]);
    }
}
