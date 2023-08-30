<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPostNcs;
use Illuminate\Support\Facades\Validator;
use App\Models\UserJob;
use App\Models\UserJobNcs;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// use App\Models\UserJobNcs;

class NcsJobPostController extends Controller
{

    function login(Request $request)
    {
        $user= User::where('name', $request->name)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        
             $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'user' => $user,
                'token' => $token
            ];
        
             return response($response, 201);
    }



    public function index()
{
    $jobPosts = JobPostNcs::all();
    return response()->json($jobPosts);
}


public function store(Request $request)
{

    $validator = Validator::make($request->all(), [
        'category_id'=>'required|numeric',
        'type_id'=> 'required|numeric',

        'sector_id'=> 'required|numeric',
        'title'=> 'required',
        'slug'=> 'nullable',
        'description'=> 'required',
        'no_of_post'=> 'required|numeric',
        'due_date_of_submission'=> 'required|date',
        'organization_name'=> 'required',

        'department_id'=> 'required|numeric',
        'created_by'=> 'required',
    ]);
    if ($validator->fails()) {
        return response()->json([
            "FaultCode" => "ValidationFailed",
            "FaultReason" => "Request validation failed",
            "IsFault" => true,
            "Results" => [
                "FaultCode" => null,
                "FaultReason" => null,
                "FaultText" => "Please Check Again",
                "FaultTextField" => null,
                "IsSuccess" => false,],
        ], 400);
    }
        $jobPost =new JobPostNcs;
        $jobPost->category_id= $request->category_id;
        $jobPost->type_id= $request->type_id;
        $jobPost->sector_id= $request->sector_id;
        $jobPost->title= $request->title;
        $jobPost->slug= $request->slug;
        $jobPost->description= $request->description;
        $jobPost->no_of_post= $request->no_of_post;
        $jobPost->due_date_of_submission= $request->due_date_of_submission;
        $jobPost->organization_name= $request->organization_name;
        $jobPost->department_id= $request->department_id;
        $jobPost->created_by= $request->created_by;
        $jobPost->published= 1;
        $jobPost->url=$request->url??"google.com" ;

        $jobPost->save();
    $response = [
        "FaultCode" => null,
        "FaultReason" => null,
        "IsFault" => false,
        "Results" => [
            [
                "FaultCode" => null,
                "FaultReason" => null,
                "FaultText" => "",
                "FaultTextField" => null,
                "IsSuccess" => true,
                "Job_Category_ID" => $jobPost->category_id,  // Assuming you have an 'id' field in your model
                "Job_Description" => $jobPost->description,
                "Created_by" => $jobPost->created_by,
                "url"=> $jobPost->url// Set your reference ID here
            ],
        ],
    ];

    return response()->json($response, 201);
    // $validation = $request->validate([
    //     'category_id'=>'required|numeric',
    //     'type_id'=> 'required|numeric',

    //     'sector_id'=> 'required|numeric',
    //     'title'=> 'required',
    //     'slug'=> 'nullable',
    //     'description'=> 'required',
    //     'no_of_post'=> 'required|numeric',
    //     'due_date_of_submission'=> 'required|date',
    //     'organization_name'=> 'required',

    //     'department_id'=> 'required|numeric',
    //     'created_by'=> 'required',
        


    // ]);
    
    // $status='';
    // if($validation){
    //     $jobPost = new JobPostNcs;
    //     $jobPost->category_id= $request->category_id;
    //     $jobPost->type_id= $request->type_id;
    //     $jobPost->sector_id= $request->sector_id;
    //     $jobPost->title= $request->title;
    //     $jobPost->slug= $request->slug;
    //     $jobPost->description= $request->description;
    //     $jobPost->no_of_post= $request->no_of_post;
    //     $jobPost->due_date_of_submission= $request->due_date_of_submission;
    //     $jobPost->organization_name= $request->organization_name;
    //     $jobPost->department_id= $request->department_id;
    //     $jobPost->created_by= $request->created_by;
    //     $jobPost->published= 1;
    //     $jobPost->save();
    //     $status="success";
    //     // return response()->json($jobPost);
        
    // }else{
    //     $status="Failed";
    // }
   
    

    /*
    IF VALIDATION TRUE{
        SAVE AND RETURN SUCCESS
        $status='success';
        return response()->json([
        'status'=>$status,
    ],200);
    }ELSE{
        RETURN FAILURE
        $status='fail';
        return response()->json([
        'status'=>$status,
    ],200);
    }

    */
    // return response()->json([
    //     'status'=>$status,
    // ],200);

}


public function show()
{
    $totalGovt = JobPostNcs::where('category_id', 3)->count();
    $totalPublic = JobPostNcs::where('category_id', 2)->count();
    $totalPrivate = JobPostNcs::where('category_id', 1)->count();

    $search = request()->q;
    $sort = request()->sort ?? 'n';
    $filter = request()->filter ?? 'all';

    $jobLists = JobPostNcs::where('published', 1)
        ->when($search, function ($q) use ($search) {
            return $q->where('title', 'like', '%' . $search . '%');
        })
        ->when($sort, function ($s) use ($sort) {
            if ($sort == 'n') {
                return $s->orderBy('created_at', 'DESC');
            } else if ($sort == 'o') {
                return $s->orderBy('created_at', 'ASC');
            } else {
                return $s->orderBy('due_date_of_submission', 'ASC');
            }
        })
        ->when($filter, function ($f) use ($filter) {
            if ($filter == 'private') {
                return $f->where('category_id', 1);
            } elseif ($filter == 'public') {
                return $f->where('category_id', 2);
            } elseif ($filter == 'govt') {
                return $f->where('category_id', 3);
            } else {
                return $f;
            }
        })
        ->orderBy('created_at', 'DESC')
        ->paginate(5);

    return view('web.jobs.ncsindex', compact('totalGovt', 'totalPublic', 'totalPrivate', 'jobLists', 'search', 'sort', 'filter'));
    // $show=JobPostNcs::all();
    // // return $show;
    // return view('web.jobs.index',compact('show'));
    // $jobPost = JobPostNcs::all();

    // // dd($jobPost);
    // return view('web.jobs.ncsindex',compact('jobPost'));
    // return response()->json($jobPost);
}

public function detail($slug)
{
    if (!auth()->check()) {
        return redirect(route('web.jobs'))->with('jobMessage', 'Please login to view details!');
    }

    $job = JobPostNcs::all()->where('slug', $slug)->firstOrFail();

    // dd($job);
    $userJob = UserJobNcs::firstOrNew([
        'user_id' => auth()->id(),
        'job_post_ncs_id' => $job->id,
    ]);
    // $userJob->save();

    return view('web.jobs.Ncsdetail', compact('job'));
}


public function update(Request $request, JobPostNcs $jobPost)
{
    $jobPost->update($request->all());
    return response()->json($jobPost);
}


public function destroy(JobPostNcs $jobPost)
{
    $jobPost->delete();
    return response()->json(null, 204);
}

}
