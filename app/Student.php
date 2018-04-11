<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class  Student extends Model
{
    const SEX_UN=10;//未知
    const SEX_BOY=20;//男
    const SEX_GIRL=30; //女
    //定义表名
    protected $table = 'student';
    //设置批量赋值
    protected $fillable=['name','age','sex'];
    //定义时间戳
    public $timestamps = true;

    public function sex($ind=null){
        $arr=[
            self::SEX_UN=>'未知',
            self::SEX_BOY=>'男',
            self::SEX_GIRL=>'女'
        ];

        if($ind !== null){
            return array_key_exists($ind,$arr)?$arr[$ind]:$arr[self::SEX_UN];
        }
        return $arr;
    }
}