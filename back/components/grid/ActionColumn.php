<?
namespace app\components\grid;
 
use yii\grid\ActionColumn as BaseActionColumn;
 
class ActionColumn extends BaseActionColumn
{
    public $contentOptions = [
         'class' => 'action-column',
    ];
}