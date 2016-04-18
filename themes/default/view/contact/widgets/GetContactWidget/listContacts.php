<?php if (!empty($contacts)): ?>

	<?php $list = '';
	if (isset($params['wrapperTagName']) && !empty($params['wrapperTagName'])) {
		$wrapper = $params['wrapperTagName'];
		$wrapperHtmlOptions = [];
		if (isset($params['wrapperHtmlOptions']) && !empty($params['wrapperHtmlOptions'])) {
			$wrapperHtmlOptions = $params['wrapperHtmlOptions'];
		}

	}

	if (isset($params['itemsWrapper']) && !empty($params['itemsWrapper'])) {
		$itemsWrapper = $params['itemsWrapper'];
		$htmlOptions = [];
		if (isset($params['htmlOptions']) && !empty($params['htmlOptions'])) {
			$htmlOptions = $params['htmlOptions'];
		}

	}

	foreach ($contacts as $i => $contact) {
		$contact->data = preg_replace('/[\r\n]+/m', '<br>', $contact->data);

		$item = $contact->contactType->validation == 'email' ?
			CHtml::link($contact->data, 'mailto:' . $contact->data) : $contact->data;

		$list .= isset($wrapper) ?
			CHtml::openTag($wrapper, $wrapperHtmlOptions) . $item . CHtml::closeTag($wrapper) : $item;

		if ($i + 1 < count($contacts)) {
			$list .= $itemDelimiter;
		}
	}

	$list = isset($params['itemsPrefix']) ? $params['itemsPrefix'] . $list : $list;
	$list = isset($params['itemsPostfix']) ? $list . $params['itemsPostfix'] : $list;

	echo isset($itemsWrapper) ?
		CHtml::openTag($itemsWrapper, $htmlOptions) . $list . CHtml::closeTag($itemsWrapper) : $list; ?>

<?php endif; ?>