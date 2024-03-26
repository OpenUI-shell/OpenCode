<?php
namespace meigo\modules;

use std, gui, framework, app;


class MainModule extends AbstractModule
{

    /**
     * @event fileChooser.action 
     */
    function doFileChooserAction(ScriptEvent $e = null)
    {    
        $p = $this->fileChooser->file;
        $s = Stream::getContents($p);
        //app()->form("MainForm")->getActiveBrowser()->executeScript("editor.insert('".$s."');");
        var_dump($s);
        $s = explode("/n", $s);
        foreach ($s as $str){
            $this->form('MainForm')->putVal($str . "/n");
        }
    }
    
    
    
    

}
