<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Eleveurnaisseur[] $eleveurnaisseurs
 * @property Collection|Eleveurproprietaire[] $eleveurproprietaires
 * @property Collection|Grandmerematernelle[] $grandmerematernelles
 * @property Collection|Grandmerepaternelle[] $grandmerepaternelles
 * @property Collection|Grandperematernel[] $grandperematernels
 * @property Collection|Grandperepaternel[] $grandperepaternels
 * @property Collection|Historique[] $historiques
 * @property Collection|Indexeslaitierspere[] $indexeslaitiersperes
 * @property Collection|Indexesmorphologiquespere[] $indexesmorphologiquesperes
 * @property Collection|Indexfonctionnelspere[] $indexfonctionnelsperes
 * @property Collection|Mere[] $meres
 * @property Collection|Pere[] $peres
 * @property Collection|Productionlaitieregrandmerematernelle[] $productionlaitieregrandmerematernelles
 * @property Collection|Productionlaitieremere[] $productionlaitieremeres
 * @property Collection|Productionlaitieresujet[] $productionlaitieresujets
 * @property Collection|Sujet[] $sujets
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'remember_token'
	];

	public function eleveurnaisseurs()
	{
		return $this->hasMany(Eleveurnaisseur::class);
	}

	public function eleveurproprietaires()
	{
		return $this->hasMany(Eleveurproprietaire::class);
	}

	public function grandmerematernelles()
	{
		return $this->hasMany(Grandmerematernelle::class);
	}

	public function grandmerepaternelles()
	{
		return $this->hasMany(Grandmerepaternelle::class);
	}

	public function grandperematernels()
	{
		return $this->hasMany(Grandperematernel::class);
	}

	public function grandperepaternels()
	{
		return $this->hasMany(Grandperepaternel::class);
	}

	public function historiques()
	{
		return $this->hasMany(Historique::class);
	}

	public function indexeslaitiersperes()
	{
		return $this->hasMany(Indexeslaitierspere::class);
	}

	public function indexesmorphologiquesperes()
	{
		return $this->hasMany(Indexesmorphologiquespere::class);
	}

	public function indexfonctionnelsperes()
	{
		return $this->hasMany(Indexfonctionnelspere::class);
	}

	public function meres()
	{
		return $this->hasMany(Mere::class);
	}

	public function peres()
	{
		return $this->hasMany(Pere::class);
	}

	public function productionlaitieregrandmerematernelles()
	{
		return $this->hasMany(Productionlaitieregrandmerematernelle::class);
	}

	public function productionlaitieremeres()
	{
		return $this->hasMany(Productionlaitieremere::class);
	}

	public function productionlaitieresujets()
	{
		return $this->hasMany(Productionlaitieresujet::class);
	}

	public function sujets()
	{
		return $this->hasMany(Sujet::class);
	}
}
