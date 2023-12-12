<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use App\Core\Authenticatable;
use App\Traits\RouteBind;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens, RouteBind;

    protected $table = 'users';
    protected $keyType = 'integer';

    public $incrementing = true;
    public $timestamps = true;
    
    protected $fillable = [
        "id",
        "role", //USER
        "language", //EN
        "first_name", //NULLABLE
        "last_name", //NULLABLE
        "email", //NULLABLE
        "email_verified_at", //NULLABLE
        "phone", //NULLABLE
        "average_salary", //NULLABLE
        "position",
        "address",
        "country",
        "postal_code",
        "city",
        "house_number",
        "apartment_number", //NULLABLE
        "is_mailing_address_different", //FALSE
        "mailing_address", //NULLABLE
        "mailing_country", //NULLABLE
        "mailing_postal_code", //NULLABLE
        "mailing_city", //NULLABLE
        "mailing_house_number", //NULLABLE
        "mailing_apartment_number", //NULLABLE
        "password", //NULLABLE
        "remember_token", //NULLABLE
        "is_active", //TRUE
        "created_at", //NULLABLE
        "updated_at", //NULLABLE
        "deleted_at" //NULLABLE
    ];

    protected $casts = [
        'id' => 'integer',
        'role' => 'string',
        'language' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'phone' => 'string',
        'average_salary' => 'decimal:2',
        'position' => 'string',
        'address' => 'string',
        'country' => 'string',
        'postal_code' => 'string',
        'city' => 'string',
        'house_number' => 'string',
        'apartment_number' => 'string',
        'is_mailing_address_different' => 'boolean',
        'mailing_address' => 'string',
        'mailing_country' => 'string',
        'mailing_postal_code' => 'string',
        'mailing_city' => 'string',
        'mailing_house_number' => 'string',
        'mailing_apartment_number' => 'string',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // USER SYSTEMS VARIABLES
    public static $password_length = "6";

    // LANGUAGES
    public const EN = "en";
    public const PL = "pl";

    public static $langs = [
        self::EN,
        self::PL,
    ];

    public static $default_language = self::EN;

    public const USER = "user";
    public const ADMIN = "admin";

    public static $roles = [
        self::USER,
        self::ADMIN,
    ];

    public static $default_role = self::USER;

    public const FRONT_END = "front-end";
    public const BACK_END = "back-end";
    public const PM = "pm";
    public const DESIGNER = "designer";
    public const TESTER = "tester";

    public static $positions = [
        self::FRONT_END,
        self::BACK_END,
        self::PM,
        self::DESIGNER,
        self::TESTER,
    ];

    // Attributes
    public function setPasswordAttribute(?String $password)
    {
        $this->attributes['password'] = $password ? Hash::make($password) : $this->password;
    }
}