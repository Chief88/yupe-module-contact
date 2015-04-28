<?php if(!empty($contacts)): ?>

        <?php $list = '';
        if( isset($params['wrapper']) && !empty($params['wrapper']) ){
            $wrapper = $params['wrapper'];
            $wrapperHtmlOptions = [];
            if( isset($params['wrapperHtmlOptions']) && !empty($params['wrapperHtmlOptions']) ){
                $wrapperHtmlOptions = $params['wrapperHtmlOptions'];
            }

            $wrapperHtmlOptionsString = '';
            foreach($wrapperHtmlOptions as $key => $option ){
                $wrapperHtmlOptionsString .= $key.'=\''.$option.'\' ';
            }

        }

        if( isset($params['itemsWrapper']) && !empty($params['itemsWrapper']) ){
            $itemsWrapper = $params['itemsWrapper'];
            $htmlOptions = [];
            if( isset($params['htmlOptions']) && !empty($params['htmlOptions']) ){
                $htmlOptions = $params['htmlOptions'];
            }

            $htmlOptionsString = '';
            foreach($htmlOptions as $key => $option ){
                $htmlOptionsString .= $key.'=\''.$option.'\' ';
            }

        }

        $typeContact = isset($params['type']) ? $params['type'] : '';

        foreach($contacts as $i =>$contact){

            $item = $typeContact == 'email' ? '<a href="mailto:'.$contact->data.'">'.$contact->data.'</a>' : $contact->data;

            $list .= isset($wrapper) ? '<'. $wrapper .' '. $wrapperHtmlOptionsString .'>'.$item.'</'.$wrapper.'>' : $item;

            if($i + 1 < count($contacts)){
                $list .= $itemDelimiter;
            }
        }

        $list = isset($params['itemsPrefix']) ? $params['itemsPrefix'].$list : $list;

        echo isset($itemsWrapper) ? '<'. $itemsWrapper .' '. $htmlOptionsString .'>'.$list.'</'.$itemsWrapper.'>' : $list; ?>

<?php endif; ?>