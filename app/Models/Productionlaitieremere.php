<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Productionlaitieremere
 * 
 * @property int $id
 * @property int|null $NLACT
 * @property string|null $AgeVelage
 * @property float|null $KgLait
 * @property float|null $MG
 * @property float|null $KgMG
 * @property float|null $Prot
 * @property float|null $KgProt
 * @property string $meres_ID
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $user_id
 * 
 * @property Mere $mere
 * @property User $user
 *
 * @package App\Models
 */
class Productionlaitieremere extends Model
{
	use SoftDeletes;
	protected $table = 'productionlaitieremeres';

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
		'meres_ID',
		'user_id'
	];

	public function mere()
	{
		return $this->belongsTo(Mere::class, 'meres_ID');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
