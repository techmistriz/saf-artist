<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Common\MasterModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShareRoom extends MasterModel
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = ['actions'];
    
    
}
