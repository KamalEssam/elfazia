<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateConfigAPIRequest;
use App\Http\Requests\API\UpdateConfigAPIRequest;
use App\Models\CancelReason;
use App\Models\City;
use App\Models\Config;
use App\Models\Question;
use App\Repositories\ConfigRepository;
use function Helper\Common\__lang;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ConfigController
 * @package App\Http\Controllers\API
 */

class ConfigAPIController extends ApiController
{
    /** @var  ConfigRepository */
    private $configRepository;

    public function __construct(ConfigRepository $configRepo)
    {
        parent::__construct();
        $this->configRepository = $configRepo;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data["config"] = Config::latest("id")->first()->transform();
        $data["cities"] = City::transformAll();
        $data["cancel_reasons"] = CancelReason::transformAll();
        $data['questions'] = Question::transformAll();


        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created Config in storage.
     * POST /configs
     *
     * @param CreateConfigAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateConfigAPIRequest $request)
    {
        $input = $request->all();

        $configs = $this->configRepository->create($input);
        $configs = $this->configRepository->transform($configs);
        return $this->respondWithSuccess($configs);
    }

    /**
     * Display the specified Config.
     * GET|HEAD /configs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var Config $config */
        $config = $this->configRepository->findWithoutFail($id);

        if (empty($config)) {
            return $this->respondWithError('Config not found');
        }

        $config = $this->configRepository->transform($config);

        return $this->respondWithSuccess($config);
    }

    /**
     * Update the specified Config in storage.
     * PUT/PATCH /configs/{id}
     *
     * @param  int $id
     * @param UpdateConfigAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConfigAPIRequest $request)
    {
        $input = $request->all();

        /** @var Config $config */
        $config = $this->configRepository->findWithoutFail($id);

        if (empty($config)) {
            return $this->sendError('Config not found');
        }

        $config = $this->configRepository->update($input, $id);

        return $this->sendResponse($config->toArray(), 'Config updated successfully');
    }

    /**
     * Remove the specified Config from storage.
     * DELETE /configs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Config $config */
        $config = $this->configRepository->findWithoutFail($id);

        if (empty($config)) {
            return $this->respondWithError('Config not found');
        }

        $config->delete();

        $data['message'] ="Config deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
