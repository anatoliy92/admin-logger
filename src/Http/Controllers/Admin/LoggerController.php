<?php namespace Avl\AdminLogger\Http\Controllers\Admin;

use App\Http\Controllers\Avl\AvlController;
use Avl\AdminLogger\Models\AdminLog;
use Illuminate\Http\Request;

class LoggerController extends AvlController
{

    /**
     * Вывод списка логов
     * @param  Request $request
     * @return view
     */
    public function index (Request $request)
    {
        $logs = new AdminLog;

        $logs = $this->getQuery($logs, $request);

        return view('adminlogger::admin.logger.index', [
          'logs' => $logs->orderBy('created_at', 'DESC')->paginate(config('adminlogger.countPage')),
          'request' => $request
        ]);
    }

    /**
     * Отображение детальной информации лога
     * @param  integer  $id     номер записи
     * @param  Request $request
     * @return view
     */
    public function show ($id, Request $request)
    {
      $log = AdminLog::findOrFail($id);

      return view('adminlogger::admin.logger.show', [
        'log' => $log
      ]);
    }

    /**
     * Формирование запроса при применении фильтра
     * @param  query $logs
     * @param  Request $request
     * @return query
     */
    protected function getQuery ($logs, $request)
    {
      if ($request->input('event')) {
        $logs = $logs->whereEvent($request->input('event'));
      }

      if ($request->input('after')) {
        $logs = $logs->where('created_at', '>=', $request->input('after'));
      }

      if ($request->input('before')) {
        $logs = $logs->where('created_at', '<=', $request->input('before'));
      }

      if ($request->input('model')) {
        $logs = $logs->whereModel($request->input('model'));
      }

      return $logs;
    }
}
