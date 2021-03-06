<?php

use Illuminate\Support\Facades\Route;
use App\Models\Student;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create_students_by_row',function(){
    DB::insert('insert into students(name,dateOfBirth, GPA , advisor) values(? , ? , ? , ?)', [
        "Rimma",
        now(),
        3,
        "Best teacher"
    ]);
});

Route::get('/update_students_by_row',function(){
    $upd = DB::update('update students set name = "Leav" where id = ?', [3]);
    return $upd;
});


Route::get('/delete_students_by_row',function(){
    $del = DB::delete('delete from students where id = ?', [3]);
    return $del;
});

Route::get('/get_students_by_row',function(){
    $res = DB::select('select * from students where id = ?', [3]);
    foreach($res as $val){
        echo $val->name . "<br>" . $val->dateOfBirth . "<br>" . $val->GPA . "<br>" .$val->advisor;
    }
});

Route::get('/students', function () {
    $students = Student::all();
    foreach($students as $val){
        echo $val->name . "<br>" . $val->dateOfBirth . "<br>" . $val->GPA . "<br>" .$val->advisor;
    }
});

Route::get('/create', function () {
    $student = new Student;
    $student->name = "Rimma";
    $student->dateOfBirth = now();
    $student->GPA = 3;
    $student->advisor = "Teacher";
    $student->save();
});

Route::get('/update/{id}',function($id){
    $student = Student::find($id);
    if($student == null) {
        echo "doesn't exist";
        return;
    }
    $student->name = "Me";
    $student->dateOfBirth = now();
    $student->GPA = 2;
    $student->advisor = "Second teacher";
    $student->save();
    echo "Changed";
});

Route::get('/delete/{id}',function($id){
    $student = Student::find($id);
    if($student == null) {
        echo "doesn't exist";
        return;
    }
    $student->delete();
    echo "Deleted";
});

