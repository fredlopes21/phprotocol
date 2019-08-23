<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Ticket
 *
 * @author    Lucas Rocha <lucasrochabr[at]outlook[dot]com>
 * @copyright    Copyleft (c) Lucas Rocha
 */
class Ticket extends Model
{
	use SoftDeletes;

	protected $table = 'tickets';

	protected $fillable = [
		'user',
		'company',
		'channel',
		'type',
		'module',
		'description',
		'id_user',
	];

	public function local_user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
	}
}