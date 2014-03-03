<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		ini_set('memory_limit', '128M');

		$this->call('UserTableSeeder');
		$this->call('ShowListSeeder');
	}

}

class UserTableSeeder extends Seeder {
    public function run()
    {
        DB::table('users')->delete();

        User::create(
        	array(
	        	'email' => 'mortyh@gmail.com',
	        	'name' => 'Mortimer Henningsson',
	        	'password' => Hash::make('printer10'),
	        	'role' => 'admin'
	        )
        );

        User::create(
        	array(
        		'email' => 'test@testsson.se',
        		'name' => 'Test Testsson',
        		'password' => Hash::make('123mortimer45'),
        		'role' => 'user'
        	)
      	);
    }
}

class ShowListSeeder extends Seeder {
	public function run()
	{
		DB::table('shows')->delete();
		$xmlreader = new XMLReader();
		$filename = '/Users/Mortimer/Documents/htdocs/tvtrack/app/database/show_list.xml';
		if(! file_exists($filename)){
			throw new Exception("Failed to open file: ".$filename );
		}

		$xmlreader->open($filename);
		// Find first 'show' node
		while($xmlreader->read() && $xmlreader->name !== 'show');

		while($xmlreader->name == 'show' ){
			$show = new SimpleXMLElement($xmlreader->readOuterXML());
			Show::create(
				array(
					'name' => $show->name,
					'tvrage_id' => $show->id
				)
			);
			$xmlreader->next('show');
		}
	}
}