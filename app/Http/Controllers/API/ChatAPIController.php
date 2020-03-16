<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateChatAPIRequest;
use App\Http\Requests\API\UpdateChatAPIRequest;
use App\Models\Chat;
use App\Repositories\ChatRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ChatController
 * @package App\Http\Controllers\API
 */

class ChatAPIController extends ApiController
{
    /** @var  ChatRepository */
    private $chatRepository;

    public function __construct(ChatRepository $chatRepo)
    {
        parent::__construct();
        $this->chatRepository = $chatRepo;
    }

    /**
     * Display a listing of the Chat.
     * GET|HEAD /chats
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->chatRepository->all();
        $data['result'] = $this->chatRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created Chat in storage.
     * POST /chats
     *
     * @param CreateChatAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateChatAPIRequest $request)
    {
        $input = $request->all();

        $chats = $this->chatRepository->create($input);
        $chats = $this->chatRepository->transform($chats);
        return $this->respondWithSuccess($chats);
    }

    /**
     * Display the specified Chat.
     * GET|HEAD /chats/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var Chat $chat */
        $chat = $this->chatRepository->findWithoutFail($id);

        if (empty($chat)) {
            return $this->respondWithError('Chat not found');
        }

        $chat = $this->chatRepository->transform($chat);

        return $this->respondWithSuccess($chat);
    }

    /**
     * Update the specified Chat in storage.
     * PUT/PATCH /chats/{id}
     *
     * @param  int $id
     * @param UpdateChatAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChatAPIRequest $request)
    {
        $input = $request->all();

        /** @var Chat $chat */
        $chat = $this->chatRepository->findWithoutFail($id);

        if (empty($chat)) {
            return $this->sendError('Chat not found');
        }

        $chat = $this->chatRepository->update($input, $id);

        return $this->sendResponse($chat->toArray(), 'Chat updated successfully');
    }

    /**
     * Remove the specified Chat from storage.
     * DELETE /chats/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Chat $chat */
        $chat = $this->chatRepository->findWithoutFail($id);

        if (empty($chat)) {
            return $this->respondWithError('Chat not found');
        }

        $chat->delete();

        $data['message'] ="Chat deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
