<?php
namespace meigo\modules;

use php\io\IOException;
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
    
    function SaveFile() // Сохранение файла
    {
        // Инициализация
        $a = $this->dirChooser->execute(); // Получаем директорию
        $b = app()->form("MainForm")->tabs->tabs[app()->form("MainForm")->tabs->selectedIndex]->text; // Получаем имя файла сгенерированное ранее
        // ============================
        if (fs::isFile($a."\\".$b)) { // Проверяем существует ли файл, если существует, то текст будет заменяться, если нет - создаваться файл с текстом.
            // существует
            try {
               Stream::putContents($a."\\".$b, app()->form("MainForm")->getActiveBrowser()->executeScript("editor.getValue();"));
            } catch (IOException $e) {
               alert('Ошибка записи: ' . $e->getMessage());
            }
        } else {
            // не существует
            fs::makeFile($a."\\".$b);
            try {
               Stream::putContents($a."\\".$b, app()->form("MainForm")->getActiveBrowser()->executeScript("editor.getValue();"));
            } catch (IOException $e) {
               alert('Ошибка записи: ' . $e->getMessage());
            }
        }
        
    }
    
    function addTabImage($image = 'res://.data/img/plus16.png')
    {
        $b = app()->form("MainForm")->tabs->tabs[app()->form("MainForm")->tabs->selectedIndex]->graphic = new UXImageView(new UXImage($image));
        return $b;
    }
    
    
    
    

}
