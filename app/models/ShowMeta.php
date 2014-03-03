<?php
class ShowMeta extends Eloquent
{
  protected $guarded = array('id', 'show_id');
	public $timestamps = false;
  public $incrementing = false;

	/**
  * The database table used by the model.
  *
  * @var string
  */
  protected $table = 'show_meta';

  /**
	 * The primary key of the table.
	 *
	 * @var string
	 */
	protected $primaryKey = 'show_id';

  public function show()
  {
  	return $this->belongsTo('Show');
  }
}
?>