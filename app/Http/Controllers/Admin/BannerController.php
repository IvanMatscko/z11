<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Banner\EditBannerRequest;
use App\Http\Requests\Banner\CreateBannerRequest;

class BannerController extends Controller
{
    /**
     * BannerController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderByDesc('id')->paginate(48);

        return view('admin/admin-banners', [
            'data'    => [
                'route' => RouteServiceProvider::HOME,
            ],
            'banners' => $banners,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/banners/create', [
            'data' => [
                'route' => RouteServiceProvider::HOME,
            ],
        ]);
    }

    /**
     * Create banner
     *
     * @param \App\Http\Requests\Banner\CreateBannerRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateBannerRequest $request)
    {
        try {

            $image_dark = $this->upload_image('image_dark','', $request);
            $image_white = $this->upload_image('image_white','', $request);

            Banner::create_banner($image_dark, $image_white, $request->only('title', 'link'));

        } catch (\Exception $e) {
            return back()->with('errors', $e->getMessage());
        }

        return redirect()->route('banners.index')
            ->with('success', trans('l.banner.success_create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Banner $banner
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin/banners/edit', [
            'data'   => [
                'route' => RouteServiceProvider::HOME,
            ],
            'banner' => $banner,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Banner\EditBannerRequest $request
     * @param \App\Banner $banner
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditBannerRequest $request, Banner $banner)
    {
        try {

            $update_data = $request->only('title', 'link');

            $old_banner_dark  = $banner->image_dark;
            $old_banner_white = $banner->image_white;

            $update_data['image_dark']  = $this->upload_image('image_dark', $old_banner_dark, $request);
            $update_data['image_white'] = $this->upload_image('image_white', $old_banner_white, $request);

            $banner->update_banner($update_data);

        } catch (\Exception $e) {
            return back()->with('errors', $e->getMessage());
        }

        return redirect()->route('banners.index')
            ->with('success', trans('l.banner.success_edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Banner $banner
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Banner $banner)
    {
        $this->exists_image_and_remove($banner->image_dark);
        $this->exists_image_and_remove($banner->image_white);

        $banner->delete();

        return redirect()->route('banners.index')
            ->with('success', trans('l.banner.success_delete'));
    }

    /**
     * @param string $image
     * @param string $old_image
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    protected function upload_image(string $image, $old_image, Request $request)
    {
        if (!$request->hasFile($image)) {
            $return_name = $old_image;
        } else {
            $file        = $request->file($image);
            $image_name  = time() . $file->getClientOriginalName();
            $return_name = $image_name;

            $this->exists_image_and_remove($old_image);

            $file->move(public_path() . '/img/banners/', $image_name);
        }

        return $return_name;
    }

    protected function exists_image_and_remove(string $image)
    {
        if (File::exists(public_path("/img/banners/" . $image))) {
            File::delete(public_path("/img/banners/" . $image));
        }
    }
}
