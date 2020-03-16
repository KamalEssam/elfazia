<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserWalletRequest;
use App\Http\Requests\UpdateUserWalletRequest;
use App\Repositories\UserWalletRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\UserWallet;
use function Helper\Common\imageUrl;

class UserWalletController extends AppBaseController
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
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->userWalletRepository->pushCriteria(new RequestCriteria($request));
        $userWallets = $this->userWalletRepository->all();
        */

        return view('user_wallets.index');
        /*return view('user_wallets.index')
             ->with('userWallets', $userWallets);*/
    }



    /**
     * Show the form for creating a new UserWallet.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_wallets.create');
    }

    /**
     * Store a newly created UserWallet in storage.
     *
     * @param CreateUserWalletRequest $request
     *
     * @return Response
     */
    public function store(CreateUserWalletRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $userWallet = $this->userWalletRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('userWallets.index'));
    }

    /**
     * Display the specified UserWallet.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userWallet = $this->userWalletRepository->findWithoutFail($id);

        if (empty($userWallet)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('userWallets.index'));
        }

        return view('user_wallets.show')->with('userWallet', $userWallet);
    }

    /**
     * Show the form for editing the specified UserWallet.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userWallet = $this->userWalletRepository->findWithoutFail($id);

        if (empty($userWallet)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('userWallets.index'));
        }

        return view('user_wallets.edit')->with('userWallet', $userWallet);
    }

    /**
     * Update the specified UserWallet in storage.
     *
     * @param  int              $id
     * @param UpdateUserWalletRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserWalletRequest $request)
    {


        $userWallet = $this->userWalletRepository->findWithoutFail($id);

        if (empty($userWallet)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('userWallets.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $userWallet = $this->userWalletRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('userWallets.index'));
    }

    /**
     * Remove the specified UserWallet from storage.
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
                 $this->userWalletRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('userWallets.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('userWallets.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->userWalletRepository->delete($id);
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
            $items = UserWallet::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (UserWallet $item) {
                    $back = ' <div class="btn-group">';
                    $back .= '
                        <a href="'. route('userWallets.show' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
                        <a href="'. route('userWallets.edit' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
                    </div>';
                    return $back;
                })
                /*
                 ->addColumn("active",function(UserWallet $item){
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
                 ->editColumn('image', function (UserWallet $item) {
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
