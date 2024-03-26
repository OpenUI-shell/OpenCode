<?php
namespace meigo\forms;

use gui\Ext4JphpWindows;
use std, gui, framework, app;


class MainForm extends AbstractForm
{
    
    function setVal($text)
    {
        $this->getActiveBrowser()->executeScript("editor.setValue('".$text."');");
    }
    
    function putVal($text)
    {
        $this->getActiveBrowser()->executeScript("editor.insert('".$text."');");
    }
    
    function setLang($lang)
    {
        $this->getActiveBrowser()->executeScript("editor.session.setMode(\"ace/mode/".$lang."\");");
    }
    
    /**
     * @event show 
     **/
    function doShow(UXWindowEvent $event)
    {    
        $this->openTab();
        waitAsync(1000, function () use ($e, $event) {
            $this->setLang($this->combobox->value);
        });
    }

    /**
     * @event tabs.close 
     **/
    function doTabsClose(UXEvent $event)
    {    
        if($this->tabs->tabs->count == 0){
            $this->openTab();
        }
    }

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {    
        pre($this->getActiveBrowser()->executeScript("editor.getValue();"));
    }


    /**
     * @event combobox.action 
     */
    function doComboboxAction(UXEvent $e = null)
    {    
        $this->setLang($this->combobox->value);
    }

    /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null)
    {    
        $this->openTab();
    }

    /**
     * @event button3.action 
     */
    function doButton3Action(UXEvent $e = null)
    {    
        $this->fileChooser->execute();
    }
    
    /**
     * Возвращает элемент браузера из активной вкладки
     **/
    public function getActiveBrowser(){
        $tab = $this->getActiveTab();
        return $tab->content->engine;
    }

    public function getActiveTab(){
        return $this->tabs->tabs[$this->tabs->selectedIndex];
    }
    
    /**
     * Создание новой вкладки браузера
     **/     
    public function openTab(){       
        $tab = new UXTab();
        $tab->text = "New tab";
        $res = new ResourceStream('/ace/editor.html'); 
        $url = $res->toExternalForm(); 
        $web = new UXWebView();
        $web->engine->load($url);
        $tab->content = $web;
        
        $this->tabs->tabs[] = $tab;
        
        return $web->engine;
    }

    /**
     * Проверяет, является ли переданный id браузера в активной вкладке
     **/
    public function isActive($elid){
        return $elid  ==  $this->getActiveTab()->content->id;
    }

}
