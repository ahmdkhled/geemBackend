<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\exam;
use App\Models\exam_subsection;
use App\Models\material;
use App\Models\question;
use App\Models\result;
use App\Models\section;
use App\Models\subSection;
use App\Models\User_detail;
use App\regions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class DashboardPMController extends Controller
{
    public function showDashboard()
    {
        $material=material::all();
        $students=User_detail::where('role_id',2)->get();
        $exam=exam::all();
        $result=result::all();
        $result=count($result);
        $students=count($students);
        $material=count($material);
        $exam=count($exam);
;
        return view('dashboard.dashboard',compact('result','students','material','exam'));
    }

    public function showCreatematerial()
    {

        $materials=material::with('category')->get();
        //dd($materials);
        $categories=category::all();
        return view('dashboard.CreateMaterial',compact('categories','materials'));
    }

    public function Creatematerial(Request $request)
    {
        //dd($request);
        $request->validate([
            'subject'=>'required',
            'category'=>'required|exists:category,id',
            'img'=>'required|mimes:jpeg,png,jpg|max:2048',
        ]);
        try {

        $image=$request->file('img');
        $image_name=time().'_'.$image->getClientOriginalName();
        $pathname=public_path().'/materials';
        $path_image=$image->move($pathname,$image_name);
        $path=asset('public/materials/'.$image_name);
        material::create([
            'name'=>$request->subject,
            'category_id'=>$request->category,
            'photo'=>$path
        ]);
        return redirect()->route('material')->with(['success'=>'subject added successfully']);
        }
        catch (Exception $exception)
        {
            DB::rollBack();
            return redirect()->route('material')->with(['error'=>'try again later']);
        }
    }

    public function showCreateQuestion()
    {
        $material=material::all();
        //dd(json_encode($material[0]->examsubsection[0]->name));
       $question= question::with('exam.subsection.section.material')->select(DB::raw('COUNT(id)'),'exam_id')->groupBy('exam_id')->get();
        //$sections=section::all();
        //$exams=exam::all();
        //dd(json_encode($q));
        return view('dashboard.CreateQuestions',compact('material','question'));
    }
    public function showCreateExam()
    {
        $material=exam::with('examsubsection.section.material')->get();
        //dd(json_encode($material[0]->examsubsection[0]->name));

        //$sections=section::all();
        //$exams=exam::all();
        return view('dashboard.CreateExam',compact('material'));
    }
    public function CreateExam(Request $request)
    {
        $request->validate([
            'material'=>'required|exists:materials,id',
            'section'=>'required|exists:sections,id',
            'subsection'=>'required|exists:sub_sections,id',
            'exam'=>'required'
        ]);
        try {


            $exam = exam::create([
                'name' => $request->exam,
                'active' => 1
            ]);
            $exam->examsubsection()->attach($request->subsection);
            return redirect()->route('exam')->with(['success'=>'exam added successfully']);
        }catch (Exception $exception)
        {
            DB::rollBack();
            return redirect()->route('exam')->with(['error'=>'try add exam again']);
        }

    }

    public function showCreateSection()
    {
$section=subSection::with('section.material')->get();
        $material=material::all();
        //dd($section);
        return view('dashboard.CreateSectionSubsection',compact('material','section'));
    }
    public function CreateSection(Request $request)
    {
        try
        {
        section::create([
            'name'=>$request->addsection,
            'material_id'=>$request->addmaterial
        ]);
        return redirect()->route('section')->with(['success'=>'unit is added']);
        }
        catch (Exception  $exception)
        {
            DB::rollBack();
            return redirect()->route('section')->with(['error'=>'try add unit again']);
        }
    }

    public function CreateQuestion(Request $request)
    {
        $request->validate([
            'check1'=>'required_without_all:check2,check3,check4',
            'check2'=>'required_without_all:check1,check3,check4',
            'check3'=>'required_without_all:check1,check2,check4',
            'check4'=>'required_without_all:on,check1,check2,check3',
        ]);

//        dd($request);
        try {

            $choices=[$request->choice1,$request->choice2,$request->choice3,$request->choice4];
            $choices=json_encode($choices);
            $rightchoice='';
            if ($request->has('check1')) {$rightchoice=$request->choice1;}
            elseif ($request->has('check2')){$rightchoice=$request->choice2;}
            elseif ($request->has('check3')){$rightchoice=$request->choice3;}
            elseif ($request->has('check4')){$rightchoice=$request->choice4;}


            if ($request->has('examcheck') && $request->examcheck=="1") {
                $exams = exam::where([
                    ['subsection_id', $request->subsection],
                    ['active', 0]
                ])
                    ->latest()->first();

                if (filled($exams)) {
                    $question = question::where('exam_id', $exams->id)->get();
                    if (count($question) < 10) {
                        question::create([
                            'textQuestion' => $request->question,
                            'exam_id' => $exams->id,
                            'rightChoice' => $rightchoice,
                            'choices' => $choices
                        ]);
                        return redirect()->route('question')->with(['success'=>'question added']);
                    }
                    else if (count($question) == 10)
                    {
                        $exam = exam::create([
                            'name' => 1,
                            'active' => 0,
                            'type' => "final",
                            'subsection_id' => $request->subsection
                        ]);
                        $name = $exam->id . "exam";
                        $exam->update([
                            'name' => $name
                        ]);

                        question::create([
                            'textQuestion' => $request->question,
                            'exam_id' => $exam->id,
                            'rightChoice' => $rightchoice,
                            'choices' => $choices
                        ]);
                        return redirect()->route('question')->with(['success'=>'question added']);
                    }
                }

                if (!filled($exams) || count($question) == 10) {
                    $exam = exam::create([
                        'name' => 1,
                        'active' =>0,
                        'type' => "final",
                        'subsection_id' => $request->subsection
                    ]);
                    $name = $exam->id . "exam";
                    $exam->update([
                        'name' => $name
                    ]);

                    question::create([
                        'textQuestion' => $request->question,
                        'exam_id' => $exam->id,
                        'rightChoice' => $rightchoice,
                        'choices' => $choices
                    ]);
                    return redirect()->route('question')->with(['success'=>'question added']);
                }

            }//end first if
            else
            {
                $exams = exam::where([
                    ['subsection_id', $request->subsection],
                    ['active', 1]
                ])
                    ->latest()->first();

                if (filled($exams)) {
                    $question = question::where('exam_id', $exams->id)->get();
                    if (count($question) < 10) {
                        question::create([
                            'textQuestion' => $request->question,
                            'exam_id' => $exams->id,
                            'rightChoice' => $rightchoice,
                            'choices' => $choices
                        ]);
                        return redirect()->route('question')->with(['success'=>'question added']);
                    }
                    else if (count($question) == 10)
                    {
                        $exam = exam::create([
                            'name' => 1,
                            'active' => 1,
                            'type' => "final",
                            'subsection_id' => $request->subsection
                        ]);
                        $name = $exam->id . "exam";
                        $exam->update([
                            'name' => $name
                        ]);

                        question::create([
                            'textQuestion' => $request->question,
                            'exam_id' => $exam->id,
                            'rightChoice' => $rightchoice,
                            'choices' => $choices
                        ]);
                        return redirect()->route('question')->with(['success'=>'question added']);
                    }
                }

                if (!filled($exams)) {
                    $exam = exam::create([
                        'name' => 1,
                        'active' => 1,
                        'type' => "general",
                        'subsection_id' => $request->subsection
                    ]);
                    $name = $exam->id . "exam";
                    $exam->update([
                        'name' => $name
                    ]);

                    question::create([
                        'textQuestion' => $request->question,
                        'exam_id' => $exam->id,
                        'rightChoice' => $rightchoice,
                        'choices' => $choices
                    ]);

                    return redirect()->route('question')->with(['success'=>'question added']);
                }

            }
        }
        catch (Exception $ex)
        {
            DB::rollBack();
            return redirect()->route('question')->with(['error'=>'try add unit again']);
        }
    }
    public function CreateSubSection(Request $request)
    {
        try
        {
            subSection::create([
                'name'=>$request->subsection,
                'section_id'=>$request->section
            ]);
            return redirect()->route('section')->with(['success'=>'lesson is added']);
        }
        catch (Exception  $exception)
        {
            DB::rollBack();
            return redirect()->route('section')->with(['error'=>'try add lesson again']);
        }
    }

    public function showleaderBoard()
    {
        $leaderboard=result::with('user')
            ->select(DB::raw('SUM(result)'),'user_id',DB::raw('count(exam_id)'))
            ->orderBy('SUM(result)','DESC')
            ->groupBy('user_id')->get();
            //dd($leaderboard);
        return view('dashboard.leaderboard',compact('leaderboard'));
    }

//    public function LeaderBoard()
//    {
//        //  DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");->groupBy('user_id')
//        $leaderboard=result::with('user')
//            ->select(DB::raw('SUM(result)'),'user_id',DB::raw('count(exam_id)'))
//            ->orderBy('SUM(result)','DESC')
//            ->groupBy('user_id')->get();
//
//        //$leaderboard=DB::table('results')->select('count(result)','user_id','exam_id')->groupBy('user_id')->get();
//
//    }
    public function getdata(Request $request)
    {
        if ($request->ajax())
        {
            if ($request->has('section'))
            {
                $select=subSection::where('section_id',$request->section)->get();
                return response()->json([
                    'data'=>$select,
                    'message'=>'loaded'
                ]);
            }
            if ($request->has('material'))
            {
                $select=section::where('material_id',$request->material)->get();
                return response()->json([
                    'data'=>$select,
                    'message'=>'loaded'
                ]);

            }
            if($request->has('subsection'))
            {

                $select=[];
                $ids=exam_subsection::where('subsection_id',$request->subsection)->get();
                for ($i =0;$i<count($ids);$i++)
                {

                    $select[$i]=DB::table('exams')->select('id','name')->where('id',$ids[$i]->exam_id)->get();


                    //  $exams=$data[$i];
                }
                return response()->json([
                    'data'=>$select,
                    'message'=>'loaded'
                ]);

            }
        }
    }
}
