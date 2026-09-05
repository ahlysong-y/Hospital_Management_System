<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    /**
     * ទាញយកតម្លៃ Setting តាមរយ: Key (Get setting value by key with default)
     */
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return ($setting && $setting->value !== null) ? $setting->value : $default;
    }

    /**
     * រក្សាទុក ឬ ធ្វើបច្ចុប្បន្នភាពតម្លៃ Setting (Set or update setting key-value pair)
     */
    public static function set($key, $value)
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
