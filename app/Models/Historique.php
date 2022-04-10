<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Historique
 * 
 * @property int $id
 * @property string|null $table
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $user_id
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Historique extends Model
{
	use SoftDeletes;
	protected $table = 'historiques';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'table',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
