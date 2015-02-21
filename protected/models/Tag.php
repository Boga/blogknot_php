<?php

/**
 * [db]
 * @property integer $id
 * @property string  $title
 *
 * [relations]
 * @property Note $notes
 *
 */
class Tag extends CActiveRecord {
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'bloknot.tag';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['title', 'length', 'max' => 255],
            ['title', 'safe', 'on' => 'search'],
        ];
    }

    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
            'notes' => [self::MANY_MANY, 'Note', 'bloknot.tagnote(tag_id, note_id)'],
        ];
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('title', $this->profile, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
