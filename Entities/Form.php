<?php

namespace Modules\Iforms\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use Translatable;

    protected $table = 'iforms__forms';

    public $translatedAttributes = [
        'title',
        'submit_text',
        'success_text',
    ];

    protected $fillable = [
        'system_name',
        'active',
        'destination_email',
        'user_id',
        'options',
        'form_type',
    ];

    protected $casts = [
        'options' => 'array',
        'destination_email' => 'array'
    ];

    public function fields()
    {
        return $this->hasMany(Field::class)->with('translations')->orderBy('order','asc');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function blocks()
    {
        return $this->hasMany(Block::class)->orderBy('sort_order','asc');
    }

    public function user()
    {
        $driver = config('asgard.user.config.driver');
        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User", 'user_id');
    }

    public function getDestinationEmailAttribute($value)
    {
        return json_decode($value);
    }

    public function getOptionsAttribute($value)
    {
        return json_decode($value);
    }

    public function formeable()
    {
        return $this->morphTo();
    }

}
