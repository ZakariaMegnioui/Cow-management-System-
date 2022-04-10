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
 * Class Sujet
 *
 * @property int $id
 * @property string $NSNIT
 * @property Carbon|null $DateNaissance
 * @property string|null $Race
 * @property string|null $NTravail
 * @property string|null $Type
 * @property string|null $Etat
 * @property string|null $Sexe
 * @property string|null $image1
 * @property string|null $image2
 * @property string|null $image3
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $user_id
 * @property string $meres_ID
 * @property string $peres_ID
 * @property string $GrandPerePaternels_ID
 * @property string $GrandPereMaternels_ID
 * @property string $GrandMerePaternelles_ID
 * @property string $GrandMereMaternelles_ID
 * @property int $EleveurProprietaires_ID
 * @property int $EleveurNaisseurs_ID
 *
 * @property Eleveurnaisseur $eleveurnaisseur
 * @property Eleveurproprietaire $eleveurproprietaire
 * @property Grandmerematernelle $grandmerematernelle
 * @property Grandmerepaternelle $grandmerepaternelle
 * @property Grandperematernel $grandperematernel
 * @property Grandperepaternel $grandperepaternel
 * @property Mere $mere
 * @property Pere $pere
 * @property User $user
 * @property Collection|Productionlaitieresujet[] $productionlaitieresujets
 *
 * @package App\Models
 */
class Sujet extends Model
{
    use SoftDeletes;
    protected $table = 'sujets';
    // protected $primaryKey = 'NSNIT';
    // public $incrementing = true;

    protected $casts = [
        'id' => 'int',
        'user_id' => 'int',
         'meres_ID' => 'int',
        'peres_ID' => 'int',
        'EleveurProprietaires_ID' => 'int',
        'EleveurNaisseurs_ID' => 'int',

        'GrandPerePaternels_ID' => 'int',
        'GrandPereMaternels_ID' => 'int',
        'GrandMerePaternelles_ID' => 'int',
        'GrandMereMaternelles_ID' => 'int',
    ];

    protected $dates = [
        'DateNaissance'
    ];

    protected $fillable = [
        'id',
        'NSNIT',
        'DateNaissance',
        'Race',
        'NTravail',
        'Type',
        'Etat',
        'Adresse',
        'Sexe',
        'Cause',
        'InfoCause',
        'image1',
        'image2',
        'cartGrize',
        'user_id',
        'meres_ID',
        'peres_ID',
        'GrandPerePaternels_ID',
        'GrandPereMaternels_ID',
        'GrandMerePaternelles_ID',
        'GrandMereMaternelles_ID',
        'EleveurProprietaires_ID',
        'EleveurNaisseurs_ID'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
    public function eleveurnaisseur()
    {
        return $this->belongsTo(Eleveurnaisseur::class, 'EleveurNaisseurs_ID');
    }

    public function eleveurproprietaire()
    {
        return $this->belongsTo(Eleveurproprietaire::class, 'EleveurProprietaires_ID');
    }

    public function grandmerematernelle()
    {
        return $this->belongsTo(Grandmerematernelle::class, 'GrandMereMaternelles_ID');
    }

    public function grandmerepaternelle()
    {
        return $this->belongsTo(Grandmerepaternelle::class, 'GrandMerePaternelles_ID');
    }

    public function grandperematernel()
    {
        return $this->belongsTo(Grandperematernel::class, 'GrandPereMaternels_ID');
    }

    public function grandperepaternel()
    {
        return $this->belongsTo(Grandperepaternel::class, 'GrandPerePaternels_ID');
    }

    public function mere()
    {
        return $this->belongsTo(Mere::class, 'meres_ID');
    }

    public function pere()
    {
        return $this->belongsTo(Pere::class, 'peres_ID');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productionlaitieresujets()
    {
        return $this->hasMany(Productionlaitieresujet::class);
    }
}
