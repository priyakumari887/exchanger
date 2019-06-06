<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
     /**
     * Table associated with the model.
     *
     * @access protected
     * @var string
     */
    protected $table = 'exchange_rates';

    /**
     * Attributes which are not mass assignable.
     * 
     * @access protected
     * @var array
     */
    protected $guarded = ['id'];
}
