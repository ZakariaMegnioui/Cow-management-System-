<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Indexeslaitierspere
 * 
 * @property int $id
 * @property int|null $Lait
 * @property float|null $MG
 * @property int|null $MGkg
 * @property float|null $Prot
 * @property int|null $ProtKg
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
class Indexeslaitierspere extends Model
{
	use SoftDeletes;
	protected $table = 'indexeslaitiersperes';

	protected $casts = [
		'Lait' => 'int',
		'MG' => 'float',
		'MGkg' => 'int',
		'Prot' => 'float',
		'ProtKg' => 'int',
		'Precision' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'Lait',
		'MG',
		'MGkg',
		'Prot',
		'ProtKg',
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
