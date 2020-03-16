<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConfigRequest;
use App\Http\Requests\UpdateConfigRequest;
use App\Repositories\ConfigRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\Config;
use function Helper\Common\imageUrl;

class ConfigController extends AppBaseController
{
    /** @var  ConfigRepository */
    private $configRepository;

    public function __construct(ConfigRepository $configRepo)
    {
        parent::__construct();
        $this->configRepository = $configRepo;
    }







    /**
     * Display a listing of the Config.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->configRepository->pushCriteria(new RequestCriteria($request));
        $configs = $this->configRepository->all();
        */

        return redirect(route("configs.edit",1));
        /*return view('configs.index')
             ->with('configs', $configs);*/
    }



    /**
     * Show the form for creating a new Config.
     *
     * @return Response
     */
    public function create()
    {
        return view('configs.create');
    }

    /**
     * Store a newly created Config in storage.
     *
     * @param CreateConfigRequest $request
     *
     * @return Response
     */
    public function store(CreateConfigRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $config = $this->configRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('configs.edit',1));
    }

    /**
     * Display the specified Config.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $config = $this->configRepository->findWithoutFail($id);

        if (empty($config)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('configs.index'));
        }

        return view('configs.show')->with('config', $config);
    }

    /**
     * Show the form for editing the specified Config.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $config = $this->configRepository->findWithoutFail($id);

        if (empty($config)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('configs.index'));
        }

        return view('configs.edit')->with('config', $config);
    }

    /**
     * Update the specified Config in storage.
     *
     * @param  int              $id
     * @param UpdateConfigRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConfigRequest $request)
    {


        $config = $this->configRepository->findWithoutFail($id);

        if (empty($config)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('configs.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $config = $this->configRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('configs.edit',1));
    }

    /**
     * Remove the specified Config from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        /*
         if($request->ids != null AND count($request->ids) > 0)
         {
             foreach ($request->ids as $id)
             {
                 $this->configRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('configs.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('configs.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->configRepository->delete($id);
            }
        }
        else
        {
            $data['message'] = 'برجاء تحديد بيانات المراد حذفها';
            $data['success'] = false;
            return $data;
        }
        $data['message'] = 'تم الحذف بنجاح';
        $data['success'] = true;
        return $data;

    }

    public function data() {
            $items = Config::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (Config $item) {
                    $back = ' <div class="btn-group">';
                    $back .= '
                        <a href="'. route('configs.show' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
                        <a href="'. route('configs.edit' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
                    </div>';
                    return $back;
                })
                /*
                 ->addColumn("active",function(Config $item){
                    if($item->active == 1)
                    {
                        $back = '<a class="btn btn-warning" onclick="changeActive(this)" data-id="'.$item->id.'">';
                        $back.= "اقفال التفعيل"."</a>";
                    }
                    else
                    {
                        $back = '<a class="btn btn-success" onclick="changeActive(this)" data-id="'.$item->id.'">';
                        $back.= "تفعيل"."</a>";
                    }
                    return $back;
                 })
                 ->editColumn('image', function (Config $item) {
                    $back = ' <img src= "'.imageUrl($item->image).'" class="img-circle" style="width:75px;height:75px;" >';
                    return $back;
                 })
                 */
                ->editColumn("id",function($item){
                    $back = '<div class="checkbox checkbox-danger">';
                    $back.='
                        <input id="'.$item->id.'" type="checkbox" name="ids[]" value="'.$item->id.'">';
                    $back .= '
                        <label for="'.$item->id.'">  </label>
                    </div>';

                    return $back;
                })
                ->rawColumns(['options', 'active'])
                ->escapeColumns([])
                ->make(true);
        }


}
