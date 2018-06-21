<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Student;
use Faker\Factory as Faker;
class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      $career = 'IIND-2010-227';
      $year = substr(Carbon::now()->year,-2);
      $careercode = substr($career,10);
      for ($i=0; $i <20 ; $i++) {
        $lastnip = Student::select('studentnip')->Orderby('studentnip','desc')->where('careers_idcareer',$career)->first();
       	$uniqued =substr($lastnip->studentnip,5)+1;
       	$nip = $year.$careercode.$uniqued;
        DB::table('students')->insert([
          'studentnip'=> $nip,
          'name'=> $faker->name,
            'lastname'=>$faker->lastname,
            'email'=> $faker->unique()->email,
            'password'=> Hash::make('password'),
            'phone'=>'3841046939',
            'address'=> $faker->secondaryAddress,
            'postalcode'=> '45300',
            'bdate'=> $faker->date($format = 'Y-m-d', $max = 'now'),
            'remember_token'=> 'token',
            'state'=>'Jalisco',
            'careers_idcareer'=> $career
        ]);
     }
    }
}
