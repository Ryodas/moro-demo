<?php
// tanaryo-cloud/shared/src/Models/BaseModel.php
namespace TanaryoCloud\Shared\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    protected $guarded = ['id'];
}
