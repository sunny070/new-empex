<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserCanRead;
use App\Models\UserCanSpeak;
use App\Models\UserCanWrite;
use Illuminate\Http\Request;

class UserLanguageController extends Controller
{
  public function createLanguages(Request $request)
  {
    $canSpeak = $request->can_speak;
    $canRead = $request->can_read;
    $canWrite = $request->can_write;

    if (strlen($canSpeak) != 2) {
      $canSpeak = explode("[(", $canSpeak)[1];
      $canSpeak = explode(")]", $canSpeak)[0];
      $canSpeak = explode(",", $canSpeak);
      if (UserCanSpeak::where('user_id', $request->user_id)->count() != 0) {
        UserCanSpeak::where('user_id', $request->user_id)->delete();
      }
      foreach ($canSpeak as $speaks) {
        $userCanSpeak = new UserCanSpeak();
        $userCanSpeak->user_id = $request->user_id;
        $userCanSpeak->language_id = $speaks;
        $userCanSpeak->save();
      }
    }
    if (strlen($canRead) != 2) {
      $canRead = explode("[(", $canRead)[1];
      $canRead = explode(")]", $canRead)[0];
      $canRead = explode(",", $canRead);
      if (UserCanRead::where('user_id', $request->user_id)->count() != 0) {
        UserCanRead::where('user_id', $request->user_id)->delete();
      }
      foreach ($canRead as $read) {
        $userCanRead = new UserCanRead();
        $userCanRead->user_id = $request->user_id;
        $userCanRead->language_id = $read;
        $userCanRead->save();
      }
    }
    if (strlen($canWrite) != 2) {
      $canWrite = explode("[(", $canWrite)[1];
      $canWrite = explode(")]", $canWrite)[0];
      $canWrite = explode(",", $canWrite);
      if (UserCanWrite::where('user_id', $request->user_id)->count() != 0) {
        UserCanWrite::where('user_id', $request->user_id)->delete();
      }
      foreach ($canWrite as $write) {
        $userCanWrite = new UserCanWrite();
        $userCanWrite->user_id = $request->user_id;
        $userCanWrite->language_id = $write;
        $userCanWrite->save();
      }
    }
    return response()->json(['success' => 'User languages added']);
  }

  public function getMyLanguages(Request $request)
  {
    $canRead = UserCanRead::where('user_id', $request->user_id)->with('language')->get();
    $canSpeak = UserCanSpeak::where('user_id', $request->user_id)->with('language')->get();
    $canWrite = UserCanWrite::where('user_id', $request->user_id)->with('language')->get();
    if (count($canRead) == 0 && count($canSpeak) == 0 && count($canWrite) == 0) {
      return response()->noContent();
    }
    return response()->json(['canRead' => $canRead, 'canSpeak' => $canSpeak, 'canWrite' => $canWrite]);
  }
}
