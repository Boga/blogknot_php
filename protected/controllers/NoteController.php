<?php

class NoteController extends AjaxController {

    protected function get($id) {
        $c = new CDbCriteria();
        if ($id) {
            $c->addColumnCondition(['id' => $id]);
        }
        $data = Note::model()->findAll($c);
        $this->sendResponse($data ? 200 : 404, $data);
    }

    protected function post($id) {
        $res = 404;
        $location = null;
        if (!$id) {
            $note = new Note();
            $note->setAttributes($_REQUEST);
            $success = $note->save();
            $res = $success ? 201 : 404;
            $location = $success ? Yii::app()->createUrl(Yii::app()->request->pathInfo, ['id' => $note->id]) : null;
        }
        $this->sendResponse($res, null, $location);
    }

    protected function put($id) {
        $success = true;
        if ($id) {
            /** @var Note $note */
            $note = Note::model()->findByPk($id);
            if (!$note) {
                $note = new Note();
            }
            $note->setAttributes($_REQUEST);
            $success = $note->save() ? 200 : 404;
            $res = $note->attributes;
        } else {
            $notes = CJSON::decode(Yii::app()->request->rawBody);
            Note::model()->deleteAll();
            $res = [];
            foreach ($notes as $note_data) {
                $note = new Note();
                $note->setAttributes($note_data);
                $success = $success && $note->save();
                $res[] = $note->attributes;
            }
        }
        $this->sendResponse($success, $res);
    }

    protected function delete($id) {
        if ($id) {
            /** @var Note $note */
            $note = Note::model()->findByPk($id);
            if ($note) {
                $res = $note->delete() ? 200 : 404;
            } else {
                $res = 404;
            }
        } else {
            $res = Note::model()->deleteAll() ? 200 : 404;
        }
        $this->sendResponse($res);
    }

}
