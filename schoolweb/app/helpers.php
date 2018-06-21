<?php 
  	function temporalcode($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomcode = '';
        for ($i = 0; $i < $length; $i++) {
        $randomcode .= $characters[rand(0, $charactersLength - 1)];
         }
        return $randomcode;
    }
    function actualcicle($month){
        if ($month<7)
            $cicle = 'A';
        if ($month>7)
            $cicle = 'B';
        return $cicle;
    }
    function getindex_schedule($start){
        if($start == '7:00')
           $index = 0;   
        if($start == '7:50')
            $index = 1;   
        if($start == '8:40')
            $index = 2;   
        if($start == '9:30')
            $index = 3;   
        if($start == '10:50')
            $index = 4;   
        if($start == '11:40')
            $index = 5;   
        if($start == '12:30')
            $index = 6;   
        if($start == '13:20')
            $index = 7;   
        if($start == '14:10')
            $index = 8;  
        return $index;
    }
    function studentslist($code){
        $students = App\StudentSubject::where('subjectslist_idsubjectslist',$code)->get();   
        $list[$students[0]->academicload_idacademicload]['name'] = $students[0]->academicload->student->name;
        $list[$students[0]->academicload_idacademicload]['lastname'] =  $students[0]->academicload->student->lastname;
        foreach ($students as $student) {
            $list[$student->academicload_idacademicload]['name'] = $student->academicload->student->name;
            $list[$student->academicload_idacademicload]['lastname'] =  $student->academicload->student->lastname;
        }
        return $list;
    }


?>