<?php
class ShowController extends BaseController 
{
	public function getShow($id)
	{
		$show = Show::with('meta', 'episodes')->find($id);
		if (!$show->meta) 
		{
			$this->fetchShowFullInfo($show, 'tvrage');
			$show->load('meta', 'episodes');
		}
		return View::make('show')->with('show', $show);
	}

	protected function fetchShowFullInfo($show, $source = 'tvrage')
	{
		if ($source == 'tvdb') 
		{
			return false;
		}
		elseif($source == 'tvrage')
		{
			$url = 'http://services.tvrage.com/feeds/full_show_info.php?sid=' . $show->tvrage_id;
			try {
				$showXML = simplexml_load_file($url);
			} catch (\Exception $e) {
				return false;
				
			}
			$showMeta = array(
					'status' => $showXML->status,
					'start_date' => date_create_from_format('M/d/Y', $showXML->started)->format('Y-m-d'),
					'end_date' => date_create_from_format('M/d/Y', $showXML->ended)->format('Y-m-d'),
					'origin_country' => $showXML->origin_country,
					'runtime' => $showXML->runtime
			);
			$show->meta()->save(new ShowMeta($showMeta));

			$seasons = $showXML->Episodelist->Season;
			foreach($seasons as $season)
			{
				$season_no = (int)$season->attributes()->no;
				$episodes = $season->episode;
				foreach ($episodes as $episode) {
					$episodeData = array(
							'episode_no' => (int)$episode->seasonnum,
							'season_no' => $season_no,
							'name' => $episode->title,
							'airdate' => $showXML->airdate
					);
					$show->episodes()->save(new Episode($episodeData));
				}
			}
		}
		
	}
}
?>