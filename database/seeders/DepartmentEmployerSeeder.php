<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Organization;
use App\Models\OrganizationAddress;
use Illuminate\Database\Seeder;

class DepartmentEmployerSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$admins = [
			[
				'email' => 'finance@empex.com',
				'dept_id' => 1,
			],
			[
				'email' => 'political@empex.com',
				'dept_id' => 2,
			],
			[
				'email' => 'planning@empex.com',
				'dept_id' => 3,
			],
			[
				'email' => 'gad@empex.com',
				'dept_id' => 4,
			],
			[
				'email' => 'sad@empex.com',
				'dept_id' => 5,
			],
			[
				'email' => 'vigilance@empex.com',
				'dept_id' => 6,
			],
			[
				'email' => 'pwd@empex.com',
				'dept_id' => 7,
			],
			[
				'email' => 'horti@empex.com',
				'dept_id' => 8,
			],
			[
				'email' => 'phe@empex.com',
				'dept_id' => 9,
			],
			[
				'email' => 'udpa@empex.com',
				'dept_id' => 10,
			],
			[
				'email' => 'ahvety@empex.com',
				'dept_id' => 11,
			],
			[
				'email' => 'par@empex.com',
				'dept_id' => 12,
			],
			[
				'email' => 'health@empex.com',
				'dept_id' => 13,
			],
			[
				'email' => 'hte@empex.com',
				'dept_id' => 14,
			],
			[
				'email' => 'commerce@empex.com',
				'dept_id' => 15,
			],
			[
				'email' => 'home@empex.com',
				'dept_id' => 16,
			],
			[
				'email' => 'taxation@empex.com',
				'dept_id' => 17,
			],
			[
				'email' => 'disaster@empex.com',
				'dept_id' => 18,
			],
			[
				'email' => 'power@empex.com',
				'dept_id' => 19,
			],
			[
				'email' => 'arts@empex.com',
				'dept_id' => 20,
			],
			[
				'email' => 'landresources@empex.com',
				'dept_id' => 21,
			],
			[
				'email' => 'dcma@empex.com',
				'dept_id' => 22,
			],
			[
				'email' => 'agri@empex.com',
				'dept_id' => 23,
			],
			[
				'email' => 'irrigation@empex.com',
				'dept_id' => 24,
			],
			[
				'email' => 'coop@empex.com',
				'dept_id' => 25,
			],
			[
				'email' => 'food@empex.com',
				'dept_id' => 26,
			],
			[
				'email' => 'lad@empex.com',
				'dept_id' => 27,
			],
			[
				'email' => 'fisheries@empex.com',
				'dept_id' => 28,
			],
			[
				'email' => 'school@empex.com',
				'dept_id' => 29,
			],
			[
				'email' => 'lesde@empex.com',
				'dept_id' => 30,
			],
			[
				'email' => 'printing@empex.com',
				'dept_id' => 31,
			],
			[
				'email' => 'rural@empex.com',
				'dept_id' => 32,
			],
			[
				'email' => 'ipr@empex.com',
				'dept_id' => 33,
			],
			[
				'email' => 'landrevenue@empex.com',
				'dept_id' => 34,
			],
			[
				'email' => 'socialwelfare@empex.com',
				'dept_id' => 35,
			],
			[
				'email' => 'excise@empex.com',
				'dept_id' => 36,
			],
			[
				'email' => 'sericulture@empex.com',
				'dept_id' => 37,
			],
			[
				'email' => 'law@empex.com',
				'dept_id' => 38,
			],
			[
				'email' => 'transport@empex.com',
				'dept_id' => 39,
			],
			[
				'email' => 'environment@empex.com',
				'dept_id' => 40,
			],
			[
				'email' => 'sports@empex.com',
				'dept_id' => 41,
			],
			[
				'email' => 'tourism@empex.com',
				'dept_id' => 42,
			],
			[
				'email' => 'ict@empex.com',
				'dept_id' => 43,
			],
		];

		foreach ($admins as $admin) {
			$ad = new Admin();
			$ad->email = $admin['email'];
			$ad->password = 'empex@2022';
			$ad->role_id = 4;
			$ad->is_approved = 1;
			$ad->category_id = 3;
			$ad->save();

			$org = new Organization();
			$org->admin_id = $ad->id;
			$org->category_id = 3;
			$org->type_id = 11;
			$org->sector_id = 1;
			$org->department_id = $admin['dept_id'];
			$org->save();
		}
	}
}
