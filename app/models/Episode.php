<?php
class Episode extends Eloquent
{
	protected $guarded = array('id', 'show_id');
	public $timestamps = false;

	/**
  * The database table used by the model.
  *
  * @var string
  */
  protected $table = 'episodes';

  /**
	 * The primary key of the table.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

  public function show(){
  	return $this->belongsTo('Show');
  } 
	
}
?>