<?php

namespace Tadcms\Backend\Abstracts;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Tadcms\System\Repositories\TaxonomyRepository;
use Tadcms\Backend\Controllers\BackendController;
use Tadcms\Backend\Requests\TaxonomyRequest;
use Tadcms\System\Models\Taxonomy;

abstract class TaxonomyControllerAbstract extends BackendController
{
    protected $taxonomyRepository;
    protected $objectType;
    protected $taxonomy;
    protected $setting;

    public function __construct(
        TaxonomyRepository $taxonomyRepository
    ) {
        $this->taxonomyRepository = $taxonomyRepository;
        $this->setting = $this->getSetting();

        if (empty($this->setting)) {
            throw new \Exception('Taxonomy ' . $this->taxonomy . ' for '. $this->objectType .' does not exists.');
        }
    }

    public function index()
    {
        $model = $this->taxonomyRepository->firstOrNew(['id' => null]);

        return view('tadcms::taxonomy.index', [
            'title' => $this->setting->get('label'),
            'taxonomy' => $this->taxonomy,
            'setting' => $this->setting,
            'lang' => $this->getLocale(),
            'model' => $model,
        ]);
    }

    public function create()
    {
        $model = $this->taxonomyRepository->newModel();
        $this->addBreadcrumb([
            'title' => $this->setting->get('label'),
            'url' => route('admin.'. $this->setting->get('type') .'.'. $this->taxonomy .'.index')
        ]);

        return view('tadcms::taxonomy.form', [
            'model' => $model,
            'title' => trans('tadcms::app.add-new'),
            'taxonomy' => $this->taxonomy,
            'setting' => $this->setting,
            'lang' => $this->getLocale()
        ]);
    }

    public function edit($id)
    {
        $model = $this->taxonomyRepository->findOrFail($id);
        $model->load('parent');

        $this->addBreadcrumb([
            'title' => $this->setting->get('label'),
            'url' => route('admin.'. $this->setting->get('type') .'.'. $this->taxonomy .'.index')
        ]);

        return view('tadcms::taxonomy.form', [
            'model' => $model,
            'title' => $model->name,
            'taxonomy' => $this->taxonomy,
            'setting' => $this->setting,
            'lang' => $this->getLocale(),
        ]);
    }

    public function getDataTable(Request $request)
    {
        $search = $request->get('search');
        $sort = $request->get('sort', 'id');
        $order = $request->get('order', 'desc');
        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 20);

        $query = Taxonomy::query()->with(['translations']);
        $query->where('taxonomy', '=', $this->taxonomySingular);
        $query->where('type', '=', $this->type);

        if ($search) {
            $query->where(function ($subquery) use ($search) {
                $subquery->orWhereTranslationLike('name', '%'. $search .'%');
                $subquery->orWhereTranslationLike('description', '%'. $search .'%');
            });
        }

        $count = $query->count();
        $query->orderBy($sort, $order);
        $query->offset($offset);
        $query->limit($limit);
        $rows = $query->get();

        foreach ($rows as $row) {
            $row->edit_url = route("admin.{$this->taxonomy}.edit", [$row->id]);
            $row->thumbnail = upload_url($row->thumbnail);
        }

        return response()->json([
            'total' => $count,
            'rows' => $rows
        ]);
    }

    public function store(TaxonomyRequest $request)
    {
        if (Taxonomy::whereHas('translations', function ($q) use ($request) {
            $q->where('name', '=', $request->name);
        })
            ->whereType($this->type)
            ->whereTaxonomy($this->taxonomy)
            ->exists()
        ) {
            return $this->error(
                trans('validation.exists', [
                    'attribute' => trans('tadcms::app.name')
                ])
            );
        }

        $this->taxonomyRepository->create(array_merge($request->all(), [
            'type' => $this->type,
            'taxonomy' => $this->taxonomySingular
        ]));

        return $this->success(trans('tadcms::app.successfully'));
    }

    public function update($id, TaxonomyRequest $request)
    {
        $this->taxonomyRepository->update($id, array_merge($request->all(), [
            'type' => $this->type,
            'taxonomy' => $this->taxonomySingular
        ]));

        return $this->success(trans('tadcms::app.successfully'));
    }

    public function bulkActions(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'action' => 'required',
        ]);

        do_action('bulk_action.taxonomy.' . $this->taxonomy, $request->post());

        $action = $request->post('action');
        $ids = $request->post('ids');

        try {
            DB::beginTransaction();
            switch ($action) {
                case 'delete':
                    foreach ($ids as $id) {
                        $this->taxonomyRepository->delete($id);
                    }
                    break;
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return $this->success(
            trans('tadcms::app.successfully')
        );
    }

    protected function getLocale()
    {
        return request()->input('locale') ?? app()->getLocale();
    }

    /**
     * @return \Illuminate\Support\Collection
     * */
    protected function getSetting()
    {
        $taxonomies = collect(apply_filters('tadcms.taxonomies', []));
        $taxonomies = $taxonomies->filter(function ($item) {
            return Arr::has($item['object_types'], $this->objectType);
        })->mapWithKeys(function ($item) {
            return [$item['taxonomy'] => $item['object_types'][$this->objectType]];
        });

        return $taxonomies->get($this->taxonomy);
    }
}
