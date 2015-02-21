<?php

class TagController extends AjaxController {

    protected function get($id) {
        # It's responding 404 in case of empty tables; that's non-convenient way.
        $c = new CDbCriteria();
        if ($id) {
            $c->addColumnCondition(['id' => $id]);
        }
        $c->order = 'id asc';
        $data = Tag::model()->findAll($c);
        $this->sendResponse($data ? 200 : 404, $data);
    }

    protected function post($id) {
        $res = 404;
        $location = null;
        if (!$id) {
            $tag = new Tag();
            $tag->setAttributes($_REQUEST);
            $success = $tag->save();
            $res = $success ? 201 : 404;
            $location = $success ? Yii::app()->createUrl(Yii::app()->request->pathInfo, ['id' => $tag->id]) : null;
        }
        $this->sendResponse($res, null, $location);
    }

    protected function put($id) {
        $success = true;
        if ($id) {
            /** @var Tag $tag */
            $tag = Tag::model()->findByPk($id);
            if (!$tag) {
                $tag = new Tag();
            }
            $tag->setAttributes($_REQUEST);
            $success = $tag->save() ? 200 : 404;
            $res = $tag->attributes;
        } else {
            $tags = CJSON::decode(Yii::app()->request->rawBody);
            Tag::model()->deleteAll();
            $res = [];
            foreach ($tags as $tag_data) {
                $tag = new Tag();
                $tag->setAttributes($tag_data);
                $success = $success && $tag->save();
                $res[] = $tag->attributes;
            }
        }
        $this->sendResponse($success, $res);
    }

    protected function delete($id) {
        if ($id) {
            /** @var Tag $tag */
            $tag = Tag::model()->findByPk($id);
            if ($tag) {
                $res = $tag->delete() ? 200 : 404;
            } else {
                $res = 404;
            }
        } else {
            $res = Tag::model()->deleteAll() ? 200 : 404;
        }
        $this->sendResponse($res);
    }

}