<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Filament\Models\Contracts\FilamentUser;
use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Client\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable /*implements FilamentUser*/ {
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }

    /**
     * @param $records
     * @return true
     */
    public function activate($records)
    {
        foreach ($records as $record) {
            $record->updated_at = '2023-01-01 19:19:19';
            $record->save();
        }
        return true;

        //User::whereIn('id', $data->selectedTableRecords)->update(['email_verified_at' => now()]);
        //$user->email_verified_at =  now();
        //$user->save();
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
   /*
    public function canAccessFilament(): bool
    {
        return $this->hasRole(['super-admin','user']);
    }
    */
}
