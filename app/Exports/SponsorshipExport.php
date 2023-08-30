<?php

namespace App\Exports;

use App\Models\BasicInfo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SponsorshipExport implements FromView, WithEvents, ShouldAutoSize
{
  protected $users;
  protected $name;
  protected $employer;
  protected $address;
  protected $date;

  public function __construct($users, $name, $employer, $address, $date)
  {
    $this->users = $users;
    $this->name = $name;
    $this->employer = $employer;
    $this->address = $address;
    $this->date = $date;
  }

  public function registerEvents(): array
  {
    return [
      AfterSheet::class => function (AfterSheet $event) {
        $event->sheet
          ->getStyle('A1:K' . (count($this->users) + 6))
          ->applyFromArray([
            'borders' => [
              'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
              ],
            ],
          ])
          ->getAlignment()
          ->setHorizontal('center')
          ->setVertical('center')
          ->setWrapText(true);

        $event->sheet
          ->getDelegate()
          ->getStyle('A2:K4')
          ->getAlignment()
          ->setHorizontal('left');

        $event->sheet
          ->getDelegate()
          ->getStyle('A1:K1')
          ->getFont()
          ->setBold(true);

        $event->sheet
          ->getDelegate()
          ->getStyle('A1:A4')
          ->getFont()
          ->setBold(true);

        $event->sheet
          ->getDelegate()
          ->getStyle('A5:K6')
          ->getFont()
          ->setBold(true);
      },
    ];
  }

  public function view(): View
  {
    return view('exports.users', [
      'users' => $this->users,
      'name' => $this->name,
      'employer' => $this->employer,
      'address' => $this->address,
      'date' => $this->date,
    ]);
  }
}
