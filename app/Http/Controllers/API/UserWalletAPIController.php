<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserWalletAPIRequest;
use App\Http\Requests\API\UpdateUserWalletAPIRequest;
use App\Models\UserWallet;
use App\Repositories\UserWalletRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class UserWalletController
 * @package App\Http\Controllers\API
 */

class UserWalletAPIController extends ApiController
{
    /** @var  UserWalletRepository */
    private $userWalletRepository;

    public function __construct(UserWalletRepository $userWalletRepo)
    {
        parent::__construct();
        $this->userWalletRepository = $userWalletRepo;
    }

    /**
     * Display a listing of the UserWallet.
     * GET|HEAD /userWallets
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->userWalletRepository->all();
        $data['result'] = $this->userWalletRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created UserWallet in storage.
     * POST /userWallets
     *
     * @param CreateUserWalletAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUserWalletAPIRequest $request)
    {
        $input = $request->all();

        $userWallets = $this->userWalletRepository->create($input);
        $userWallets = $this->userWalletRepository->transform($userWallets);
        return $this->respondWithSuccess($userWallets);
    }

    /**
     * Display the specified UserWallet.
     * GET|HEAD /userWallets/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var UserWallet $userWallet */
        $userWallet = $this->userWalletRepository->findWithoutFail($id);

        if (empty($userWallet)) {
            return $this->respondWithError('User Wallet not found');
        }

        $userWallet = $this->userWalletRepository->transform($userWallet);

        return $this->respondWithSuccess($userWallet);
    }

    /**
     * Update the specified UserWallet in storage.
     * PUT/PATCH /userWallets/{id}
     *
     * @param  int $id
     * @param UpdateUserWalletAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserWalletAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserWallet $userWallet */
        $userWallet = $this->userWalletRepository->findWithoutFail($id);

        if (empty($userWallet)) {
            return $this->sendError('User Wallet not found');
        }

        $userWallet = $this->userWalletRepository->update($input, $id);

        return $this->sendResponse($userWallet->toArray(), 'UserWallet updated successfully');
    }

    /**
     * Remove the specified UserWallet from storage.
     * DELETE /userWallets/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var UserWallet $userWallet */
        $userWallet = $this->userWalletRepository->findWithoutFail($id);

        if (empty($userWallet)) {
            return $this->respondWithError('User Wallet not found');
        }

        $userWallet->delete();

        $data['message'] ="User Wallet deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
