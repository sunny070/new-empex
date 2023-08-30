<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\District;
use App\Models\JobNco;
use App\Models\JobPost;
use App\Models\Language;
use App\Models\MajorCore;
use App\Models\NcoDivision;
use App\Models\NcoFamily;
use App\Models\NcoGroup;
use App\Models\News;
use App\Models\OnGoingApplication;
use App\Models\PhysicalChallenge;
use App\Models\PoliceStation;
use App\Models\PostOffice;
use App\Models\Qualification;
use App\Models\RdBlock;
use App\Models\Religion;
use App\Models\Sector;
use App\Models\State;
use App\Models\Subject;
use App\Models\Type;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserFetchDataController extends Controller
{

  public function getLanguages()
  {
    $languages = Language::get();
    return response()->json(['languages' => $languages]);
  }

  public function getChallenges()
  {
    $challenges = PhysicalChallenge::get();
    return response()->json(['challenges' => $challenges]);
  }

  public function getQualification()
  {
    $qualifications = Qualification::get();
    return response()->json(['qualifications' => $qualifications]);
  }

  public function getStream(Request $request)
  {
    $streams = Subject::where('qualification_id', $request->qualification_id)->get();
    return response()->json(['streams' => $streams]);
  }

  public function getCore(Request $request)
  {
    $cores = MajorCore::where('subject_id', $request->stream_id)->get();
    return response()->json(['cores' => $cores]);
  }

  public function getState()
  {
    $states = State::get();
    return response()->json(['states' => $states]);
  }

  public function getDistrict(Request $request)
  {
    $districts = District::where('state_id', $request->state_id)->get();
    return response()->json(['districts' => $districts]);
  }

  public function getVillage(Request $request)
  {
    $villages = Village::where('district_id', $request->district_id)->get();
    return response()->json(['villages' => $villages]);
  }

  public function getRdBlock(Request $request)
  {
    $rdBlock = RdBlock::all();
    return response()->json(['rdBlock' => $rdBlock]);
  }
  public function getPoliceStation(Request $request)
  {
    $policeStations = PoliceStation::all();
    return response()->json(['policeStation' => $policeStations]);
  }
  public function getPostOffice(Request $request)
  {
    $postOffice = PostOffice::all();
    return response()->json(['postOffice' => $postOffice]);
  }
  public function getAddressData(Request $request)
  {
    $village = Village::findOrFail($request->village_id);
    $rdBlocks = RdBlock::findOrFail($village->rd_block_id);
    $postOffices = PostOffice::findOrFail($village->post_office_id);
    $policeStations = PoliceStation::findOrFail($village->police_station_id);

    return response()->json([
      'rdBlocks' => $rdBlocks,
      'postOffices' => $postOffices,
      'policeStations' => $policeStations,
    ]);
  }

  public function getJobsPost(Request $request)
  {
    $govt = json_decode($request['govt'], true);
    $private = json_decode($request['private'], true);
    $public = json_decode($request['public'], true);
    $sector = json_decode($request['sector'], true);
    $offset = $request->offset ?? 0;
    $limit = $request->limit ?? 10;

    $filter = false;

    if (count($public) > 0 || count($govt) > 0 || count($private) > 0 || count($sector) > 0) {
      $filter = true;
    }

    $jobsPosts = JobPost::with('attachments')
      ->when($request->type == 'newest', function ($q) {
        $q->orderBy('created_at', 'DESC');
      })
      ->when($request->type == 'oldest', function ($q) {
        $q->orderBy('created_at', 'ASC');
      })
      ->when($request->type == 'expiring', function ($q) {
        $q->orderBy('due_date_of_submission', 'ASC');
      })
      ->when($filter == true, function ($q) use ($govt, $private, $public, $sector) {
        return $q->whereIn('type_id', $govt)
          ->orWhereIn('type_id', $private)
          ->orWhereIn('type_id', $public)
          ->orWhereIn('sector_id', $sector);
      })
      ->where('title', 'LIKE', "%$request->search%")
      ->offset($offset)->limit($limit)->get();
    if (count($jobsPosts) == 0) {
      return response()->noContent();
    }
    info($jobsPosts);
    return response()->json(['jobsPosts' => $jobsPosts]);
  }

  public function getEmployeeNews(Request $request)
  {
      $offset = $request->offset ?? 0;
      $limit = $request->limit ?? 10;
    $employeeNews = News::query()->where('title','LIKE',"%$request->search%")->offset($offset)->limit($limit)->get();
    if (count($employeeNews) == 0) {
      return response()->noContent();
    }
    return response()->json(['employeeNews' => $employeeNews]);
  }

  public function getReligion()
  {
    $religions = Religion::get();
    return response()->json(['religions' => $religions]);
  }

  public function getOnGoing(Request $request)
  {
    $onGoings = OnGoingApplication::where('user_id', $request->user_id)->with('user')->get();
    return response()->json(['onGoings' => $onGoings]);
  }

  public function getDownloadJobFile(Request $request)
  {
    $file = $request->file;
    $headers = [
      'Content-Type' => 'application/pdf',
      'filename' => 'test.pdf'
    ];
    return response()->download($file, 'test.pdf', $headers);
  }

  public function searchJob(Request $request)
  {
    $jobs = JobPost::where('title', 'LIKE', "%$request->search%")->with('attachments')->get();
    return response()->json(['jobsPosts' => $jobs]);
  }

  public function getAllTypeBaseOnCategory($cat)
  {
    return response()->json(['catWise' => Type::where('category_id', $cat)->withCount('job')->has('job')->orderBy('job_count', 'DESC')->get()]);
  }

  public function getAllNco()
  {
    // hei la siam belh tur
    $test = NcoFamily::with([
      'group' => function ($group) {
        return $group->with([
          'subdivision' => function ($sub) {
              return $sub->with('division');
            }
        ]);
      }
    ])->withCount('job_nco')->has('job_nco')->orderBy('job_nco_count', 'DESC')->get()->groupBy('group.subdivision.division.name');

    // $ncoDivisions = NcoDivision::with(['subdivision' => function ($sub) {
    //   return $sub->with(['group' => function ($group) {
    //     return $group->with(['family' => function ($fam) {
    //       return $fam->withCount('job_nco')->has('job_nco')->orderBy('job_nco_count', 'DESC');
    //     }])->has('family');
    //   }])->has('group');
    // }])->has('subdivision')->get();

    // $ncoList = [];

    // foreach ($ncoDivisions as $nco) {
    //   if (count($nco->subdivision) > 0) {
    //     foreach ($nco->subdivision as $sub) {
    //       if (count($sub->group) > 0) {
    //         foreach ($sub->group as $group) {
    //           if (count($group->family) > 0) {
    //             foreach ($group->family as $fam) {
    //               array_push($ncoList, [
    //                 'family_id' => $fam->id,
    //                 'name' => $nco->name,
    //                 'job_count' => $fam->job_nco_count,
    //               ]);
    //             }
    //           }
    //         }
    //       }
    //     }
    //   }
    // }

    return response()->json(['ncoList' => $test]);
    // return response()->json(['ncoList' => $ncoList]);
  }

  public function getAllSector()
  {
    return response()->json(['sectorList' => Sector::withCount('job')->has('job')->orderBy('job_count', 'DESC')->get()]);
  }
  public function getAllJobPost(Request $request)
  {
    $offset = $request->offset;
    $limit = $request->limit;
    $jobs = JobPost::with('attachments')->offset($offset)->limit($limit)->get();
    return response()->json(['jobs' => $jobs]);
  }
  public function countAllJobs(Request $request)
  {
    $jobsCount = JobPost::get()->count();
    return response()->json(['jobs' => $jobsCount]);
  }
}
