<?php

namespace Avl\AdminLogger\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{

  protected $table = 'admin-logs';

  protected $guarded = [];

  protected $casts = [
    'previous' => 'array',
    'following' => 'array',
    'headers' => 'array'
  ];

  public function user ()
  {
    return $this->belongsTo('Avl\AdminLogger\Models\User');
  }

  public function section ()
  {
    return $this->belongsTo('Avl\AdminLogger\Models\Sections', 'section_id', 'id');
  }
}
