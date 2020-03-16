<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateChatRoomAPIRequest;
use App\Http\Requests\API\UpdateChatRoomAPIRequest;
use App\Models\ChatRoom;
use App\Repositories\ChatRoomRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ChatRoomController
 * @package App\Http\Controllers\API
 */

class ChatRoomAPIController extends ApiController
{
    /** @var  ChatRoomRepository */
    private $chatRoomRepository;

    public function __construct(ChatRoomRepository $chatRoomRepo)
    {
        parent::__construct();
        $this->chatRoomRepository = $chatRoomRepo;
    }

    /**
     * Display a listing of the ChatRoom.
     * GET|HEAD /chatRooms
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->chatRoomRepository->all();
        $data['result'] = $this->chatRoomRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created ChatRoom in storage.
     * POST /chatRooms
     *
     * @param CreateChatRoomAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateChatRoomAPIRequest $request)
    {
        $input = $request->all();

        $chatRooms = $this->chatRoomRepository->create($input);
        $chatRooms = $this->chatRoomRepository->transform($chatRooms);
        return $this->respondWithSuccess($chatRooms);
    }

    /**
     * Display the specified ChatRoom.
     * GET|HEAD /chatRooms/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var ChatRoom $chatRoom */
        $chatRoom = $this->chatRoomRepository->findWithoutFail($id);

        if (empty($chatRoom)) {
            return $this->respondWithError('Chat Room not found');
        }

        $chatRoom = $this->chatRoomRepository->transform($chatRoom);

        return $this->respondWithSuccess($chatRoom);
    }

    /**
     * Update the specified ChatRoom in storage.
     * PUT/PATCH /chatRooms/{id}
     *
     * @param  int $id
     * @param UpdateChatRoomAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChatRoomAPIRequest $request)
    {
        $input = $request->all();

        /** @var ChatRoom $chatRoom */
        $chatRoom = $this->chatRoomRepository->findWithoutFail($id);

        if (empty($chatRoom)) {
            return $this->sendError('Chat Room not found');
        }

        $chatRoom = $this->chatRoomRepository->update($input, $id);

        return $this->sendResponse($chatRoom->toArray(), 'ChatRoom updated successfully');
    }

    /**
     * Remove the specified ChatRoom from storage.
     * DELETE /chatRooms/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ChatRoom $chatRoom */
        $chatRoom = $this->chatRoomRepository->findWithoutFail($id);

        if (empty($chatRoom)) {
            return $this->respondWithError('Chat Room not found');
        }

        $chatRoom->delete();

        $data['message'] ="Chat Room deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
