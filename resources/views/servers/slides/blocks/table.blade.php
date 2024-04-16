<table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
    <thead>
        <tr>
            <th class="fs-15">
                <div class="form-check form-table-list-check">
                    {!! Form::checkbox('check-all', null, null, ['class' => 'form-check-input', 'id' => 'check-all'])
                    !!}

                </div>
            </th>
            <th style="width: 40%;">{{__('messages.slide.table.name')}}</th>
            @include('servers.includes.languageTableTh')
            <th>{{__('messages.tableDisplayGroup')}}</th>
            <th style="width: 5%;">{{__('messages.tableOrder')}}</th>
            <th>{{__('messages.tableStatus')}}</th>
            <th>{{__('messages.tableAction')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($slides as $slide) <tr>
            <td>
                <div class="form-check form-table-list-check">
                    <input class="form-check-input check-item" value="{{$slide->id}}" type="checkbox">
                </div>
            </td>
            <td>
                <div class="d-flex align-items-center justify-content-start">
                    <img class="avatar image-post rounded" src="{{$slide->image}}" alt="{{$slide->name}}">
                    <a href="" class="fw-bold link-body-emphasis ms-2 "> {{$slide->name}}</a>

                </div>
            </td>
            @include('servers.includes.languageTableTd', ['model' => $slide])
            <td>
                @foreach ($slide->slide_catalogues as $catalogue)
                @foreach ($catalogue->slide_catalogue_language as $val)
                <a href="{{route('slide.index', ['slide_catalogue_id' => $catalogue->id])}}"
                    class="post-catalogue-name link-body-emphasis"> {{$val->name}}</a>
                @endforeach
                @endforeach
            </td>
            <td class="">
                <input type="text" class="form-control sort-order" name="order" data-id="{{$slide->id}}"
                    data-model="{{$modelName}}" value="{{$slide->order}}" />
            </td>

            <td>
                <div class="toggler toggler-list-check">
                    {!! Form::checkbox('publish', $slide->publish, $slide->publish == 1, ['id' =>
                    "publish-{$slide->id}",
                    'class' => 'status', 'data-field' => 'publish', 'data-modelid' => $slide->id, 'data-model' =>
                    $model]) !!}
                    <label for="publish-{{$slide->id}}">
                        <svg class="toggler-on" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 130.2 130.2">
                            <polyline class="path check" points="100.2,40.2 51.5,88.8 29.8,67.5"></polyline>
                        </svg>
                        <svg class="toggler-off" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 130.2 130.2">
                            <line class="path line" x1="34.4" y1="34.4" x2="95.8" y2="95.8"></line>
                            <line class="path line" x1="95.8" y1="34.4" x2="34.4" y2="95.8"></line>
                        </svg>
                    </label>
                </div>
            </td>

            <td>
                <div class="btn-group" role="group">
                    <a href="{{route('slide.edit', $slide->id)}}" class="btn btn-outline-secondary"><i
                            class="icofont-edit text-success"></i></a>
                    <button type="button" data-id="{{$slide->id}}" class="btn btn-outline-secondary btn-delete"
                        data-bs-toggle="modal" data-bs-target="#modal-delete"><i
                            class="icofont-ui-delete text-danger"></i></a>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>

</table>

@include('servers.includes.modalDelete', ['routeModalDelete' => 'slide.destroy'])