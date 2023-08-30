<?php

namespace App\Http\Livewire\District\Reports;

use App\Exports\AllTotalReport;
use App\Exports\ReportExport;
use App\Exports\TotalEducationExport;
use App\Models\AdminDistrict;
use App\Models\BasicInfo;
use App\Models\District;
use App\Models\EducationQualification;
use App\Models\PhysicalChallenge;
use App\Models\Qualification;
use App\Models\UserPhysicalChallenge;
use DateTime;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class TotalRegistration extends Component
{
    public $category = 'All';
    public $years = [];

    public $generated = false;

    public $reports = [];
    public $maleReport = 0;
    public $femaleReport = 0;
    public $totalReport = 0;
    public $maleLapsed = 0;
    public $femaleLapsed = 0;
    public $totalLapsed = 0;
    public $malePlaced = 0;
    public $femalePlaced = 0;
    public $totalPlaced = 0;
    public $maleLiveRegister = 0;
    public $femaleLiveRegister = 0;
    public $totalLiveRegister = 0;

    public $duration = 'Monthly';
    public $year = '2022';
    public $month;
    public $quarter = '01';
    public $half = '01';
    public $from;
    public $to;
    public $authDistricts = [];

    public $districts;
    public $district = 'All';
    public $districtName;
    public $buttonEnable = true;
    public $monthName = 'January';

    public $educations;
    public $subjectCount = 0;

    // below are for all category reports
    public $allMizo = [];
    public $maleReportMizo = 0;
    public $femaleReportMizo = 0;
    public $totalReportMizo = 0;
    public $maleLapsedMizo = 0;
    public $femaleLapsedMizo = 0;
    public $totalLapsedMizo = 0;
    public $malePlacedMizo = 0;
    public $femalePlacedMizo = 0;
    public $totalPlacedMizo = 0;
    public $maleLiveRegisterMizo = 0;
    public $femaleLiveRegisterMizo = 0;
    public $totalLiveRegisterMizo = 0;

    public $allNonMizo = [];
    public $maleReportNonMizo = 0;
    public $femaleReportNonMizo = 0;
    public $totalReportNonMizo = 0;
    public $maleLapsedNonMizo = 0;
    public $femaleLapsedNonMizo = 0;
    public $totalLapsedNonMizo = 0;
    public $malePlacedNonMizo = 0;
    public $femalePlacedNonMizo = 0;
    public $totalPlacedNonMizo = 0;
    public $maleLiveRegisterNonMizo = 0;
    public $femaleLiveRegisterNonMizo = 0;
    public $totalLiveRegisterNonMizo = 0;

    public $allPhysical = [];
    public $maleReportPhysical = 0;
    public $femaleReportPhysical = 0;
    public $totalReportPhysical = 0;
    public $maleLapsedPhysical = 0;
    public $femaleLapsedPhysical = 0;
    public $totalLapsedPhysical = 0;
    public $malePlacedPhysical = 0;
    public $femalePlacedPhysical = 0;
    public $totalPlacedPhysical = 0;
    public $maleLiveRegisterPhysical = 0;
    public $femaleLiveRegisterPhysical = 0;
    public $totalLiveRegisterPhysical = 0;

    public function generateReport()
    {
        if ($this->month == '1') {
            $this->monthName = 'January';
        } elseif ($this->month == '2') {
            $this->monthName = 'February';
        } elseif ($this->month == '3') {
            $this->monthName = 'March';
        } elseif ($this->month == '4') {
            $this->monthName = 'April';
        } elseif ($this->month == '5') {
            $this->monthName = 'May';
        } elseif ($this->month == '6') {
            $this->monthName = 'June';
        } elseif ($this->month == '7') {
            $this->monthName = 'July';
        } elseif ($this->month == '8') {
            $this->monthName = 'August';
        } elseif ($this->month == '9') {
            $this->monthName = 'September';
        } elseif ($this->month == '10') {
            $this->monthName = 'October';
        } elseif ($this->month == '11') {
            $this->monthName = 'November';
        } else {
            $this->monthName = 'December';
        }

        $this->districtName = $this->district != 'All' ? strtoupper(District::where('id', $this->district)->value('name')) : strtoupper($this->district);
        switch ($this->category) {
            case 'Education':
                $this->generateEducationReport();
                break;
            case 'All':
                $this->generateAllReport();
                break;
            case 'Physically Handicapped':
                $this->generateHandicappedReport();
                break;
            default:
                $this->generateCastReport($this->category);
        }

        $this->generated = true;
        $this->buttonEnable = false;
    }

    public function generateAllReport()
    {
        $this->generateCastReport('Mizo');
        $this->generateCastReport('Non-Mizo');
        $this->generateHandicappedReport();
    }

    public function generateEducationReport()
    {
        $this->maleReport = 0;
        $this->femaleReport = 0;
        $this->totalReport = 0;
        $this->maleLapsed = 0;
        $this->femaleLapsed = 0;
        $this->totalLapsed = 0;
        $this->malePlaced = 0;
        $this->femalePlaced = 0;
        $this->totalPlaced = 0;
        $this->maleLiveRegister = 0;
        $this->femaleLiveRegister = 0;
        $this->totalLiveRegister = 0;
        $this->subjectCount = 0;

        $this->educations = Qualification::with('subject')->get()->toArray();
        foreach ($this->educations as $index => $quali) {
            if (count($quali['subject']) > 0) {
                $this->subjectCount += count($quali['subject']);

                foreach ($quali['subject'] as $subjIndex => $subject) {
                    $userSubjectIds = EducationQualification::where('subject_id', $subject['id'])->pluck('user_id');
                    $maleInReport = BasicInfo::whereIn('user_id', $userSubjectIds)
                        ->where('status', 'Approved')
                        ->where('is_archive', 0)
                        ->where('card_valid_till', '>=', now())
                        ->when($this->district != 'All', function ($q) {
                            return $q->where('district_id', $this->district);
                        })
                        ->when($this->district == 'All', function ($q) {
                            return $q->whereIn('district_id', $this->authDistricts);
                        })
                        ->when($this->duration == 'Yearly', function ($q) {
                            $q->where('created_at', 'LIKE', $this->year . '%');
                        })
                        ->when($this->duration == 'Monthly', function ($q) {
                            $q->where('created_at', 'LIKE', date('Y-m', strtotime($this->year . '-' . $this->month)) . '%');
                        })
                        ->when($this->duration == 'Custom', function ($q) {
                            $q->where('created_at', '>=', date('Y-m-d', strtotime($this->from)))->where('created_at', '<=', date('Y-m-d', strtotime($this->to)));
                        })
                        ->when($this->duration == 'Half-Yearly', function ($q) {
                            $from = date('Y-m-d', strtotime($this->year . '-' . ($this->half == '01' ? 1 : 7) . '-1'));
                            $to = date('Y-m-d', strtotime($this->year . '-' . ($this->half == '01' ? 6 : 12) . '-31'));
                            $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                        })
                        ->when($this->duration == 'Quarterly', function ($q) {
                            switch ($this->quarter) {
                                case '01':
                                    $from = date('Y-m-d', strtotime($this->year . '-' . 1 . '-' . 1));
                                    $to = date('Y-m-d', strtotime($this->year . '-' . 3 . '-' . 30));
                                    break;
                                case '02':
                                    $from = date('Y-m-d', strtotime($this->year . '-' . 4 . '-' . 1));
                                    $to = date('Y-m-d', strtotime($this->year . '-' . 6 . '-' . 31));
                                    break;
                                case '03':
                                    $from = date('Y-m-d', strtotime($this->year . '-' . 7 . '-' . 1));
                                    $to = date('Y-m-d', strtotime($this->year . '-' . 9 . '-' .  31));
                                    break;
                                default:
                                    $from = date('Y-m-d', strtotime($this->year . '-' .  10 . '-' .  1));
                                    $to = date('Y-m-d', strtotime($this->year . '-' . 12  . '-' . 31));
                                    break;
                            }
                            $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                        })
                        ->where('gender', 'Male')
                        ->count();

                    $femaleInReport = BasicInfo::whereIn('user_id', $userSubjectIds)
                        ->where('status', 'Approved')
                        ->where('is_archive', 0)
                        ->where('card_valid_till', '>=', now())
                        ->when($this->district != 'All', function ($q) {
                            return $q->where('district_id', $this->district);
                        })
                        ->when($this->district == 'All', function ($q) {
                            return $q->whereIn('district_id', $this->authDistricts);
                        })
                        ->when($this->duration == 'Yearly', function ($q) {
                            $q->where('created_at', 'LIKE', $this->year . '%');
                        })
                        ->when($this->duration == 'Monthly', function ($q) {
                            $q->where('created_at', 'LIKE', date('Y-m', strtotime($this->year . '-' . $this->month)) . '%');
                        })
                        ->when($this->duration == 'Custom', function ($q) {
                            $q->where('created_at', '>=', date('Y-m-d', strtotime($this->from)))->where('created_at', '<=', date('Y-m-d', strtotime($this->to)));
                        })
                        ->when($this->duration == 'Half-Yearly', function ($q) {
                            $from = date('Y-m-d', strtotime($this->year . '-' . ($this->half == '01' ? 1 : 7) . '-1'));
                            $to = date('Y-m-d', strtotime($this->year . '-' . ($this->half == '01' ? 6 : 12) . '-31'));
                            $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                        })
                        ->when($this->duration == 'Quarterly', function ($q) {
                            switch ($this->quarter) {
                                case '01':
                                    $from = date('Y-m-d', strtotime($this->year . '-' . 1 . '-' . 1));
                                    $to = date('Y-m-d', strtotime($this->year . '-' . 3 . '-' . 30));
                                    break;
                                case '02':
                                    $from = date('Y-m-d', strtotime($this->year . '-' . 4 . '-' . 1));
                                    $to = date('Y-m-d', strtotime($this->year . '-' . 6 . '-' . 31));
                                    break;
                                case '03':
                                    $from = date('Y-m-d', strtotime($this->year . '-' . 7 . '-' . 1));
                                    $to = date('Y-m-d', strtotime($this->year . '-' . 9 . '-' .  31));
                                    break;
                                default:
                                    $from = date('Y-m-d', strtotime($this->year . '-' .  10 . '-' .  1));
                                    $to = date('Y-m-d', strtotime($this->year . '-' . 12  . '-' . 31));
                                    break;
                            }
                            $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                        })
                        ->where('gender', 'Female')
                        ->count();

                    $maleLiveRegister = BasicInfo::whereIn('user_id', $userSubjectIds)
                        ->where('status', 'Approved')
                        ->where('is_archive', 0)
                        // ->where('card_valid_till', '>=', now())
                        ->where('gender', 'Male')
                        ->count();

                    $femaleLiveRegister = BasicInfo::whereIn('user_id', $userSubjectIds)
                        ->where('status', 'Approved')
                        ->where('is_archive', 0)
                        // ->where('card_valid_till', '>=', now())
                        ->where('gender', 'Female')
                        ->count();

                    $maleLapsed = BasicInfo::whereIn('user_id', $userSubjectIds)
                        ->where('status', 'Approved')
                        ->where('is_archive', 0)
                        ->where('card_valid_till', '<', now())
                        ->where('gender', 'Male')
                        ->count();

                    $femaleLapsed = BasicInfo::whereIn('user_id', $userSubjectIds)
                        ->where('status', 'Approved')
                        ->where('is_archive', 0)
                        ->where('card_valid_till', '<', now())
                        ->where('gender', 'Female')
                        ->count();

                    $malePlaced = BasicInfo::whereIn('user_id', $userSubjectIds)
                        ->where('status', 'Approved')
                        ->where('is_archive', 0)
                        ->where('card_valid_till', '>=', now())
                        ->where('gender', 'Male')
                        ->where('is_placed', 1)
                        ->count();

                    $femalePlaced = BasicInfo::whereIn('user_id', $userSubjectIds)
                        ->where('status', 'Approved')
                        ->where('is_archive', 0)
                        ->where('card_valid_till', '>=', now())
                        ->where('gender', 'Female')
                        ->where('is_placed', 1)
                        ->count();

                    $this->maleReport += $maleInReport;
                    $this->femaleReport += $femaleInReport;
                    $this->maleLapsed += $maleLapsed;
                    $this->femaleLapsed += $femaleLapsed;
                    $this->malePlaced += $malePlaced;
                    $this->femalePlaced += $femalePlaced;
                    $this->maleLiveRegister += $maleLiveRegister;
                    $this->femaleLiveRegister += $femaleLiveRegister;

                    $this->educations[$index]['reports'][$subjIndex] = [
                        'maleReport' => $maleInReport,
                        'femaleReport' => $femaleInReport,
                        'totalReport' => ($maleInReport + $femaleInReport),
                        'maleLapsed' => $maleLapsed,
                        'femaleLapsed' => $femaleLapsed,
                        'totalLapsed' => ($maleLapsed + $femaleLapsed),
                        'malePlaced' => $malePlaced,
                        'femalePlaced' => $femalePlaced,
                        'totalPlaced' => ($malePlaced + $femalePlaced),
                        'maleLiveRegister' => $maleLiveRegister,
                        'femaleLiveRegister' => $femaleLiveRegister,
                        'totalLiveRegister' => ($maleLiveRegister + $femaleLiveRegister),
                    ];
                }
            } else {
                $userIds = EducationQualification::where('qualification_id', $quali['id'])->pluck('user_id');
                $maleInReport = BasicInfo::whereIn('user_id', $userIds)
                    ->where('status', 'Approved')
                    ->where('is_archive', 0)
                    ->where('card_valid_till', '>=', now())
                    ->when($this->district != 'All', function ($q) {
                        return $q->where('district_id', $this->district);
                    })
                    ->when($this->district == 'All', function ($q) {
                        return $q->whereIn('district_id', $this->authDistricts);
                    })
                    ->when($this->duration == 'Yearly', function ($q) {
                        $q->where('created_at', 'LIKE', $this->year . '%');
                    })
                    ->when($this->duration == 'Monthly', function ($q) {
                        $q->where('created_at', 'LIKE', date('Y-m', strtotime($this->year . '-' . $this->month)) . '%');
                    })
                    ->when($this->duration == 'Custom', function ($q) {
                        $q->where('created_at', '>=', date('Y-m-d', strtotime($this->from)))->where('created_at', '<=', date('Y-m-d', strtotime($this->to)));
                    })
                    ->when($this->duration == 'Half-Yearly', function ($q) {
                        $from = date('Y-m-d', strtotime($this->year . '-' . ($this->half == '01' ? 1 : 7) . '-1'));
                        $to = date('Y-m-d', strtotime($this->year . '-' . ($this->half == '01' ? 6 : 12) . '-31'));
                        $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                    })
                    ->when($this->duration == 'Quarterly', function ($q) {
                        switch ($this->quarter) {
                            case '01':
                                $from = date('Y-m-d', strtotime($this->year . '-' . 1 . '-' . 1));
                                $to = date('Y-m-d', strtotime($this->year . '-' . 3 . '-' . 30));
                                break;
                            case '02':
                                $from = date('Y-m-d', strtotime($this->year . '-' . 4 . '-' . 1));
                                $to = date('Y-m-d', strtotime($this->year . '-' . 6 . '-' . 31));
                                break;
                            case '03':
                                $from = date('Y-m-d', strtotime($this->year . '-' . 7 . '-' . 1));
                                $to = date('Y-m-d', strtotime($this->year . '-' . 9 . '-' .  31));
                                break;
                            default:
                                $from = date('Y-m-d', strtotime($this->year . '-' .  10 . '-' .  1));
                                $to = date('Y-m-d', strtotime($this->year . '-' . 12  . '-' . 31));
                                break;
                        }
                        $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                    })
                    ->where('gender', 'Male')
                    ->count();

                $femaleInReport = BasicInfo::whereIn('user_id', $userIds)
                    ->where('status', 'Approved')
                    ->where('is_archive', 0)
                    ->where('card_valid_till', '>=', now())
                    ->when($this->district != 'All', function ($q) {
                        return $q->where('district_id', $this->district);
                    })
                    ->when($this->district == 'All', function ($q) {
                        return $q->whereIn('district_id', $this->authDistricts);
                    })
                    ->when($this->duration == 'Yearly', function ($q) {
                        $q->where('created_at', 'LIKE', $this->year . '%');
                    })
                    ->when($this->duration == 'Monthly', function ($q) {
                        $q->where('created_at', 'LIKE', date('Y-m', strtotime($this->year . '-' . $this->month)) . '%');
                    })
                    ->when($this->duration == 'Custom', function ($q) {
                        $q->where('created_at', '>=', date('Y-m-d', strtotime($this->from)))->where('created_at', '<=', date('Y-m-d', strtotime($this->to)));
                    })
                    ->when($this->duration == 'Half-Yearly', function ($q) {
                        $from = date('Y-m-d', strtotime($this->year . '-' . ($this->half == '01' ? 1 : 7) . '-1'));
                        $to = date('Y-m-d', strtotime($this->year . '-' . ($this->half == '01' ? 6 : 12) . '-31'));
                        $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                    })
                    ->when($this->duration == 'Quarterly', function ($q) {
                        switch ($this->quarter) {
                            case '01':
                                $from = date('Y-m-d', strtotime($this->year . '-' . 1 . '-' . 1));
                                $to = date('Y-m-d', strtotime($this->year . '-' . 3 . '-' . 30));
                                break;
                            case '02':
                                $from = date('Y-m-d', strtotime($this->year . '-' . 4 . '-' . 1));
                                $to = date('Y-m-d', strtotime($this->year . '-' . 6 . '-' . 31));
                                break;
                            case '03':
                                $from = date('Y-m-d', strtotime($this->year . '-' . 7 . '-' . 1));
                                $to = date('Y-m-d', strtotime($this->year . '-' . 9 . '-' .  31));
                                break;
                            default:
                                $from = date('Y-m-d', strtotime($this->year . '-' .  10 . '-' .  1));
                                $to = date('Y-m-d', strtotime($this->year . '-' . 12  . '-' . 31));
                                break;
                        }
                        $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                    })
                    ->where('gender', 'Female')
                    ->count();

                $maleLiveRegister = BasicInfo::whereIn('user_id', $userIds)
                    ->where('status', 'Approved')
                    ->where('is_archive', 0)
                    // ->where('card_valid_till', '>=', now())
                    ->where('gender', 'Male')
                    ->count();

                $femaleLiveRegister = BasicInfo::whereIn('user_id', $userIds)
                    ->where('status', 'Approved')
                    ->where('is_archive', 0)
                    // ->where('card_valid_till', '>=', now())
                    ->where('gender', 'Female')
                    ->count();

                $maleLapsed = BasicInfo::whereIn('user_id', $userIds)
                    ->where('status', 'Approved')
                    ->where('is_archive', 0)
                    ->where('card_valid_till', '<', now())
                    ->where('gender', 'Male')
                    ->count();

                $femaleLapsed = BasicInfo::whereIn('user_id', $userIds)
                    ->where('status', 'Approved')
                    ->where('is_archive', 0)
                    ->where('card_valid_till', '<', now())
                    ->where('gender', 'Female')
                    ->count();

                $malePlaced = BasicInfo::whereIn('user_id', $userIds)
                    ->where('status', 'Approved')
                    ->where('is_archive', 0)
                    ->where('card_valid_till', '>=', now())
                    ->where('gender', 'Male')
                    ->where('is_placed', 1)
                    ->count();

                $femalePlaced = BasicInfo::whereIn('user_id', $userIds)
                    ->where('status', 'Approved')
                    ->where('is_archive', 0)
                    ->where('card_valid_till', '>=', now())
                    ->where('gender', 'Female')
                    ->where('is_placed', 1)
                    ->count();

                $this->maleReport += $maleInReport;
                $this->femaleReport += $femaleInReport;
                $this->maleLapsed += $maleLapsed;
                $this->femaleLapsed += $femaleLapsed;
                $this->malePlaced += $malePlaced;
                $this->femalePlaced += $femalePlaced;
                $this->maleLiveRegister += $maleLiveRegister;
                $this->femaleLiveRegister += $femaleLiveRegister;

                $this->educations[$index]['reports'] = [
                    'maleReport' => $maleInReport,
                    'femaleReport' => $femaleInReport,
                    'totalReport' => ($maleInReport + $femaleInReport),
                    'maleLapsed' => $maleLapsed,
                    'femaleLapsed' => $femaleLapsed,
                    'totalLapsed' => ($maleLapsed + $femaleLapsed),
                    'malePlaced' => $malePlaced,
                    'femalePlaced' => $femalePlaced,
                    'totalPlaced' => ($malePlaced + $femalePlaced),
                    'maleLiveRegister' => $maleLiveRegister,
                    'femaleLiveRegister' => $femaleLiveRegister,
                    'totalLiveRegister' => ($maleLiveRegister + $femaleLiveRegister),
                ];
            }
        }

        $this->subjectCount += count($this->educations);
        $this->totalReport = $this->maleReport + $this->femaleReport;
        $this->totalLapsed = $this->maleLapsed + $this->femaleLapsed;
        $this->totalPlaced = $this->malePlaced + $this->femalePlaced;
        $this->totalLiveRegister = $this->maleLiveRegister + $this->femaleLiveRegister;
    }

    public function generateCastReport($society)
    {
        if ($this->category == 'All' && $society == 'Mizo') {
            $allMizo = [];
            $this->maleReportMizo = 0;
            $this->femaleReportMizo = 0;
            $this->totalReportMizo = 0;
            $this->maleLapsedMizo = 0;
            $this->femaleLapsedMizo = 0;
            $this->totalLapsedMizo = 0;
            $this->malePlacedMizo = 0;
            $this->femalePlacedMizo = 0;
            $this->totalPlacedMizo = 0;
            $this->maleLiveRegisterMizo = 0;
            $this->femaleLiveRegisterMizo = 0;
            $this->totalLiveRegisterMizo = 0;
        } elseif ($this->category == 'All' && $society == 'Non-Mizo') {
            $allNonMizo = [];
            $this->maleReportNonMizo = 0;
            $this->femaleReportNonMizo = 0;
            $this->totalReportNonMizo = 0;
            $this->maleLapsedNonMizo = 0;
            $this->femaleLapsedNonMizo = 0;
            $this->totalLapsedNonMizo = 0;
            $this->malePlacedNonMizo = 0;
            $this->femalePlacedNonMizo = 0;
            $this->totalPlacedNonMizo = 0;
            $this->maleLiveRegisterNonMizo = 0;
            $this->femaleLiveRegisterNonMizo = 0;
            $this->totalLiveRegisterNonMizo = 0;
        } else {
            $this->maleReport = 0;
            $this->femaleReport = 0;
            $this->totalReport = 0;
            $this->maleLapsed = 0;
            $this->femaleLapsed = 0;
            $this->totalLapsed = 0;
            $this->malePlaced = 0;
            $this->femalePlaced = 0;
            $this->totalPlaced = 0;
            $this->maleLiveRegister = 0;
            $this->femaleLiveRegister = 0;
            $this->totalLiveRegister = 0;
            $reports = [];
        }


        $qualifications = Qualification::get();

        foreach ($qualifications as $quali) {
            $userIds = EducationQualification::where('qualification_id', $quali->id)->pluck('user_id');
            $maleInReport = BasicInfo::whereIn('user_id', $userIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '>=', now())
                ->where('society', $society)
                ->when($this->district != 'All', function ($q) {
                    return $q->where('district_id', $this->district);
                })
                ->when($this->district == 'All', function ($q) {
                    return $q->whereIn('district_id', $this->authDistricts);
                })
                ->when($this->duration == 'Yearly', function ($q) {
                    $q->where('created_at', 'LIKE', $this->year . '%');
                })
                ->when($this->duration == 'Monthly', function ($q) {
                    $q->where('created_at', 'LIKE', date('Y-m', strtotime($this->year . '-' . $this->month)) . '%');
                })
                ->when($this->duration == 'Custom', function ($q) {
                    $q->where('created_at', '>=', date('Y-m-d', strtotime($this->from)))->where('created_at', '<=', date('Y-m-d', strtotime($this->to)));
                })
                ->when($this->duration == 'Half-Yearly', function ($q) {
                    $from = date('Y-m-d', strtotime($this->year . '-' . ($this->half == '01' ? 1 : 7) . '-1'));
                    $to = date('Y-m-d', strtotime($this->year . '-' . ($this->half == '01' ? 6 : 12) . '-31'));
                    $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                })
                ->when($this->duration == 'Quarterly', function ($q) {
                    switch ($this->quarter) {
                        case '01':
                            $from = date('Y-m-d', strtotime($this->year . '-' . 1 . '-' . 1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 3 . '-' . 30));
                            break;
                        case '02':
                            $from = date('Y-m-d', strtotime($this->year . '-' . 4 . '-' . 1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 6 . '-' . 31));
                            break;
                        case '03':
                            $from = date('Y-m-d', strtotime($this->year . '-' . 7 . '-' . 1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 9 . '-' .  31));
                            break;
                        default:
                            $from = date('Y-m-d', strtotime($this->year . '-' .  10 . '-' .  1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 12  . '-' . 31));
                            break;
                    }
                    $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                })
                ->where('gender', 'Male')
                ->count();

            $femaleInReport = BasicInfo::whereIn('user_id', $userIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '>=', now())
                ->where('society', $society)
                ->when($this->district != 'All', function ($q) {
                    return $q->where('district_id', $this->district);
                })
                ->when($this->district == 'All', function ($q) {
                    return $q->whereIn('district_id', $this->authDistricts);
                })
                ->when($this->duration == 'Yearly', function ($q) {
                    $q->where('created_at', 'LIKE', $this->year . '%');
                })
                ->when($this->duration == 'Monthly', function ($q) {
                    $q->where('created_at', 'LIKE', date('Y-m', strtotime($this->year . '-' . $this->month)) . '%');
                })
                ->when($this->duration == 'Custom', function ($q) {
                    $q->where('created_at', '>=', date('Y-m-d', strtotime($this->from)))->where('created_at', '<=', date('Y-m-d', strtotime($this->to)));
                })
                ->when($this->duration == 'Half-Yearly', function ($q) {
                    $from = date('Y-m-d', strtotime($this->year . '-' . ($this->half == '01' ? 1 : 7) . '-1'));
                    $to = date('Y-m-d', strtotime($this->year . '-' . ($this->half == '01' ? 6 : 12) . '-31'));
                    $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                })
                ->when($this->duration == 'Quarterly', function ($q) {
                    switch ($this->quarter) {
                        case '01':
                            $from = date('Y-m-d', strtotime($this->year . '-' . 1 . '-' . 1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 3 . '-' . 30));
                            break;
                        case '02':
                            $from = date('Y-m-d', strtotime($this->year . '-' . 4 . '-' . 1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 6 . '-' . 31));
                            break;
                        case '03':
                            $from = date('Y-m-d', strtotime($this->year . '-' . 7 . '-' . 1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 9 . '-' .  31));
                            break;
                        default:
                            $from = date('Y-m-d', strtotime($this->year . '-' .  10 . '-' .  1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 12  . '-' . 31));
                            break;
                    }
                    $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                })
                ->where('gender', 'Female')
                ->count();

            $maleLiveRegister = BasicInfo::whereIn('user_id', $userIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                // ->where('card_valid_till', '>=', now())
                ->where('society', $society)
                ->where('gender', 'Male')
                ->count();

            $femaleLiveRegister = BasicInfo::whereIn('user_id', $userIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                // ->where('card_valid_till', '>=', now())
                ->where('society', $society)
                ->where('gender', 'Female')
                ->count();

            $maleLapsed = BasicInfo::whereIn('user_id', $userIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '<', now())
                ->where('society', $society)
                ->where('gender', 'Male')
                ->count();

            $femaleLapsed = BasicInfo::whereIn('user_id', $userIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '<', now())
                ->where('society', $society)
                ->where('gender', 'Female')
                ->count();

            $malePlaced = BasicInfo::whereIn('user_id', $userIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '>=', now())
                ->where('society', $society)
                ->where('gender', 'Male')
                ->where('is_placed', 1)
                ->count();

            $femalePlaced = BasicInfo::whereIn('user_id', $userIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '>=', now())
                ->where('society', $society)
                ->where('gender', 'Female')
                ->where('is_placed', 1)
                ->count();

            if ($this->category == 'All' && $society == 'Mizo') {
                $this->maleReportMizo += $maleInReport;
                $this->femaleReportMizo += $femaleInReport;
                $this->maleLapsedMizo += $maleLapsed;
                $this->femaleLapsedMizo += $femaleLapsed;
                $this->malePlacedMizo += $malePlaced;
                $this->femalePlacedMizo += $femalePlaced;
                $this->maleLiveRegisterMizo += $maleLiveRegister;
                $this->femaleLiveRegisterMizo += $femaleLiveRegister;

                array_push($allMizo, [
                    'category' => $quali->name,
                    'maleReport' => $maleInReport,
                    'femaleReport' => $femaleInReport,
                    'totalReport' => ($maleInReport + $femaleInReport),
                    'maleLapsed' => $maleLapsed,
                    'femaleLapsed' => $femaleLapsed,
                    'totalLapsed' => ($maleLapsed + $femaleLapsed),
                    'malePlaced' => $malePlaced,
                    'femalePlaced' => $femalePlaced,
                    'totalPlaced' => ($malePlaced + $femalePlaced),
                    'maleLiveRegister' => $maleLiveRegister,
                    'femaleLiveRegister' => $femaleLiveRegister,
                    'totalLiveRegister' => ($maleLiveRegister + $femaleLiveRegister),
                ]);
            } elseif ($this->category == 'All' && $society == 'Non-Mizo') {
                $this->maleReportNonMizo += $maleInReport;
                $this->femaleReportNonMizo += $femaleInReport;
                $this->maleLapsedNonMizo += $maleLapsed;
                $this->femaleLapsedNonMizo += $femaleLapsed;
                $this->malePlacedNonMizo += $malePlaced;
                $this->femalePlacedNonMizo += $femalePlaced;
                $this->maleLiveRegisterNonMizo += $maleLiveRegister;
                $this->femaleLiveRegisterNonMizo += $femaleLiveRegister;
                array_push($allNonMizo, [
                    'category' => $quali->name,
                    'maleReport' => $maleInReport,
                    'femaleReport' => $femaleInReport,
                    'totalReport' => ($maleInReport + $femaleInReport),
                    'maleLapsed' => $maleLapsed,
                    'femaleLapsed' => $femaleLapsed,
                    'totalLapsed' => ($maleLapsed + $femaleLapsed),
                    'malePlaced' => $malePlaced,
                    'femalePlaced' => $femalePlaced,
                    'totalPlaced' => ($malePlaced + $femalePlaced),
                    'maleLiveRegister' => $maleLiveRegister,
                    'femaleLiveRegister' => $femaleLiveRegister,
                    'totalLiveRegister' => ($maleLiveRegister + $femaleLiveRegister),
                ]);
            } else {
                $this->maleReport += $maleInReport;
                $this->femaleReport += $femaleInReport;
                $this->maleLapsed += $maleLapsed;
                $this->femaleLapsed += $femaleLapsed;
                $this->malePlaced += $malePlaced;
                $this->femalePlaced += $femalePlaced;
                $this->maleLiveRegister += $maleLiveRegister;
                $this->femaleLiveRegister += $femaleLiveRegister;

                array_push($reports, [
                    'category' => $quali->name,
                    'maleReport' => $maleInReport,
                    'femaleReport' => $femaleInReport,
                    'totalReport' => ($maleInReport + $femaleInReport),
                    'maleLapsed' => $maleLapsed,
                    'femaleLapsed' => $femaleLapsed,
                    'totalLapsed' => ($maleLapsed + $femaleLapsed),
                    'malePlaced' => $malePlaced,
                    'femalePlaced' => $femalePlaced,
                    'totalPlaced' => ($malePlaced + $femalePlaced),
                    'maleLiveRegister' => $maleLiveRegister,
                    'femaleLiveRegister' => $femaleLiveRegister,
                    'totalLiveRegister' => ($maleLiveRegister + $femaleLiveRegister),
                ]);
            }
        }

        if ($this->category == 'All' && $society == 'Mizo') {
            $this->allMizo = $allMizo;
            $this->totalReportMizo = $this->maleReportMizo + $this->femaleReportMizo;
            $this->totalLapsedMizo = $this->maleLapsedMizo + $this->femaleLapsedMizo;
            $this->totalPlacedMizo = $this->malePlacedMizo + $this->femalePlacedMizo;
            $this->totalLiveRegisterMizo = $this->maleLiveRegisterMizo + $this->femaleLiveRegisterMizo;
        } elseif ($this->category == 'All' && $society == 'Non-Mizo') {
            $this->allNonMizo = $allNonMizo;
            $this->totalReportNonMizo = $this->maleReportNonMizo + $this->femaleReportNonMizo;
            $this->totalLapsedNonMizo = $this->maleLapsedNonMizo + $this->femaleLapsedNonMizo;
            $this->totalPlacedNonMizo = $this->malePlacedNonMizo + $this->femalePlacedNonMizo;
            $this->totalLiveRegisterNonMizo = $this->maleLiveRegisterNonMizo + $this->femaleLiveRegisterNonMizo;
        } else {
            $this->reports = $reports;
            $this->totalReport = $this->maleReport + $this->femaleReport;
            $this->totalLapsed = $this->maleLapsed + $this->femaleLapsed;
            $this->totalPlaced = $this->malePlaced + $this->femalePlaced;
            $this->totalLiveRegister = $this->maleLiveRegister + $this->femaleLiveRegister;
        }
    }

    public function generateHandicappedReport()
    {
        if ($this->category == 'All') {
            $allPhysical = [];
            $this->maleReportPhysical = 0;
            $this->femaleReportPhysical = 0;
            $this->totalReportPhysical = 0;
            $this->maleLapsedPhysical = 0;
            $this->femaleLapsedPhysical = 0;
            $this->totalLapsedPhysical = 0;
            $this->malePlacedPhysical = 0;
            $this->femalePlacedPhysical = 0;
            $this->totalPlacedPhysical = 0;
            $this->maleLiveRegisterPhysical = 0;
            $this->femaleLiveRegisterPhysical = 0;
            $this->totalLiveRegisterPhysical = 0;
        } else {
            $this->maleReport = 0;
            $this->femaleReport = 0;
            $this->totalReport = 0;
            $this->maleLapsed = 0;
            $this->femaleLapsed = 0;
            $this->totalLapsed = 0;
            $this->malePlaced = 0;
            $this->femalePlaced = 0;
            $this->totalPlaced = 0;
            $this->maleLiveRegister = 0;
            $this->femaleLiveRegister = 0;
            $this->totalLiveRegister = 0;
            $reports = [];
        }

        $categories = PhysicalChallenge::get();

        foreach ($categories as $category) {
            $userPhysicalIds = UserPhysicalChallenge::where('physical_challenge_id', $category->id)->pluck('user_id');
            $maleInReport = BasicInfo::where('physically_challenge', 1)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '>=', now())
                ->whereIn('user_id', $userPhysicalIds)
                ->when($this->district != 'All', function ($q) {
                    return $q->where('district_id', $this->district);
                })
                ->when($this->district == 'All', function ($q) {
                    return $q->whereIn('district_id', $this->authDistricts);
                })
                ->when($this->duration == 'Yearly', function ($q) {
                    $q->where('created_at', 'LIKE', $this->year . '%');
                })
                ->when($this->duration == 'Monthly', function ($q) {
                    $q->where('created_at', 'LIKE', date('Y-m', strtotime($this->year . '-' . $this->month)) . '%');
                })
                ->when($this->duration == 'Custom', function ($q) {
                    $q->where('created_at', '>=', date('Y-m-d', strtotime($this->from)))->where('created_at', '<=', date('Y-m-d', strtotime($this->to)));
                })
                ->when($this->duration == 'Half-Yearly', function ($q) {
                    $from = date('Y-m-d', strtotime($this->year . '-' . ($this->half == '01' ? 1 : 7) . '-1'));
                    $to = date('Y-m-d', strtotime($this->year . '-' . ($this->half == '01' ? 6 : 12) . '-31'));
                    $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                })
                ->when($this->duration == 'Quarterly', function ($q) {
                    switch ($this->quarter) {
                        case '01':
                            $from = date('Y-m-d', strtotime($this->year . '-' . 1 . '-' . 1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 3 . '-' . 30));
                            break;
                        case '02':
                            $from = date('Y-m-d', strtotime($this->year . '-' . 4 . '-' . 1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 6 . '-' . 31));
                            break;
                        case '03':
                            $from = date('Y-m-d', strtotime($this->year . '-' . 7 . '-' . 1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 9 . '-' .  31));
                            break;
                        default:
                            $from = date('Y-m-d', strtotime($this->year . '-' .  10 . '-' .  1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 12  . '-' . 31));
                            break;
                    }
                    $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                })
                ->where('gender', 'Male')
                ->count();

            $femaleInReport = BasicInfo::where('physically_challenge', 1)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '>=', now())
                ->whereIn('user_id', $userPhysicalIds)
                ->when($this->district != 'All', function ($q) {
                    return $q->where('district_id', $this->district);
                })
                ->when($this->district == 'All', function ($q) {
                    return $q->whereIn('district_id', $this->authDistricts);
                })
                ->when($this->duration == 'Yearly', function ($q) {
                    $q->where('created_at', 'LIKE', $this->year . '%');
                })
                ->when($this->duration == 'Monthly', function ($q) {
                    $q->where('created_at', 'LIKE', date('Y-m', strtotime($this->year . '-' . $this->month)) . '%');
                })
                ->when($this->duration == 'Custom', function ($q) {
                    $q->where('created_at', '>=', date('Y-m-d', strtotime($this->from)))->where('created_at', '<=', date('Y-m-d', strtotime($this->to)));
                })
                ->when($this->duration == 'Half-Yearly', function ($q) {
                    $from = date('Y-m-d', strtotime($this->year, $this->half == '01' ? 1 : 7), 1);
                    $to = date('Y-m-d', strtotime($this->year, $this->half == '01' ? 6 : 12), 31);
                    $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                })
                ->when($this->duration == 'Quarterly', function ($q) {
                    switch ($this->quarter) {
                        case '01':
                            $from = date('Y-m-d', strtotime($this->year . '-' . 1 . '-' . 1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 3 . '-' . 30));
                            break;
                        case '02':
                            $from = date('Y-m-d', strtotime($this->year . '-' . 4 . '-' . 1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 6 . '-' . 31));
                            break;
                        case '03':
                            $from = date('Y-m-d', strtotime($this->year . '-' . 7 . '-' . 1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 9 . '-' .  31));
                            break;
                        default:
                            $from = date('Y-m-d', strtotime($this->year . '-' .  10 . '-' .  1));
                            $to = date('Y-m-d', strtotime($this->year . '-' . 12  . '-' . 31));
                            break;
                    }
                    $q->where('created_at', '>=', date('Y-m-d', strtotime($from)))->where('created_at', '<=', date('Y-m-d', strtotime($to)));
                })
                ->where('gender', 'Female')
                ->count();

            $maleLiveRegister = BasicInfo::whereIn('user_id', $userPhysicalIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '>=', now())
                ->where('gender', 'Male')
                ->count();

            $femaleLiveRegister = BasicInfo::whereIn('user_id', $userPhysicalIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '>=', now())
                ->where('gender', 'Female')
                ->count();

            $maleLapsed = BasicInfo::whereIn('user_id', $userPhysicalIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '<', now())
                ->where('gender', 'Male')
                ->count();

            $femaleLapsed = BasicInfo::whereIn('user_id', $userPhysicalIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '<', now())
                ->where('gender', 'Female')
                ->count();

            $malePlaced = BasicInfo::whereIn('user_id', $userPhysicalIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '>=', now())
                ->where('gender', 'Male')
                ->where('is_placed', 1)
                ->count();

            $femalePlaced = BasicInfo::whereIn('user_id', $userPhysicalIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '>=', now())
                ->where('gender', 'Female')
                ->where('is_placed', 1)
                ->count();

            if ($this->category == 'All') {
                $this->maleReportPhysical += $maleInReport;
                $this->femaleReportPhysical += $femaleInReport;
                $this->maleLapsedPhysical += $maleLapsed;
                $this->femaleLapsedPhysical += $femaleLapsed;
                $this->malePlacedPhysical += $malePlaced;
                $this->femalePlacedPhysical += $femalePlaced;
                $this->maleLiveRegisterPhysical += $maleLiveRegister;
                $this->femaleLiveRegisterPhysical += $femaleLiveRegister;

                array_push($allPhysical, [
                    'category' => $category->name,
                    'maleReport' => $maleInReport,
                    'femaleReport' => $femaleInReport,
                    'totalReport' => ($maleInReport + $femaleInReport),
                    'maleLapsed' => $maleLapsed,
                    'femaleLapsed' => $femaleLapsed,
                    'totalLapsed' => ($maleLapsed + $femaleLapsed),
                    'malePlaced' => $malePlaced,
                    'femalePlaced' => $femalePlaced,
                    'totalPlaced' => ($malePlaced + $femalePlaced),
                    'maleLiveRegister' => $maleLiveRegister,
                    'femaleLiveRegister' => $femaleLiveRegister,
                    'totalLiveRegister' => ($maleLiveRegister + $femaleLiveRegister),
                ]);
            } else {
                $this->maleReport += $maleInReport;
                $this->femaleReport += $femaleInReport;
                $this->maleLapsed += $maleLapsed;
                $this->femaleLapsed += $femaleLapsed;
                $this->malePlaced += $malePlaced;
                $this->femalePlaced += $femalePlaced;
                $this->maleLiveRegister += $maleLiveRegister;
                $this->femaleLiveRegister += $femaleLiveRegister;

                array_push($reports, [
                    'category' => $category->name,
                    'maleReport' => $maleInReport,
                    'femaleReport' => $femaleInReport,
                    'totalReport' => ($maleInReport + $femaleInReport),
                    'maleLapsed' => $maleLapsed,
                    'femaleLapsed' => $femaleLapsed,
                    'totalLapsed' => ($maleLapsed + $femaleLapsed),
                    'malePlaced' => $malePlaced,
                    'femalePlaced' => $femalePlaced,
                    'totalPlaced' => ($malePlaced + $femalePlaced),
                    'maleLiveRegister' => $maleLiveRegister,
                    'femaleLiveRegister' => $femaleLiveRegister,
                    'totalLiveRegister' => ($maleLiveRegister + $femaleLiveRegister),
                ]);
            }
        }

        if ($this->category == 'All') {
            $this->allPhysical = $allPhysical;
            $this->totalReportPhysical = $this->maleReportPhysical + $this->femaleReportPhysical;
            $this->totalLapsedPhysical = $this->maleLapsedPhysical + $this->femaleLapsedPhysical;
            $this->totalPlacedPhysical = $this->malePlacedPhysical + $this->femalePlacedPhysical;
            $this->totalLiveRegisterPhysical = $this->maleLiveRegisterPhysical + $this->femaleLiveRegisterPhysical;
        } else {
            $this->reports = $reports;
            $this->totalReport = $this->maleReport + $this->femaleReport;
            $this->totalLapsed = $this->maleLapsed + $this->femaleLapsed;
            $this->totalPlaced = $this->malePlaced + $this->femalePlaced;
            $this->totalLiveRegister = $this->maleLiveRegister + $this->femaleLiveRegister;
        }
    }

    public function downloadEducation()
    {
        return Excel::download(new TotalEducationExport(
            $this->educations,
            $this->duration,
            $this->maleReport,
            $this->femaleReport,
            $this->totalReport,
            $this->maleLapsed,
            $this->femaleLapsed,
            $this->totalLapsed,
            $this->malePlaced,
            $this->femalePlaced,
            $this->totalPlaced,
            $this->maleLiveRegister,
            $this->femaleLiveRegister,
            $this->totalLiveRegister,
            $this->districtName,
            $this->monthName,
            $this->year,
            $this->month,
            $this->quarter,
            $this->half,
            $this->subjectCount,
        ), "$this->category.xlsx");
    }

    public function downloadAllReport()
    {
        $this->generateEducationReport();

        return Excel::download(new AllTotalReport(
            // mizo
            $this->allMizo,
            $this->maleReportMizo,
            $this->femaleReportMizo,
            $this->totalReportMizo,
            $this->maleLapsedMizo,
            $this->femaleLapsedMizo,
            $this->totalLapsedMizo,
            $this->malePlacedMizo,
            $this->femalePlacedMizo,
            $this->totalPlacedMizo,
            $this->maleLiveRegisterMizo,
            $this->femaleLiveRegisterMizo,
            $this->totalLiveRegisterMizo,

            // non-mizo
            $this->allNonMizo,
            $this->maleReportNonMizo,
            $this->femaleReportNonMizo,
            $this->totalReportNonMizo,
            $this->maleLapsedNonMizo,
            $this->femaleLapsedNonMizo,
            $this->totalLapsedNonMizo,
            $this->malePlacedNonMizo,
            $this->femalePlacedNonMizo,
            $this->totalPlacedNonMizo,
            $this->maleLiveRegisterNonMizo,
            $this->femaleLiveRegisterNonMizo,
            $this->totalLiveRegisterNonMizo,

            // physical
            $this->allPhysical,
            $this->maleReportPhysical,
            $this->femaleReportPhysical,
            $this->totalReportPhysical,
            $this->maleLapsedPhysical,
            $this->femaleLapsedPhysical,
            $this->totalLapsedPhysical,
            $this->malePlacedPhysical,
            $this->femalePlacedPhysical,
            $this->totalPlacedPhysical,
            $this->maleLiveRegisterPhysical,
            $this->femaleLiveRegisterPhysical,
            $this->totalLiveRegisterPhysical,

            // education
            $this->educations,
            $this->maleReport,
            $this->femaleReport,
            $this->totalReport,
            $this->maleLapsed,
            $this->femaleLapsed,
            $this->totalLapsed,
            $this->malePlaced,
            $this->femalePlaced,
            $this->totalPlaced,
            $this->maleLiveRegister,
            $this->femaleLiveRegister,
            $this->totalLiveRegister,

            $this->duration,
            $this->districtName,
            $this->monthName,
            $this->year,
            $this->month,
            $this->quarter,
            $this->half,
            $this->subjectCount,
        ), 'all-total-registration.xlsx');
    }

    public function downloadReport()
    {
        return Excel::download(new ReportExport(
            $this->reports,
            $this->category,
            $this->duration,
            $this->maleReport,
            $this->femaleReport,
            $this->totalReport,
            $this->maleLapsed,
            $this->femaleLapsed,
            $this->totalLapsed,
            $this->malePlaced,
            $this->femalePlaced,
            $this->totalPlaced,
            $this->maleLiveRegister,
            $this->femaleLiveRegister,
            $this->totalLiveRegister,
            $this->districtName,
            $this->monthName,
            $this->year,
            $this->month,
            $this->quarter,
            $this->half,
            //added rj
            $this->from,
            $this->to,
        ), "$this->category.xlsx");
    }

    public function mount()
    {
        $authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
        $this->authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id');
        $this->districts = District::orderBy('name', 'ASC')->whereIn('id', $authDistricts)->get();

        $this->reports = collect();

        // get year from 2020 till current year
        for ($i = '2020'; $i <= date('Y'); $i++) {
            $this->years[] = $i;
        }
        $this->years = array_reverse($this->years);

        $this->from = date('Y-m-d');
        $date = new DateTime('+1 day');
        $this->to =  $date->format('Y-m-d');
        $this->month = date('m');
    }

    public function updatedCondition()
    {
        $this->generated = false;
        $this->buttonEnable = true;
    }

    public function updatedCategory()
    {
        $this->updatedCondition();
    }

    public function updatedDistrict()
    {
        $this->updatedCondition();
    }

    public function updatedDuration()
    {
        $this->updatedCondition();
    }

    public function updatedMonth()
    {
        $this->updatedCondition();
    }

    public function updatedQuarter()
    {
        $this->updatedCondition();
    }

    public function updatedHalf()
    {
        $this->updatedCondition();
    }

    public function updatedFrom()
    {
        $this->updatedCondition();
    }

    public function updatedTo()
    {
        $this->updatedCondition();
    }

    public function updatedYear()
    {
        $this->updatedCondition();
    }

    public function render()
    {
        return view('livewire.district.reports.total-registration');
    }
}
