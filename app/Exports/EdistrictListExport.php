<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class EdistrictListExport implements FromView, WithEvents, ShouldAutoSize
{
	protected $reports;
	protected $districtName;

	public function __construct($reports, $districtName)
	{
		$this->reports = $reports;

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
		return view('exports.edistrict-list', [
			'reports' => $this->reports,
			'districtName' => $this->districtName,
		]);
	}
}
