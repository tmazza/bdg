<?php

class PgModule extends CWebModule {

    public $modulosHabilitados = array();

    public function init() {
        $this->setImport(array(
            'pg.components.*',
            'pg.vendor.*',
        ));
    }

}
