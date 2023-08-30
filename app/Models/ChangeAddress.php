<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeAddress extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'state_id',
		'district_id',
		'village',
		'pin_code',
		'house_no',
		'type',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function state()
	{
		return $this->belongsTo(State::class);
	}

	public function district()
	{
		return $this->belongsTo(District::class);
	}

	public function village()
	{
		return $this->belongsTo(Village::class);
	}

	public function rdBlock()
	{
		return $this->belongsTo(RdBlock::class);
	}

	public function policeStation()
	{
		return $this->belongsTo(PoliceStation::class);
	}

	public function postOffice()
	{
		return $this->belongsTo(PostOffice::class);
	}

	public function pinCode()
	{
		return $this->belongsTo(PinCode::class);
	}

	public function user_district()
	{
		return $this->belongsTo(District::class, 'user_district_id');
	}
}
