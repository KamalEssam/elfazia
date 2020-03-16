<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Repositories\GroupRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\Group;
use function Helper\Common\imageUrl;

class GroupController extends AppBaseController
{
    /** @var  GroupRepository */
    private $groupRepository;

    public function __construct(GroupRepository $groupRepo)
    {
        $this->groupRepository = $groupRepo;
    }







    /**
     * Display a listing of the Group.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->groupRepository->pushCriteria(new RequestCriteria($request));
        $groups = $this->groupRepository->all();
        */

        return view('groups.index');
        /*return view('groups.index')
             ->with('groups', $groups);*/
    }

    public function ajax($level)
    {
        $grous = Group::where("level_id",$level)->get();
        return $grous;
    }

    /**
     * Show the form for creating a new Group.
     *
     * @return Response
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created Group in storage.
     *
     * @param CreateGroupRequest $request
     *
     * @return Response
     */
    public function store(CreateGroupRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $group = $this->groupRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('groups.index'));
    }

    /**
     * Display the specified Group.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $group = $this->groupRepository->findWithoutFail($id);

        if (empty($group)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('groups.index'));
        }

        return view('groups.show')->with('group', $group);
    }

    /**
     * Show the form for editing the specified Group.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $group = $this->groupRepository->findWithoutFail($id);

        if (empty($group)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('groups.index'));
        }

        return view('groups.edit')->with('group', $group);
    }

    /**
     * Update the specified Group in storage.
     *
     * @param  int              $id
     * @param UpdateGroupRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGroupRequest $request)
    {


        $group = $this->groupRepository->findWithoutFail($id);

        if (empty($group)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('groups.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $group = $this->groupRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('groups.index'));
    }

    /**
     * Remove the specified Group from storage.
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
                 $this->groupRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('groups.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('groups.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->groupRepository->delete($id);
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

        $items = new Group();
        $items = $items->join("levels","levels.id","=","groups.level_id");
        $items = $items->join("centers","centers.id","=","groups.center_id");
        $items = $items->select("groups.*","levels.name as level","centers.name as center");

        return DataTables::eloquent($items)
                ->addColumn('options', function (Group $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
                <a type="button" href="'. route('groups.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
               
                   </div>';
                  return $back;


                })
                /*
                 ->addColumn("active",function(Group $item){
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
                 ->editColumn('image', function (Group $item) {
                    $back = ' <img src= "'.imageUrl($item->image).'" class="img-circle" style="width:75px;height:75px;" >';
                    return $back;
                 })
                 */
                ->editColumn("id",function($item){
                 $back = '<div class="btn-group">';
                                    $back.='
                                    <label class="checkbox checkbox-primary" for="'.$item->id.'">
                                                <input id="'.$item->id.'" type="checkbox" name="ids[]" value="'.$item->id.'">
                                                <span class="checkmark"></span>
                                            </label>';
                                    $back .= '
                                    </div>';


                    return $back;
                })
                ->rawColumns(['options', 'active'])
                ->escapeColumns([])
                ->make(true);
        }


}
