<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Productionlaitieregrandmerematernelle
 * 
 * @property int $id
 * @property int|null $N_LACT
 * @property string|null $Age_V_lage
 * @property string|null $Kg_Lait
 * @property float|null $MG
 * @property float|null $KgMG
 * @property float|null $Prot
 * @property float|null $KgProt
 * @property string $GMMaternelle_Id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $user_id
 * 
 * @property Grandmerematernelle $grandmerematernelle
 * @property User $user
 *
 * @package App\Models
 */
class Productionlaitieregrandmerematernelle extends Model
{
	use SoftDeletes;
	protected $table = 'productionlaitieregrandmerematernelles';

	protected $casts = [
		'N_LACT' => 'int',
		'MG' => 'float',
		'KgMG' => 'float',
		'Prot' => 'float',
		'KgProt' => 'float',
		'user_id' => 'int'
	];

	protected $fillable = [
		'N_LACT',
		'Age_V_lage',
		'Kg_Lait',
		'MG',
		'KgMG',
		'Prot',
		'KgProt',
		'GMMaternelle_Id',
		'user_id'
	];

	public function grandmerematernelle()
	{
		return $this->belongsTo(Grandmerematernelle::class, 'GMMaternelle_Id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
