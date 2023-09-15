<?php 
/**
 * check if page active
 * @var string $page
 * @return bool
 */
if(! function_exists('active_page'))
{
    function active_page($page = 'dashboard')
    {
        $active = '';
        (request()->segment(3) == $page) ?  $active = 'active' :  $active ='';
        return $active; 
    }
}