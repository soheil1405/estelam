<?php


function getFromSessiom($key , $value , $parser = "string"){
   $sessionFile =   session()->get($key);

   if(old($value)){

      return old($value);


   }elseif(  $sessionFile && is_array($sessionFile)   && array_key_exists($value ,$sessionFile)){
  
      if($parser == "int"){

         
         return (int) $sessionFile[$value];
      }

      
    return $sessionFile[$value] ;
   }elseif(  $sessionFile && !is_array($sessionFile)  ){
   
      return $sessionFile;
   }
}


function  getSighnedRouteFromSession()  {
   
   return getFromSessiom("route" , "route" , "string");
}