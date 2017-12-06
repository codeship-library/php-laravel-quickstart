<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Todo extends Model
{

  protected $attributes = [
    'completed' => false,
    'position' => 0,
  ];

  protected $maps = ['position' => 'order'];
  protected $hidden = ['created_at', 'updated_at', 'position'];
  protected $fillable = ['title', 'completed', 'order'];
  protected $appends = ['order', 'url'];
  public $timestamps = false;

  public function getOrderAttribute()
  {
    return $this->position;
  }

  public function setOrderAttribute($value)
  {
    return $this->attributes['position'] = $value;
  }

  public function getUrlAttribute()
  {

    $url_arr = parse_url(Request::url());
    $url = $url_arr['scheme'].'://'.$url_arr['host'];

    if (isset($url_arr['port']))
    {
      $url = $url.':'.$url_arr['port'];
    }

    return $url.'/todos/'.$this->attributes['id'];
  }

}
