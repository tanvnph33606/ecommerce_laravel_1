<div class="col-lg-4">
    <div class="sticky-lg-top">
        <div class="card mb-3 card-create">
            <div class="card-header py-3 bg-transparent border-bottom-0">
                <h6 class="m-0 fw-bold">{{__('messages.parentId')}}</h6>
                <small class="text-danger ">*{{__('messages.parentIdNotice')}}</small>
            </div>
            <div class="card-body">
                <div class="mb-3 ">
                    <label class="form-label">{{__('messages.parentId')}}</label>
                    <select class="form-select init-select2" name="{moduleTemplate}_catalogue_id">
                        @foreach ($dropdown as $key => $val)
                        <option {{ $key==old('{moduleTemplate}_catalogue_id', isset(${moduleTemplate}->{moduleTemplate}_catalogue_id) ?
                            ${moduleTemplate}->{moduleTemplate}_catalogue_id : '') ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>

                @php
                $catalogues = [];
                // Phương thức pluck được sử dụng để trích xuất một thuộc tính cụ thể từ mỗi đối tượng trong tập hợp
                if (!empty(${moduleTemplate}->{moduleTemplate}_catalogues)) {
                $catalogues = ${moduleTemplate}->{moduleTemplate}_catalogues->pluck('id')->toArray();
                }
                @endphp

                <div>
                    <label class="form-label">{{__('messages.catalogueSub')}}</label>
                    <select class="form-select init-select2" multiple name="catalogue[]">
                        @foreach ($dropdown as $key => $val)
                        @php
                        // Bỏ lặp qua danh mục cha trùng với danh mục phụ
                        if (isset(${moduleTemplate}) && !empty(${moduleTemplate}) && $key == ${moduleTemplate}->{moduleTemplate}_catalogue_id) {
                        continue;
                        }
                        $selected = (is_array(old('catalogue', $catalogues ?? [])) && in_array($key, old('catalogue',
                        $catalogues ?? []))) ? 'selected' : '';
                        @endphp
                        <option {{ $selected }} value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>

            </div>


        </div>
        <div class="card mb-3 card-create">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                <h6 class="m-0 fw-bold">{{__('messages.advance')}}</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">{{__('messages.publish')}}</label>

                    <select class="form-select init-select2" name="publish">
                        @foreach (__('messages.general.publish') as $key => $publish)

                        <option {{ $key==old('publish', isset(${moduleTemplate}->publish) ?
                            ${moduleTemplate}->publish : '') ? 'selected' : '' }} value="{{$key}}">{{
                            $publish }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">{{__('messages.follow')}}</label>
                    <select class="form-select init-select2" name="follow">
                        @foreach (__('messages.general.follow') as $key => $follow)
                        <option {{ $key==old('follow', isset(${moduleTemplate}->follow) ?
                            ${moduleTemplate}->follow : '') ? 'selected' : '' }} value="{{$key}}">{{
                            $follow }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                <h6 class="m-0 fw-bold">{{__('messages.image')}}</h6>
            </div>
            <div class="card-body">
                <img class="img-thumbnail h-250 w-100 img-contain img-target" src="{{ (old('image', ${moduleTemplate}->image ?? asset('assets/servers/images/others/no-image.png'))) ?? asset('assets/servers/images/others/no-image.png') }}" alt="no-image">
                <input type="hidden" name="image" value="{{old('image', ${moduleTemplate}->image ?? '')}}" class="image">
            </div>
        </div>

    </div>
</div>