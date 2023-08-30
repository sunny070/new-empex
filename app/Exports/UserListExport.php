<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UserListExport implements FromView, WithEvents, ShouldAutoSize
{
	protected $reports;
	protected $selectedQualification;
	protected $selectedSubject;
	protected $selectedCore;
	protected $districtName;

	public function __construct($reports, $selectedQualification, $selectedSubject, $selectedCore, $districtName)
	{
		$this->reports = $reports;
		$this->selectedQualification = $selectedQualification;
		$this->selectedSubject = $selectedSubject;
		$this->selectedCore = $selectedCore;
		$this->districtName = $districtName;
	}

	public function registerEvents(): array
	{
		return [
			AfterSheet::class => function (AfterSheet $event) {
				$event->sheet
					->getStyle('A1:I' . (count($this->reports) + 2))
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
					->getStyle('A1:I1')
					->getFont()
					->setBold(true);
			},
		];
	}

	public function view(): View
	{
		return view('exports.user-list', [
			'reports' => $this->reports,
			'selectedQualification' => $this->selectedQualification,
			'selectedSubject' => $this->selectedSubject,
			'selectedCore' => $this->selectedCore,
			'districtName' => $this->districtName,
		]);
	}
}
