@extends('tadcms::layouts.admin')

@section('content')
    <div class="row alert alert-light p-3 no-radius">
        <div class="col-md-6 form-select-menu">
            <div class="alert-default">
                @lang('tadcms::app.select-menu-to-edit'):
                <select name="id" class="w-25 form-control load-menus">
                    @if(isset($menu->id))
                        <option value="{{ $menu->id }}" selected>{{ $menu->name }}</option>
                    @endif
                </select>

                @lang('tadcms::app.or') <a href="javascript:void(0)" class="ml-1 btn-add-menu"><i class="fa fa-plus"></i> {{ trans('tadcms::app.create-new-menu') }}</a>
            </div>
        </div>

        <div class="col-md-6 form-add-menu box-hidden">
            <form action="{{ route('admin.menu.save') }}" method="post" class="form-ajax form-inline">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" autocomplete="off" required placeholder="{{ trans('tadcms::app.menu-name') }}">
                </div>

                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> {{ trans('tadcms::app.add-menu') }}</button>
            </form>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4">
            <h5 class="mb-2 font-weight-bold">@lang('tadcms::app.add-menu-items')</h5>

            {{ \Tadcms\Backend\MenuItems\TaxonomyMenuItem::render() }}

            <div class="card card-menu-items">
                <div class="card-header card-header-flex">
                    <div class="d-flex flex-column justify-content-center">
                        <h5 class="mb-0">{{ trans('tadcms::app.categories') }}</h5>
                    </div>

                    <div class="ml-auto d-flex align-items-stretch">
                        <a href="javascript:void(0)" class="card-menu-show"><i class="fa fa-sort-down"></i></a>
                    </div>
                </div>

                <div class="card-body box-hidden">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript: void(0);" data-toggle="tab">Most Used</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="tab">View All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="tab">Search</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade p-2 active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="form-check mt-1">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Option two is checked now
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Option two is checked now
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Option two is checked now
                                </label>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="">
                                            Select all
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-primary">Add to menu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-menu-items">
                <div class="card-header card-header-flex">
                    <div class="d-flex flex-column justify-content-center">
                        <h5 class="mb-0">{{ trans('tadcms::app.categories') }}</h5>
                    </div>

                    <div class="ml-auto d-flex align-items-stretch">
                        <a href="javascript:void(0)" class="card-menu-show"><i class="fa fa-sort-down"></i></a>
                    </div>
                </div>

                <div class="card-body box-hidden">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript: void(0);" data-toggle="tab">Most Used</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="tab">View All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="tab">Search</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade p-2 active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="form-check mt-1">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Option two is checked now
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Option two is checked now
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Option two is checked now
                                </label>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="">
                                            Select all
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-primary">Add to menu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-menu-items">
                <div class="card-header card-header-flex">
                    <div class="d-flex flex-column justify-content-center">
                        <h5 class="mb-0">{{ trans('tadcms::app.custom-links') }}</h5>
                    </div>

                    <div class="ml-auto d-flex align-items-stretch">
                        <a href="javascript:void(0)" class="card-menu-show"><i class="fa fa-sort-down"></i></a>
                    </div>
                </div>

                <div class="card-body box-hidden">
                    <div class="form-group">
                        <label class="col-form-label">@lang('tadcms::app.url')</label>
                        <input type="text" name="url" class="form-control" placeholder="http://">
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">@lang('tadcms::app.link-text')</label>
                        <input type="text" class="form-control" name="text">
                    </div>

                    <button class="btn btn-primary">Add to menu</button>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <h5 class="mb-2 font-weight-bold">@lang('tadcms::app.menu-structure')</h5>

            <form action="{{ route('admin.menu.save') }}" method="post" class="form-ajax form-menu-structure">
                <input type="hidden" name="id" value="{{ $menu->id ?? '' }}">
                <textarea name="content" id="items-output" class="form-control"></textarea>

                <div class="card">
                    <div class="card-header bg-light pb-1">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3">{{ trans('tadcms::app.menu-name') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $menu->name ?? '' }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="btn-group float-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('tadcms::app.save') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="form-menu">

                        <div class="dd" id="nestable">

                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="btn-group">
                            <a href="javascript:void(0)" class="text-danger">{{ trans('tadcms::app.delete-menu') }}</a>
                        </div>

                        <div class="btn-group float-right">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('tadcms::app.save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#nestable').nestable({
                noDragClass: 'dd-nodrag',
                json: [{"text":"Menu 1","id":1,"children":[{"text":"Menu 2","id":1}]},{"text":"Menu 3","id":1},{"text":"Menu 4","id":1},{"text":"Menu 5","id":1},{"text":"Menu 6","id":1},{"text":"Menu 7","id":1},{"text":"Menu 8","id":1},{"text":"Menu 9","id":1},{"text":"Menu 10","id":1}]
            }).on('change', function (e) {
                let list   = e.length ? e : $(e.target);
                $('#items-output').val(window.JSON.stringify(list.nestable('serialize')));
            });

        });
    </script>

@endsection