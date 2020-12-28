<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormDetail extends Model
{
    protected $fillable =[
        'form_id', 'field_name', 'field_type','field_sub_type','file_path','field_label'
    ];
}
