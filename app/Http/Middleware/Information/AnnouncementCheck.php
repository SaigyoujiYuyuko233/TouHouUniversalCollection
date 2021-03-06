<?php

namespace App\Http\Middleware\Information;

use Closure;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;


class AnnouncementCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $sql = DB::table("announcement")->get()->last();
        $announcement = isset($sql->content) == true ? $sql->content : null;

        // 如果公告 == null
        if ($announcement != null){
            $announcement = str_replace("\n","",$announcement);
            $announcement = str_replace("\r","",$announcement);

            $announcement = 'swal({title: "' . $sql->summary . '", html: \'' . $announcement . '\', confirmButtonText: "知道了", type: "info"});';
        }

        // 判断是否带有通知cookie | false: 显示通知
        if($announcement != null && Cookie::has("announcement") == false){
            view()->share(["announcement" => $announcement]);
            Cookie::queue("announcement", $announcement, time() + 30*24*3600, "/");
        }

        // 判断是否显示最新通知
        if($announcement != null && Cookie::has("announcement") == true){
            if(Cookie::get("announcement") != $announcement){
                view()->share(["announcement_js" => $announcement]);
                Cookie::queue("announcement", $announcement, time() + 30*24*3600, "/");
            }
        }

        return $next($request);
    }
}
