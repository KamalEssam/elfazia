<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCouponCodeAPIRequest;
use App\Http\Requests\API\UpdateCouponCodeAPIRequest;
use App\Models\CouponCode;
use App\Repositories\CouponCodeRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CouponCodeController
 * @package App\Http\Controllers\API
 */

class CouponCodeAPIController extends ApiController
{
    /** @var  CouponCodeRepository */
    private $couponCodeRepository;

    public function __construct(CouponCodeRepository $couponCodeRepo)
    {
        parent::__construct();
        $this->couponCodeRepository = $couponCodeRepo;
    }

    /**
     * Display a listing of the CouponCode.
     * GET|HEAD /couponCodes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->couponCodeRepository->all();
        $data['result'] = $this->couponCodeRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created CouponCode in storage.
     * POST /couponCodes
     *
     * @param CreateCouponCodeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCouponCodeAPIRequest $request)
    {
        $input = $request->all();

        $couponCodes = $this->couponCodeRepository->create($input);
        $couponCodes = $this->couponCodeRepository->transform($couponCodes);
        return $this->respondWithSuccess($couponCodes);
    }

    /**
     * Display the specified CouponCode.
     * GET|HEAD /couponCodes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var CouponCode $couponCode */
        $couponCode = $this->couponCodeRepository->findWithoutFail($id);

        if (empty($couponCode)) {
            return $this->respondWithError('Coupon Code not found');
        }

        $couponCode = $this->couponCodeRepository->transform($couponCode);

        return $this->respondWithSuccess($couponCode);
    }

    /**
     * Update the specified CouponCode in storage.
     * PUT/PATCH /couponCodes/{id}
     *
     * @param  int $id
     * @param UpdateCouponCodeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCouponCodeAPIRequest $request)
    {
        $input = $request->all();

        /** @var CouponCode $couponCode */
        $couponCode = $this->couponCodeRepository->findWithoutFail($id);

        if (empty($couponCode)) {
            return $this->sendError('Coupon Code not found');
        }

        $couponCode = $this->couponCodeRepository->update($input, $id);

        return $this->sendResponse($couponCode->toArray(), 'CouponCode updated successfully');
    }

    /**
     * Remove the specified CouponCode from storage.
     * DELETE /couponCodes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CouponCode $couponCode */
        $couponCode = $this->couponCodeRepository->findWithoutFail($id);

        if (empty($couponCode)) {
            return $this->respondWithError('Coupon Code not found');
        }

        $couponCode->delete();

        $data['message'] ="Coupon Code deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
