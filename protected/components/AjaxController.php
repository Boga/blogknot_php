<?php

/** Abstract class for AJAX controllers
 * @author I.Shnurchenko<miju@tigryatnik.ru>
 */
abstract class AjaxController extends Controller {

    protected function get($id) {
    }

    protected function post($id) {

    }

    protected function put($id) {

    }

    protected function delete($id) {

    }

    public function actionAjax($id = null) {
        $action = Yii::app()->request->requestType;
        $this->$action($id);
    }

    protected function sendResponse($status = 200, $body = '', $location = null, $contentType = 'application/json') {
        $codes = [
            200 => 'OK',
            201 => 'Created',
            404 => 'Not Found',
        ];
        $status_text = isset($codes[$status]) ? $codes[$status] : '';

        $statusHeader = "HTTP/1.1 $status $status_text";
        header($statusHeader);
        header("Content-type: $contentType;charset=utf-8");
        if ($location) {
            header("Location: $location");
        }

        echo $body ? CJSON::encode($body) : null;
        Yii::app()->end();
    }

}
