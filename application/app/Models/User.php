<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ユーザーのプロジェクトを取得.
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'created_user_id');
    }

    /**
     * ユーザーの課題を取得.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'created_user_id');
    }

    /**
     * ユーザーの画像を取得.
     */
    public function pictures()
    {
        return $this->hasMany(TaskPicture::class, 'created_user_id');
    }
}
