<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  
  function isThereaValidFile()
  {
    $i=0;
    while(isset($_FILES["file".$i]))
    {
      if($_FILES["file".$i]["size"]!=0)
        return true;
      $i++;
    }
    return false;
  }
  $i=0;
  $validFiles=isThereaValidFile();
  $currentDir="./programs/".$_POST["programName"];
  if($validFiles)
  {
   $createProgram=mkdir("./".$currentDir); 
   if($createProgram)  
   {
     while(isset($_FILES["file".$i]))
     {
       $okStatus=move_uploaded_file($_FILES["file".$i]["tmp_name"], $currentDir."/". $_FILES["file".$i]["name"]);
        if ($okStatus===0)
         //remove all files already on the server.
         break;
        $i++;
     }
    }
  }
}

