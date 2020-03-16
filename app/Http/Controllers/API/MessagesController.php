<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\MessageResourse;
use App\Http\Resources\MessagesResource;
use App\Messages;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessagesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $messages = $user->message()->get();

        return $this->sendResponse(MessagesResource::collection($messages), 'Messages retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $message = Messages::create($input);
        $message->users()->attach(Auth::id(), ['to_user_id' => $request->to_user_id]);

        return $this->sendResponse(new MessagesResource($message), 'Message sent successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $messages = User::find($id)->messages()->wherePivot('to_user_id', Auth::id())->get();
        if($messages->isEmpty()){
            return $this->sendError('You have no messages from this user');
        }

        return $this->sendResponse(new MessageResourse($messages),'All messages are retrieved');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Messages $messages
     * @return \Illuminate\Http\Response
     */
    public function edit(Messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Messages $messages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Messages $messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Messages $messages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Messages $messages)
    {
        //
    }
}
