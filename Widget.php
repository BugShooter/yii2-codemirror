<?php
namespace yiiBoy\CodeMirror;

use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * CodeMirror Widget is the base class for widget that proview text editor functionality.
 *
 * CodeMirror is a versatile text editor implemented in JavaScript for the browser.
 * It is specialized for editing code, and comes with a number of language modes and addons
 * that implement more advanced editing functionality.
 *
 * Classes extending from this widget can be used in an [[yii\widgets\ActiveForm|ActiveForm]]
 * using the [[yii\widgets\ActiveField::widget()|widget()]] method, for example like this:
 *
 * ```php
 * <?= $form->field($model, 'text')->widget(\yiiBoy\CodeMirror\Widget::className(), [
 *      // configure additional widget properties here
 *      'clientOptions' => [
 *          'lineNumbers' => true,
 *          'mode' => 'htmlmixed',
 *      ]
 * ]) ?>
 * ```
 *
 * @author Alexey Muravyov <muravyov.alexey@gmail.com>
 * @since 1.0
 */
class Widget extends InputWidget
{

    public $clientOptions = [
        'lineNumbers' => true,
        'mode' => 'htmlmixed',
    ];

    /**
     * @return string
     */
    public function run()
    {
        $this->registerScripts();

        if ($this->hasModel()) {
            $html = Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            $html = Html::textarea($this->name, $this->value, $this->options);
        }
        echo $html;

    }

    protected function registerScripts()
    {
        Asset::register($this->view);
        $options = Json::encode($this->clientOptions);

        $id = $this->options['id'];
        $rows = isset($this->options['rows'])?'true':'false';
        $cols = isset($this->options['cols'])?'true':'false';
        $this->view->registerJs(
<<<JS
var w = {$cols} ? $('#{$id}').width() : 'auto';
var h = {$rows} ? $('#{$id}').height() : 'auto';
var e = CodeMirror.fromTextArea(document.getElementById("{$id}"), $options);
e.setSize(w, h);
JS
        );

    }
}
