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
        'username',
        'email',
        'phone',
        'birth_date',
        'address',
        'photo',
        'password',
        'is_admin',
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

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function favorites()
{
    return $this->hasMany(Favorite::class);
}

// App\Models\User.php

public function reviews()
{
    return $this->hasMany(Review::class, 'profile_id');
}
public function averageRating(): float
    {
        return $this->reviews()->avg('rating') ?? 0.0;
    }

// Dalam model User
public function reviewsReceived()
{
    return $this->hasMany(Review::class, 'profile_id'); // Sesuaikan 'profile_id' dengan nama kolom di tabel ulasan yang merujuk ke pengguna
}


// app/Models/User.php

public function unreadMessagesCount()
{
    return Message::where('receiver_id', $this->id)
                   ->where('status', 0)
                   ->count();
}


public function unreadMessages()
{
    return $this->messages()->where('status', 0)->get();
}




}
