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
 * Class Eleveurproprietaire
 *
 * @property int $id
 * @property string|null $Nom
 * @property string|null $Prenom
 * @property string|null $Adresse
 * @property string|null $CIN
 * @property string|null $Etat
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
class Eleveurproprietaire extends Model
{
	use SoftDeletes;
	protected $table = 'eleveurproprietaires';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'Nom',
		'Prenom',
		'Adresse',
		'CIN',
		'Etat',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function sujets()
	{
		return $this->hasMany(Sujet::class, 'EleveurProprietaires_ID');
	}
}
