<?php
class Show extends Eloquent
{
	protected $guarded = array('*');
	public $timestamps = false;

	/**
  * The database table used by the model.
  *
  * @var string
  */
  protected $table = 'shows';

  /**
	 * The primary key of the table.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

  public function episodes(){
  	return $this->hasMany('Episode');
  }

  public function meta(){
    return $this->hasOne('ShowMeta');
  }

  public function seasons(){
    $return = DB::table('episodes')->get();
  }

  public function users(){
    return $this->belongsToMany('User', 'users_has_shows');
  }

  public function isFollowedByUser($user_id) {
    return ($this->users()->where('id', $user_id)->count() > 0);
  }
}
?>