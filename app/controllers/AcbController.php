<?php

class AcbController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /acb
	 *
	 * @return Response
	 */
	public function getLogin()
	{
//        $abc = new AcbHelpers();
//        return $abc->login();
		$curl = new cURL();
        $data = 'dse_sessionId=4uwp_sGPU6gS3LNb41JrybU';
        $html = $curl->post('https://online.acb.com.vn/acbib/Request', $data);
        print_r($html);
//        if(preg_match('##'))

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /acb/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /acb
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /acb/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /acb/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /acb/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /acb/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}