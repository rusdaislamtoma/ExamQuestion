<?php
function canViewRoute($uri,$type=false)
{
    if(isset($type) && $type != null)
    {
        if($type='route')
        {
            if(\App\Permission::where('route_name',$uri)->orWhere('route_uri',$uri)->exists()) {
                $permission = \App\Permission::where('route_name', $uri)->orWhere('route_uri',$uri)->first();
                $uri = $permission->route_uri;
            }
        }
    }
    $mdl=new \App\Http\Middleware\AuthorizationMiddleware();
    if($mdl->checkAccessibility($uri))
    {
        return true;
    }
    return false;
}