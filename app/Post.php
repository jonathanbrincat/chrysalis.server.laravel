<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  // Table Name
  // protected $table = 'adifferentname';
  // Primary Key
  // public $primaryKey = 'uId';
  // Timestamps
  // public $timestamps = true;

  public function user() {
    // A single post has a relationship with a user and a post belongsTo a user. -> OneToOne relationship
    return $this->belongsTo('App\User');
  }
}
