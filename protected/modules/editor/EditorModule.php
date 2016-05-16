<?php

class EditorModule extends CWebModule {

    public $modulosHabilitados = array();

    public function init() {
        $this->setImport(array(
            'editor.components.*',
            'editor.models.*',
        ));
    }

}
