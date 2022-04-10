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
 * Class Grandmerematernelle
 *
 * @property int $id
 * @property string $NSNIT
 * @property Carbon|null $DateNaissance
 * @property string|null $Race
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $user_id
 *
 * @property User $user
 * @property Collection|Productionlaitieregrandmerematernelle[] $productionlaitieregrandmerematernelles
 * @property Collection|Sujet[] $sujets
 *
 * @package App\Models
 */
class Grandmerematernelle extends Model
{
	use SoftDeletes;
	protected $table = 'grandmerematernelles';
	// protected $primaryKey = 'NSNIT';
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
        'NSNIT',
		'DateNaissance',
		'Race',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function productionlaitieregrandmerematernelles()
	{
		return $this->hasMany(Productionlaitieregrandmerematernelle::class, 'GMMaternelle_Id');
	}

	public function sujets()
	{
		return $this->hasMany(Sujet::class, 'GrandMereMaternelles_ID');
	}
}
