<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserAttribute extends Model
{
    /**
     * The columns that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'uuid', 'picture',
    ];

	/**
	 * User attributes belong to a user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

    /**
     * Get player picture
     * Use with vuejs components
     *
     * @param $avatar
     *
     * @return string
     */
    public function getPictureAttribute($avatar)
    {
        if ($avatar) {
            $userId = Auth()->user()->id;
            $avatar = 'storage/pictures/'.$userId.'/'.$avatar;
        }

        return asset($avatar ?: 'storage/pictures/default_avatar.png');
    }
}
