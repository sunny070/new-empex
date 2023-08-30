<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeBasicInfo extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'avatar',
		'full_name',
		'dob',
		'gender',
		'phone_no',
		'parents_name',
		'religion',
		'caste',
		'marital_status',
		'aadhar_no',
		'physically_challenge',
		'society',
	];

	public function religion()
	{
		return $this->belongsTo(Religion::class);
	}

	public function district()
	{
		return $this->belongsTo(District::class, 'user_district_id');
	}
}
