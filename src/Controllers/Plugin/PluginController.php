<?php

namespace Tadcms\Backend\Controllers\Plugin;

use Illuminate\Http\Request;
use Tadcms\Backend\Controllers\BackendController;
use Tadcms\System\Traits\ArrayPagination;
use Theanh\Modules\Facades\Plugin;

/**
 * Class Tadcms\Backend\Controllers\Plugin\PluginController
 *
 * @package    Theanh\Tadcms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://github.com/theanhk/tadcms
 * @license    MIT
 */
class PluginController extends BackendController
{
    use ArrayPagination;
    
    public function index()
    {
        return view('tadcms::plugin.index', [
            'title' => trans('tadcms::app.plugins'),
        ]);
    }
    
    public function getDataTable(Request $request)
    {
        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 20);
        
        $results = [];
        $plugins = Plugin::all();
        foreach ($plugins as $plugin) {
            $item = array_merge($plugin->json()->getAttributes(), [
                'id' => $plugin->get('name'),
                'status' => $plugin->isEnabled() ?
                    'active' : 'inactive',
            ]);
            unset($item['providers']);
            $results[] = $item;
        }
        
        $total = count($results);
        $page = $offset <= 0 ? 1 : (round($offset / $limit));
        $data = $this->arrayPaginate($results, $limit, $page);
        
        return response()->json([
            'total' => $total,
            'rows' => $data->items(),
        ]);
    }
    
    public function bulkActions(Request $request)
    {
        $request->validate([
            'ids' => 'required',
        ], [], [
            'ids' => trans('tadcms::app.plugins')
        ]);
        
        $ids = $request->post('ids');
        foreach ($ids as $plugin) {
            switch ($request->post('action')) {
                case 'delete':
                    Plugin::delete($plugin);
                    break;
                case 'activate':
                    Plugin::enable($plugin);
                    break;
                case 'deactivate':
                    Plugin::disable($plugin);
                    break;
            }
        }
        
        return $this->success(trans('app.successfully'));
    }
}
