<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BasicInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use XMLWriter;

class DigilockerController extends Controller
{
	public function index(Request $request)
	{
		$data = BasicInfo::where('employment_no', $request->xml()['DocDetails']['employment_no'])
			->firstOrFail();

		$pdfFile = Storage::disk('public')->get('employment_card/' . $data->employment_no . '_empex_pocket_card.pdf');

		if ($pdfFile) {
			$xml = xmlwriter_open_memory();
			xmlwriter_set_indent($xml, 1);
			xmlwriter_start_document($xml, '1.0', 'UTF-8', 'yes');

			xmlwriter_start_element($xml, 'PullURIResponse'); // PullURIResponse
			xmlwriter_start_attribute($xml, 'xmlns');
			xmlwriter_text($xml, 'https://www.digitallocker.gov.in/schema/issuer/v1/pullurirequest');
			xmlwriter_start_attribute($xml, 'keyhash');
			xmlwriter_text($xml, $request->xml()['@attributes']['keyhash']);
			xmlwriter_end_attribute($xml);

			xmlwriter_start_element($xml, 'ResponseStatus'); // ResponseStatus
			xmlwriter_start_attribute($xml, 'Status');
			xmlwriter_text($xml, '1');
			xmlwriter_start_attribute($xml, 'ts');
			xmlwriter_text($xml, $request->xml()['@attributes']['ts']);
			xmlwriter_start_attribute($xml, 'txn');
			xmlwriter_text($xml, $request->xml()['@attributes']['txn']);
			xmlwriter_end_attribute($xml);
			xmlwriter_text($xml, '1');
			xmlwriter_end_element($xml); // end ResponseStatus

			xmlwriter_start_element($xml, 'DocDetails'); // DocDetails
			xmlwriter_start_element($xml, 'IssuedTo'); // IssuedTo
			xmlwriter_start_element($xml, 'Persons'); // Persons
			xmlwriter_start_element($xml, 'Person'); // Person
			xmlwriter_start_attribute($xml, 'name');
			xmlwriter_text($xml, $data->full_name);
			xmlwriter_end_attribute($xml);
			xmlwriter_start_attribute($xml, 'dob');
			xmlwriter_text($xml, date('d-m-Y', strtotime($data->dob)));
			xmlwriter_end_attribute($xml);
			xmlwriter_start_attribute($xml, 'gender');
			xmlwriter_text($xml, $data->gender);
			xmlwriter_end_attribute($xml);
			xmlwriter_start_attribute($xml, 'phone');
			xmlwriter_text($xml, $data->phone_no);
			xmlwriter_end_attribute($xml);

			xmlwriter_start_element($xml, 'Photo'); // Photo
			xmlwriter_start_attribute($xml, 'format');
			xmlwriter_text($xml, 'PNG');
			xmlwriter_end_attribute($xml);
			xmlwriter_text($xml, base64_encode($data->avatar));
			xmlwriter_end_element($xml); // end Photo
			xmlwriter_end_element($xml); // end Person
			xmlwriter_end_element($xml); // end Persons
			xmlwriter_end_element($xml); // end IssuedTo
			xmlwriter_start_element($xml, 'URI'); // URI
			xmlwriter_text($xml, $request->xml()['@attributes']['orgId'] . '-' . $request->xml()['DocDetails']['DocType'] . '-' . $data->employment_no);
			xmlwriter_end_element($xml); // end URI

			xmlwriter_start_element($xml, 'DocContent'); // DocContent
			xmlwriter_text($xml, chunk_split(base64_encode($pdfFile)));
			xmlwriter_end_element($xml); // end DocContent

			xmlwriter_start_element($xml, 'DataContent'); // DataContent
			xmlwriter_text($xml, base64_encode('some-data'));
			xmlwriter_end_element($xml); // end DataContent

			xmlwriter_end_element($xml); // end PullURIResponse

			xmlwriter_end_document($xml);

			// info(xmlwriter_output_memory($xml));
			return xmlwriter_output_memory($xml);
		}
	}

	public function document(Request $request)
	{
		info($request->xml());
	}
}
