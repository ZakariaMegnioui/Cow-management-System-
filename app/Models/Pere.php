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
 * Class Pere
 *
 * @property int $id
 * @property string $N
 * @property string|null $Nom
 * @property Carbon|null $Datenaissance
 * @property string|null $Race
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $user_id
 *
 * @property User $user
 * @property Collection|Indexeslaitierspere[] $indexeslaitiersperes
 * @property Collection|Indexesmorphologiquespere[] $indexesmorphologiquesperes
 * @property Collection|Indexfonctionnelspere[] $indexfonctionnelsperes
 * @property Collection|Sujet[] $sujets
 *
 * @package App\Models
 */
class Pere extends Model
{
    use SoftDeletes;
    protected $table = 'peres';
    // protected $primaryKey = 'N';
    // public $incrementing = false;

    protected $casts = [
        'id' => 'int',
        'user_id' => 'int'
    ];

    protected $dates = [
        'Datenaissance'
    ];

    protected $fillable = [
        'id',
        'N',
        'Nom',
        'Datenaissance',
        'Race',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function sujets()
    {
        return $this->hasMany(Sujet::class, 'peres_ID');
    }
}
