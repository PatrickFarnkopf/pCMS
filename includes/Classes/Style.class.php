<?php

/**
* Licensed under The Apache License
*
* @copyright Copyright 2013 Patrick Farnkopf
* @link https://github.com/PatrickFarnkopf/pCMS
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Patrick Farnkopf
*
*/

namespace Classes;

class Style extends Singleton {
    public function __construct($id) {
        $result = self::getInstance('\Classes\MySQL')
            ->query("SELECT style_declaration.id AS declId, style_declaration.name AS declName, description, styles.name AS styleName FROM style_declaration LEFT JOIN styles ON style_declaration.sid = styles.id WHERE style_declaration.sid = $id");

        while ($row = $result->fetch()) {
            $this->data[] = [
                'styleName' => $row->styleName, 
                'declName' => $row->declName,
                'declId' => $row->declId,
            ];
        }
    }

    public function getData() {
        $sData = [];
        foreach ($this->data as $i) {
            $arR = [];
            $result = self::getInstance('\Classes\MySQL')
                ->query('SELECT * FROM style_attribute WHERE sid = '.$i['declId']);

            while ($row = $result->fetch()) {
                $arR[] = ['id' => $row->id, 'attr' => $row->attribute, 'value' => $row->value];
            }

            $sData[] = [$i, 'attr' => $arR];
        }

        return $sData;
    }
}

?>
