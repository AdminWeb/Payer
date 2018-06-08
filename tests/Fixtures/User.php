<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 30/05/18
 * Time: 11:42
 */

namespace AdminWeb\Payer\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model as Eloquent;
use AdminWeb\Payer\Subscriptionable;

class User extends Eloquent
{
    protected $fillable = ['name','password','email'];
    use Subscriptionable;
}