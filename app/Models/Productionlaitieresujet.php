<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Productionlaitieresujet
 * 
 * @property int $id
 * @property int|null $NLACT
 * @property string|null $AgeVelage
 * @property float|null $KgLait
 * @property float|null $MG
 * @property float|null $KgMG
 * @property float|null $Prot
 * @property float|null $KgProt
 * @property string $sujet_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $user_id
 * 
 * @property Sujet $sujet
 * @property User $user
 *
 * @package App\Models
 */
class Productionlaitieresujet extends Model
{
	use SoftDeletes;
	protected $table = 'productionlaitieresujets';

	protected $casts = [
		'NLACT' => 'int',
		'KgLait' => 'float',
		'MG' => 'float',
		'KgMG' => 'float',
		'Prot' => 'float',
		'KgProt' => 'float',
		'user_id' => 'int'
	];

	protected $fillable = [
		'NLACT',
		'AgeVelage',
		'KgLait',
		'MG',
		'KgMG',
		'Prot',
		'KgProt',
		'sujet_id',
		'user_id'
	];

	public function sujet()
	{
		return $this->belongsTo(Sujet::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
