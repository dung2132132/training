<?php

namespace App;

use App\Http\Requests\StudentRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code','name','age','gender','email', 'address',
    ];
    public function getAllStundent(){
        return $this->paginate(10);
    }
    public function getStudentById($id){
        return $this->findOrFail($id);
    }
    public function deleteStudentById($id){
        return $this->destroy($id);
    }
    public function createStudent(Request $request){
        return $this->create($request->all());
    }
    public function updateStudent($id, Request $request){
        return $this->where('id',$id)->update($request->all());
    }
}
