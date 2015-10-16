<?php

namespace app\modules\objects\models;

use Yii;

class Objects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objects';
    }
 
      
    public function rules()
    {
        return [
            ['title', 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }
 
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'location' => 'Location',
            'opisaniye' => 'Opisaniye',
            'sale_rent' => 'Sale/rent',
            'cenaot' => 'Cenaot',
            'cenado' => 'Cenado',
            'cenaotrent' => 'Cenaotrent',
            'cenadorent' => 'Cenadorent',
            'beds' => 'Beds',
            'bathrooms' => 'Bathrooms',
            'parking' => 'Parking',
            'pool' => 'Pool',
            'typeobj' => 'Typeobj',
            'view' => 'View',
            'skidkasale' => 'Skidkasale',
            'skidkasaleold' => 'Skidkasaleold',
            'skidkasalenew' => 'Skidkasalenew',
            'skidkarent' => 'Skidkarent',
            'skidkarentold' => 'Skidkarentold',
            'skidkarentnew' => 'Skidkarentnew',
            'landsqm' => 'Landsqm',
            'shortosob' => 'Shortosob',
            'keyfeatures' => 'Keyfeatures',
            'aboutlocation' => 'Aboutlocation',
            'cenaotrentint' => 'Cenaotrentint',
            'cenadorentint' => 'Cenadorentint',
            'cenaotint' => 'Cenaotint',
            'cenadoint' => 'Cenadoint',
            'titleeng' => 'Titleeng',
            'titlethai' => 'Titlethai',
            'titlechn' => 'Titlechn',
            'opisaniyeeng' => 'Opisaniyeeng',
            'opisaniyethai' => 'Opisaniyethai',
            'opisaniyechn' => 'Opisaniyechn',
            'keyfeatureseng' => 'Keyfeatureseng',
            'keyfeaturesthai' => 'Keyfeaturesthai',
            'keyfeatureschn' => 'Keyfeatureschn',
            'aboutlocationeng' => 'Aboutlocationeng',
            'aboutlocationthai' => 'Aboutlocationthai',
            'aboutlocationchn' => 'Aboutlocationchn',
            'ownername' => 'Ownername',
            'ownercontacts' => 'Ownercontacts',
            'ownershortinfo' => 'Ownershortinfo',
            'ownprice1' => 'Ownprice1',
            'ownprice2' => 'Ownprice2',
            'ownprice3' => 'Ownprice3',
            'publicobj' => 'Publicobj',
            'beds2' => 'Beds2',
            'special' => 'Special',
            'specialsale' => 'Specialsale',
            'minsaleowner' => 'Minsaleowner',
            'goodsaleowner' => 'Goodsaleowner',
            'autor' => 'Autor',            
        ];
    }
}
