<?php

/** Abstract class for AJAX controllers
 * @author I.Shnurchenko<miju@tigryatnik.ru>
 */
abstract class AjaxController extends Controller {

    protected function get($id, $details) {
    }

    protected function post($id) {

    }

    protected function put($id) {

    }

    protected function delete($id) {

    }

    public function actionAjax($id = null, $details = null) {
        $action = Yii::app()->request->requestType;
        $this->$action($id, $details);
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

        echo CJSON::encode($body);
        Yii::app()->end();
    }

}
