<?php

namespace App\Http\Controllers\Admin;

use App\Stream;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Stream\EditStreamRequest;
use App\Http\Requests\Stream\CreateStreamRequest;

class StreamController extends Controller
{
    /**
     * StreamController constructor.
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
        $streams = Stream::orderByDesc('id')->paginate(48);

        return view('admin/admin-streams', [
            'data'    => [
                'route' => RouteServiceProvider::HOME,
            ],
            'streams' => $streams,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/streams/create', [
            'data'     => [
                'route' => RouteServiceProvider::HOME,
            ],
            'statuses' => Stream::list_status(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Stream\CreateStreamRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStreamRequest $request)
    {
        try {

            Stream::create_stream($request->only('channel', 'status'));

        } catch (\Exception $e) {
            return back()->with('errors', $e->getMessage());
        }

        return redirect()->route('streams.index')
            ->with('success', trans('l.stream.success_create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Stream $stream
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Stream $stream)
    {
        return view('admin/streams/edit', [
            'data'     => [
                'route' => RouteServiceProvider::HOME,
            ],
            'stream'   => $stream,
            'statuses' => Stream::list_status(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Stream\EditStreamRequest $request
     * @param \App\Stream $stream
     *
     * @return void
     */
    public function update(EditStreamRequest $request, Stream $stream)
    {
        try {

            $stream->update_stream($request->only('channel', 'status'));

        } catch (\Exception $e) {
            return back()->with('errors', $e->getMessage());
        }

        return redirect()->route('streams.index')
            ->with('success', trans('l.stream.success_edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Stream $stream
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Stream $stream)
    {
        $stream->delete();

        return redirect()->route('streams.index')
            ->with('success', trans('l.stream.success_delete'));
    }

    public function status(Stream $stream)
    {
        $status = $stream->status === Stream::STREAM_ON ? Stream::STREAM_OFF : Stream::STREAM_ON;

        $stream->update_status($status);

        return redirect()->route('streams.index')
            ->with('success', trans('l.stream.success_status'));
    }
}
