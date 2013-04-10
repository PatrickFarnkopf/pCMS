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

class Page extends Singleton {

    private $pageName, $styleId, $templateId, $pageId;

    public function __construct($id) {
        $result = self::getInstance('\Classes\MySQL')->tableAction('pages')->select(NULL, ['id' => $id]);
        if ($row = $result->fetch()) {
            $this->pageName = $row->name;
            $this->styleId = $row->style_id;
            $this->templateId = $row->template_id;
            $this->pageId = $id;
        }
    }

    public function generate() {

        $result = self::getInstance('\Classes\MySQL')
            ->tableAction('templates')
            ->select(NULL, ['id' => $this->templateId]);

        if ($row = $result->fetch())
            if (file_exists($row->path))
                $template = file_get_contents($row->path);

        //generiere Seiteninhalt
        $result = self::getInstance('\Classes\MySQL')
            ->tableAction('page_content')
            ->select(NULL, ['pid' => $this->pageId]);

        while ($row = $result->fetch()) {
            $template = str_replace('#{'.$row->variable.'}', $row->value, $template);
        }

        $result = self::getInstance('\Classes\MySQL')
            ->tableAction('styles')
            ->select(NULL, ['id' => $this->styleId]);

        if ($row = $result->fetch()) {
            $template = str_replace('#{STYLE_FILE}', $row->path, $template);
            $this->stylePath = $row->path;
        }

        //generiere Styles
        $styleContent = '';
        $result = self::getInstance('\Classes\MySQL')
            ->tableAction('style_declaration')
            ->select(NULL, ['sid' => $this->styleId]);

        while ($style = $result->fetch()) {
            $styleContent .= $style->name." { \n";
            $res = self::getInstance('\Classes\MySQL')
                ->tableAction('style_attribute')
                ->select(NULL, ['sid' => $style->id]);

            while ($row = $res->fetch()) {
                $styleContent .= $row->attribute.': '.$row->value.";\n";
            }

            $styleContent .= "}\n";
        }

        file_put_contents($this->stylePath, $styleContent);
        file_put_contents('Cache/index.html', $template);
    }

    public function getContent() {
        return file_get_contents('Cache/index.html');
    }
}

?>
