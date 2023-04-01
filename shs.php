<?php
const PATH_TO_ASSIGNMENT_FOLDER = '../assignment2';

if(!file_exists(PATH_TO_ASSIGNMENT_FOLDER))
{
    die('Please set a correct path');
}


$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(PATH_TO_ASSIGNMENT_FOLDER));

$files = array(); 
$index = 0;

foreach ($rii as $file) {

    if ($file->isDir()){ 
        continue;
    }
    
    $ext = pathinfo($file->getPathname(), PATHINFO_EXTENSION);
    if($ext == 'php'){
        $files[$index] = '<a href=\'?f=' . $file->getPathname() . '\'>' . $file->getPathname() . '</a>'; 
        echo $files[$index++] . '<br>';
    }    

}



//var_dump($files);

if(isset($_GET['f']))
{
    show_source($_GET['f']);
}