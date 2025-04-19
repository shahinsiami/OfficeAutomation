<?php

namespace App\Http\Controllers\Panel\Component;

use App\Model\Panel\Component\ComponentSocialMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;
class SocialMediaController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  socialMedia
    public function socialMedia()
    {
        if (Gate::allows('administrator')) {
            $socialMedia = ComponentSocialMedia::where('status', 1)->get();
            return response()->json($socialMedia);
        }
    }
    //////////////////////////////////////////////////////////////////////  socialMedia

    //////////////////////////////////////////////////////////////////////  registerSocialMedia
    public function registerSocialMedia(Request $request)
    {
        if (Gate::allows('administrator')) {

            $validator = Validator::make($request->all(), [
                'image1' => 'required',
                'title' => 'required',
                'link' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                ComponentSocialMedia::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('socialMedia',$request->title,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('socialMedia',$request->title,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerSocialMedia

    /////////////////////////////////////////////////////////////////////////////////////socialMediaTable
    public function socialMediaTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =ComponentSocialMedia::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////socialMediaTable



    //////////////////////////////////////////////////////////////////////  selectSocialMedia
    public function selectSocialMedia($id)
    {
        if (Gate::allows('administrator')) {
            $selectSocialMedia = ComponentSocialMedia::where('id', $id)->first();
            return response()->json($selectSocialMedia);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectSocialMedia
    //////////////////////////////////////////////////////////////////////  editSocialMedia
    public function editSocialMedia(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'link' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $socialMedia = ComponentSocialMedia::find($id);
                $socialMedia->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('socialMedia',$request->title,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('socialMedia',$request->title,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editSocialMedia

    /////////////////////////////////////////////////////////////////////////////////////deleteSocialMedia
    public function deleteSocialMedia($id)
    {
        if (Gate::allows('administrator')) {
            $socialMedia = ComponentSocialMedia::find($id);
            File::delete(public_path(ComponentSocialMedia::find($id)->image1));
            $socialMedia->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteSocialMedia
}
