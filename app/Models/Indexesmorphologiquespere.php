<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Indexesmorphologiquespere
 * 
 * @property int $id
 * @property float|null $Devel
 * @property int|null $TypeBassin
 * @property float|null $Membres
 * @property float|null $Pis
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
class Indexesmorphologiquespere extends Model
{
	use SoftDeletes;
	protected $table = 'indexesmorphologiquesperes';

	protected $casts = [
		'Devel' => 'float',
		'TypeBassin' => 'int',
		'Membres' => 'float',
		'Pis' => 'float',
		'Precision' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'Devel',
		'TypeBassin',
		'Membres',
		'Pis',
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
