<?php
$this->breadcrumbs = [
	Yii::t($this->aliasModule, 'Contacts') => [$this->patchBackend . 'index'],
	Yii::t($this->aliasModule, 'Creation'),
];

$this->pageTitle = Yii::t($this->aliasModule, 'Add new contact');

$this->menu = [
	[
		'label' => Yii::t($this->aliasModule, 'Contacts'),
		'items' => [
			[
				'icon' => 'list-alt',
				'label' => Yii::t($this->aliasModule, 'List contacts'),
				'url' => [$this->patchBackend . 'index']
			]
		],
	],
];
?>

	<div class="page-header">
		<h1>
			<?= Yii::t($this->aliasModule, 'Contacts'); ?>
			<small><?= Yii::t($this->aliasModule, 'creation'); ?></small>
		</h1>
	</div>

<?php
$this->renderPartial('_form', [
	'model' => $model,
	'languages' => $languages
]);