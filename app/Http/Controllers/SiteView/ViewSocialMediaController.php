<?php

namespace App\Http\Controllers\SiteView;

use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentSocialMedia;
use App\Traits;

class ViewSocialMediaController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  viewSocialMedia
    public function viewSocialMedia()
    {
        $viewSocialMedia = ComponentSocialMedia::get();
        return response()->json($viewSocialMedia);
    }
    //////////////////////////////////////////////////////////////////////  viewSocialMedia
}
