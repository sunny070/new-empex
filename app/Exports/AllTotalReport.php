<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AllTotalReport implements WithMultipleSheets, ShouldAutoSize
{
    protected $allMizo;
    protected $maleReportMizo;
    protected $femaleReportMizo;
    protected $totalReportMizo;
    protected $maleLapsedMizo;
    protected $femaleLapsedMizo;
    protected $totalLapsedMizo;
    protected $malePlacedMizo;
    protected $femalePlacedMizo;
    protected $totalPlacedMizo;
    protected $maleLiveRegisterMizo;
    protected $femaleLiveRegisterMizo;
    protected $totalLiveRegisterMizo;

    protected $allNonMizo;
    protected $maleReportNonMizo;
    protected $femaleReportNonMizo;
    protected $totalReportNonMizo;
    protected $maleLapsedNonMizo;
    protected $femaleLapsedNonMizo;
    protected $totalLapsedNonMizo;
    protected $malePlacedNonMizo;
    protected $femalePlacedNonMizo;
    protected $totalPlacedNonMizo;
    protected $maleLiveRegisterNonMizo;
    protected $femaleLiveRegisterNonMizo;
    protected $totalLiveRegisterNonMizo;

    protected $allPhysical;
    protected $maleReportPhysical;
    protected $femaleReportPhysical;
    protected $totalReportPhysical;
    protected $maleLapsedPhysical;
    protected $femaleLapsedPhysical;
    protected $totalLapsedPhysical;
    protected $malePlacedPhysical;
    protected $femalePlacedPhysical;
    protected $totalPlacedPhysical;
    protected $maleLiveRegisterPhysical;
    protected $femaleLiveRegisterPhysical;
    protected $totalLiveRegisterPhysical;

    protected $education;
    protected $maleReport;
    protected $femaleReport;
    protected $totalReport;
    protected $maleLapsed;
    protected $femaleLapsed;
    protected $totalLapsed;
    protected $malePlaced;
    protected $femalePlaced;
    protected $totalPlaced;
    protected $maleLiveRegister;
    protected $femaleLiveRegister;
    protected $totalLiveRegister;

    protected $duration;
    protected $districtName;
    protected $monthName;
    protected $year;
    protected $month;
    protected $quarter;
    protected $half;
    protected $subjectCount;

    public function __construct(
        $allMizo,
        $maleReportMizo,
        $femaleReportMizo,
        $totalReportMizo,
        $maleLapsedMizo,
        $femaleLapsedMizo,
        $totalLapsedMizo,
        $malePlacedMizo,
        $femalePlacedMizo,
        $totalPlacedMizo,
        $maleLiveRegisterMizo,
        $femaleLiveRegisterMizo,
        $totalLiveRegisterMizo,

        $allNonMizo,
        $maleReportNonMizo,
        $femaleReportNonMizo,
        $totalReportNonMizo,
        $maleLapsedNonMizo,
        $femaleLapsedNonMizo,
        $totalLapsedNonMizo,
        $malePlacedNonMizo,
        $femalePlacedNonMizo,
        $totalPlacedNonMizo,
        $maleLiveRegisterNonMizo,
        $femaleLiveRegisterNonMizo,
        $totalLiveRegisterNonMizo,

        $allPhysical,
        $maleReportPhysical,
        $femaleReportPhysical,
        $totalReportPhysical,
        $maleLapsedPhysical,
        $femaleLapsedPhysical,
        $totalLapsedPhysical,
        $malePlacedPhysical,
        $femalePlacedPhysical,
        $totalPlacedPhysical,
        $maleLiveRegisterPhysical,
        $femaleLiveRegisterPhysical,
        $totalLiveRegisterPhysical,

        $education,
        $maleInReport,
        $femaleInReport,
        $totalInReport,
        $maleLapsed,
        $femaleLapsed,
        $totalLapsed,
        $malePlaced,
        $femalePlaced,
        $totalPlaced,
        $maleLiveRegistration,
        $femaleLiveRegistration,
        $totalLiveRegistration,

        $duration,
        $districtName,
        $monthName,
        $year,
        $month,
        $quarter,
        $half,
        $subjectCount
    ) {
        $this->allMizo = $allMizo;
        $this->maleReportMizo = $maleReportMizo;
        $this->femaleReportMizo = $femaleReportMizo;
        $this->totalReportMizo = $totalReportMizo;
        $this->maleLapsedMizo = $maleLapsedMizo;
        $this->femaleLapsedMizo = $femaleLapsedMizo;
        $this->totalLapsedMizo = $totalLapsedMizo;
        $this->malePlacedMizo = $malePlacedMizo;
        $this->femalePlacedMizo = $femalePlacedMizo;
        $this->totalPlacedMizo = $totalPlacedMizo;
        $this->maleLiveRegisterMizo = $maleLiveRegisterMizo;
        $this->femaleLiveRegisterMizo = $femaleLiveRegisterMizo;
        $this->totalLiveRegisterMizo = $totalLiveRegisterMizo;

        $this->allNonMizo = $allNonMizo;
        $this->maleReportNonMizo = $maleReportNonMizo;
        $this->femaleReportNonMizo = $femaleReportNonMizo;
        $this->totalReportNonMizo = $totalReportNonMizo;
        $this->maleLapsedNonMizo = $maleLapsedNonMizo;
        $this->femaleLapsedNonMizo = $femaleLapsedNonMizo;
        $this->totalLapsedNonMizo = $totalLapsedNonMizo;
        $this->malePlacedNonMizo = $malePlacedNonMizo;
        $this->femalePlacedNonMizo = $femalePlacedNonMizo;
        $this->totalPlacedNonMizo = $totalPlacedNonMizo;
        $this->maleLiveRegisterNonMizo = $maleLiveRegisterNonMizo;
        $this->femaleLiveRegisterNonMizo = $femaleLiveRegisterNonMizo;
        $this->totalLiveRegisterNonMizo = $totalLiveRegisterNonMizo;

        $this->allPhysical = $allPhysical;
        $this->maleReportPhysical = $maleReportPhysical;
        $this->femaleReportPhysical = $femaleReportPhysical;
        $this->totalReportPhysical = $totalReportPhysical;
        $this->maleLapsedPhysical = $maleLapsedPhysical;
        $this->femaleLapsedPhysical = $femaleLapsedPhysical;
        $this->totalLapsedPhysical = $totalLapsedPhysical;
        $this->malePlacedPhysical = $malePlacedPhysical;
        $this->femalePlacedPhysical = $femalePlacedPhysical;
        $this->totalPlacedPhysical = $totalPlacedPhysical;
        $this->maleLiveRegisterPhysical = $maleLiveRegisterPhysical;
        $this->femaleLiveRegisterPhysical = $femaleLiveRegisterPhysical;
        $this->totalLiveRegisterPhysical = $totalLiveRegisterPhysical;

        $this->education = $education;
        $this->maleInReport = $maleInReport;
        $this->femaleInReport = $femaleInReport;
        $this->totalInReport = $totalInReport;
        $this->maleLapsed = $maleLapsed;
        $this->femaleLapsed = $femaleLapsed;
        $this->totalLapsed = $totalLapsed;
        $this->malePlaced = $malePlaced;
        $this->femalePlaced = $femalePlaced;
        $this->totalPlaced = $totalPlaced;
        $this->maleLiveRegistration = $maleLiveRegistration;
        $this->femaleLiveRegistration = $femaleLiveRegistration;
        $this->totalLiveRegistration = $totalLiveRegistration;
        $this->subjectCount = $subjectCount;

        $this->duration = $duration;
        $this->districtName = $districtName;
        $this->monthName = $monthName;
        $this->year = $year;
        $this->month = $month;
        $this->quarter = $quarter;
        $this->half = $half;
    }

    public function sheets(): array
    {
        return [
            new ReportExport(
                $this->allMizo,
                'Mizo',
                $this->duration,
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
                $this->districtName,
                $this->monthName,
                $this->year,
                $this->month,
                $this->quarter,
                $this->half,

                 //added rj
                 null,
                 null,
            ),

            new ReportExport(
                $this->allNonMizo,
                'Non-Mizo',
                $this->duration,
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
                $this->districtName,
                $this->monthName,
                $this->year,
                $this->month,
                $this->quarter,
                $this->half,
                //added rj
                null,
                null,
            ),

            new ReportExport(
                $this->allPhysical,
                'Physically Handicapped',
                $this->duration,
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
                $this->districtName,
                $this->monthName,
                $this->year,
                $this->month,
                $this->quarter,
                $this->half,
                 //added rj
                 null,
                 null,
            ),

            new TotalEducationExport(
                $this->education,
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
            )
        ];
    }
}
