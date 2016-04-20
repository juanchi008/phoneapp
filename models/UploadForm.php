<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
	/**
	 * @var UploadedFile|Null file attribute
	 */
	public $file;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
            [['file'], 'required'],
			[['file'], 'file'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'file' => 'Archivo',
		];
	}

	/**
	 * @inheritdoc
	 */
	public function isImage($extension)
	{
		return (array_search($extension, [
				'GIF' => 'gif',
				'JPG' => 'jpg', 
				'PNG' => 'png', 
				'SVG' => 'svg'
			]
		));
	}

	/**
	 * @inheritdoc
	 */
	public function isDocument($extension)
	{
		return (array_search($extension, [
				'PDF' => 'pdf',
				'DOC' => 'doc',
				'DOCX' => 'docx',
				'XLS' => 'xls',
				'XLSX' => 'xlsx'
				]
		));
	}
}
?>