<?php

namespace App\Models;

use App\usersStat;
use App\gameHod;
use App\dopInfo;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','zvanie','ipreg','ipvhod',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function handle($user)
    {
        dd($user);
    }
    
    public function updateip($request) {
        $user = User::where('name','=',$request['name'])->get();
        $user [0]['ipvhod'] = ip2long($request->ip());
        $user[0]->save();  
        
    }
    
    public function usersStat()
  {
    return $this->hasOne('App\usersStat','id','id');
  }
  
  public function gameHod()
  {
    return $this->hasMany('App\gameHod','id','id');
  }
  
  public function gameStat()
  {
    return $this->hasOne('App\gameStat','id','id');
  }
  
   public function logStat()
  {
    return $this->hasMany('App\gameHod','id','id');
  }
  
  public function dopInfo()
  {
    return $this->hasOne('App\dopInfo','id','id');
  }
}
