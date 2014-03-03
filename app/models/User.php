<?
use Illuminate\Auth\UserInterface;

class User extends Eloquent implements UserInterface {
	protected $fillable = array('name','email');
  
  /**
  * The database table used by the model.
  *
  * @var string
  */
  protected $table = 'users';

  /**
	 * The primary key of the table.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

  /**
  * The attributes excluded from the model's JSON form.
  *
  * @var array
  */
  protected $hidden = array('password', 'salt');

  /**
  * Get the unique identifier for the user.
  *
  * @return mixed
  */
  public function getAuthIdentifier()
  {
  	return $this->id;
  }

  /**
  * Get the password for the user.
  *
  * @return string
  */
  public function getAuthPassword()
  {
  	return $this->password;
  }

  /**
  * Get the e-mail address where password reminders are sent.
  *
  * @return string
  */
  public function getReminderEmail()
  {
  	return $this->email;
  }

  /**
  * Set many to many relation between Users and Shows
  */
  public function shows()
  {
    return $this->belongsToMany('Show');
  }
}
?>