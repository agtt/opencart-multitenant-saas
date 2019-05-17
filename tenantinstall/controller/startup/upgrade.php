<?php

class ControllerStartupUpgrade extends Controller
{
    public function index()
    {
        $upgrade = @$_GET['upgrade'] ? true : false;

        if (isset($this->request->get['route'])) {
            if (($this->request->get['route'] == 'install/step_4') || (substr($this->request->get['route'], 0, 8) == 'upgrade/') || (substr($this->request->get['route'], 0, 10) == '3rd_party/')) {
                $upgrade = false;
            }
        }

        if ($upgrade) {
            $this->response->redirect($this->url->link('upgrade/upgrade'));
        }
    }
}