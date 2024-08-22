<?php
namespace meigo\forms;

use php\io\IOException;
use gui\Ext4JphpWindows;
use std, gui, framework, meigo;


class MainForm extends AbstractForm
{

    /**
     * @event image3.click-Left 
     */
    function doImage3ClickLeft(UXMouseEvent $e = null)
    {

    }

    /**
     * @event image5.click-Left 
     */
    function doImage5ClickLeft(UXMouseEvent $e = null)
    {

    }

    /**
     * @event edit3.globalKeyUp-Enter 
     */
    function doEdit3GlobalKeyUpEnter(UXKeyEvent $e = null)
    {

    }

    /**
     * @event image8.click-Left 
     */
    function doImage8ClickLeft(UXMouseEvent $e = null)
    {
        
    }










    /**
     * @event image32.click-Left 
     */
    function doImage32ClickLeft(UXMouseEvent $e = null)
    {
          app()->shutdown();
    }

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $a = new Ext4JphpWindows;
        $a->addBlur($this);
        $a->addShadow($this);
        $a->addBorder($this, 1, "red");
    }

    /**
     * @event image4.click-Left 
     */
    function doImage4ClickLeft(UXMouseEvent $e = null)
    {    
        $this->textArea->text = null;
        $a = $this->fileChooser->execute();
        try {
            $file = Stream::of($a);
            $scanner = new Scanner($file);

            $lines = [];
        
            while ($scanner->hasNextLine()) {
                 $line = $scanner->nextLine();
                 $lines[] = $line;
                 $this->textArea->text .= $line."\n";
            }
        
            $file->close();
        } catch (IOException $e) {
            alert('Ошибка чтения файла');
        }
    }

    /**
     * @event textArea.keyUp 
     */
    function doTextAreaKeyUp(UXKeyEvent $e = null)
    {    
        $length = $this->textArea->length;
        $mb = $length / 1000000;
        $this->length->text = "length : " . $length . "     "."Size: ".round($mb, 2) . "MB";
    }

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {    
        $text = $this->textArea->text;
        $s = $this->dirChooser->execute();
        try {
           Stream::putContents(rand(1,10000).".txt", $text);
        } catch (IOException $e) {
           alert('Ошибка записи: ' . $e->getMessage());
        }
    }







}
