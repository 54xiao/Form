<?php
namespace App\Http\Controllers;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //学生列表页
    public function index()
    {
        $students = Student::paginate(20);
        return view('student.index',[
            'students'=>$students,
        ]);
    }

    public function add()
    {
        $student = new Student();
        $student->name = 'xiao';
        $student->age = 11;
        $student->sex = 1;
        $a = $student->save();
    }
    //添加页面
    public function create(Request $request)
    {
        //增加功能
        $student=new Student();
        /*$data=$request->input('Student');

        if(Student::create($data)){
            return redirect('student/index')->with('success','添加成功');
        }else{
            return redirect()->back();
        }*/


        if($request->isMethod('POST')){

            //1.控制器验证
            /*$this->validate($request,[
                'Student.name'=>'required|min:2|max:20',
                'Student.age'=>'required|integer',
                'Student.sex'=>'required|integer'
            ],[
                'required'=>':attribute 为必填项',
                'min'=>':attribute 长度不符合要求',
                'integer'=>':attribute 必须为整数'
            ],[
                'Student.name'=>'姓名',
                'Student.age'=>'年龄',
                'Student.sex'=>'性别'
            ]);*/

            //2.Validator类验证
            $validator=Validator::make($request->input(),[
                'Student.name'=>'required|min:2|max:20',
                'Student.age'=>'required|integer',
                'Student.sex'=>'required|integer'
            ],[
                'required'=>':attribute 为必填项',
                'min'=>':attribute 长度不符合要求',
                'integer'=>':attribute 必须为整数'
            ],[
                'Student.name'=>'姓名',
                'Student.age'=>'年龄',
                'Student.sex'=>'性别'
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }


            $data=$request->input('Student');

            if(Student::create($data)){
                return redirect('student/index')->with('success','添加成功');
            }else{
                return redirect()->back();
            }
        }

        return view('student.create',[
            'student'=>$student
        ]);
    }
    //保存添加
    public function save(Request $request)
    {
        $data=$request->input('Student');
        $student=new Student();
        $student->name=$data['name'];
        $student->age=$data['age'];
        $student->sex=$data['sex'];

        if($student->save()){
            return redirect('student/index')->with('success', '233');
        }else{
            return redirect()->back();
        }
    }
    //修改操作
    public function update($id){

        $student=Student::find($id);

        return view('student.update',[
            'student'=>$student
        ]);
    }
}