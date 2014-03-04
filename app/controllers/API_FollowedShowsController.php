<?php

class API_FollowedShowsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($user_id)
	{

		$followed_shows = User::with('shows.meta')->find($user_id)->shows;
		return Response::json(
			array(
				'error' => false,
				'shows' => $followed_shows->toArray()
			),
			200
		);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($user_id, $show_id)
	{
		$user = User::find($user_id);
		$user->shows()->attach($show_id);

		$show = Show::find($show_id);
		return Response::json(
			array(
				'error' => false,
				'shows' => $show->toArray()
			),
			200
		);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($user_id, $show_id)
	{
		$user = User::find($user_id);
		$show = Show::with('meta')->find($show_id);
		$response = $show->toArray();
		$response["following"] = $user->isFollowingShow($show_id);
		return Response::json(
			array(
				'error' => false,
				'shows' => $response
			),
			200
		);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($user_id, $show_id)
	{
		$user = User::find($user_id);
		$user->shows()->detach($show_id);

		return Response::json(
			array(
				'error' => false,
				'status' => "deleted"
			),
			200
		);
	}

}