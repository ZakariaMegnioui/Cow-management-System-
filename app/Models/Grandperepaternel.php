<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Grandperepaternel
 *
 * @property int $id
 * @property string $N
 * @property string|null $Nom
 * @property Carbon|null $DateNaissance
 * @property string|null $Race
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $user_id
 *
 * @property User $user
 * @property Collection|Sujet[] $sujets
 *
 * @package App\Models
 */
class Grandperepaternel extends Model
{
	use SoftDeletes;
	protected $table = 'grandperepaternels';
	// protected $primaryKey = 'N';
	// public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'user_id' => 'int'
	];

	protected $dates = [
		'DateNaissance'
	];

	protected $fillable = [
		'id',
        'N',
		'Nom',
		'DateNaissance',
		'Race',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function sujets()
	{
		return $this->hasMany(Sujet::class, 'GrandPerePaternels_ID');
	}
}
