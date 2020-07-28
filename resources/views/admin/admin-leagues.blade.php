
@extends('admin.layouts.admin-blank')
@section('admin-header')
    @include('admin.layouts.admin-header')
@endsection
@section('admin-content')
<main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Leagues</div>
                            <div class="card-header">View | <a href="{{ $route }}/leagues/add">Add</a></div>

                            <div class="card-body">
                                <form method="POST" action="{{ $route }}/leagues">
                                    <div class="form-group row">
                                        <table class="table-secondary table-bordered" width="100%">
                                            <tr class="table-primary">
                                                <th>LID</th>
                                                <th>League ID</th>
                                                <th>Name</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Status</th>
                                                <th>Stream</th>
                                                <th width="20px"></th>
                                                <th width="20px"></th>
                                            </tr>
                                            @foreach ($data['leagues'] as $leagues)
                                            <tr>
                                                <td><input style="background-color: #000000;" type="text" class="form-control " name="leagues[{{$leagues->LID}}][LID]" value="{{ $leagues->LID }}"></td>
                                                <td><input style="background-color: #000000;" type="text" class="form-control " name="leagues[{{$leagues->league_id}}][league_id]" value="{{ $leagues->league_id }}"></td>
                                                <td><input style="background-color: #000000;" type="text" class="form-control " name="leagues[{{$leagues->league_id}}][name_EN]" value="{{ $leagues->name_EN }}"></td>
                                                <td>{{ \Carbon\Carbon::parse($leagues->start_time)->toDateTimeString() }}</td>
                                                <td>{{ \Carbon\Carbon::parse($leagues->end_time)->toDateTimeString() }}</td>
                                                <td>{{ \App\Input\Admin\Leagues::getListStatus($leagues->LStatus) }}</td>
                                                <td>{{ (isset($leagues->stream_id) && isset($data['streams'][$leagues->stream_id])) ? $data['streams'][$leagues->stream_id]->channel : '' }}</td>
                                                <td><a href="{{ $route }}/leagues/edit/{{$leagues->LID}}">Edit</a></td>
                                                <td><a href="{{ $route }}/leagues/del/{{$leagues->LID}}">X</a></td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </form>
                            </div>
                            <div class="card-header">View | <a href="{{ $route }}/leagues/add">Add</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection
@section('admin-footer')
    @include('admin.layouts.admin-footer')
@endsection



