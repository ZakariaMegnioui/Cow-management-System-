<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Indexfonctionnelspere
 * 
 * @property int $id
 * @property float|null $SCS
 * @property float|null $LONG
 * @property float|null $FERT
 * @property float|null $FN
 * @property float|null $FV
 * @property int|null $Precision
 * @property string $pere_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $user_id
 * 
 * @property Pere $pere
 * @property User $user
 *
 * @package App\Models
 */
class Indexfonctionnelspere extends Model
{
	use SoftDeletes;
	protected $table = 'indexfonctionnelsperes';

	protected $casts = [
		'SCS' => 'float',
		'LONG' => 'float',
		'FERT' => 'float',
		'FN' => 'float',
		'FV' => 'float',
		'Precision' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'SCS',
		'LONG',
		'FERT',
		'FN',
		'FV',
		'Precision',
		'pere_id',
		'user_id'
	];

	public function pere()
	{
		return $this->belongsTo(Pere::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
