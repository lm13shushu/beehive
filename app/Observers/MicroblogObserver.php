<?php

namespace App\Observers;

use App\Models\Microblog;
use App\Models\User;
use App\Notifications\MicroblogForwarded;
use App\Notifications\MicroblogAted;


// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class MicroblogObserver
{
    public function created(Microblog $microblog)
    {
        // 通知被转发微博的作者微博被转发了
        if($microblog->is_forward){
            $microblog->initialMicroblog->user->notify(new MicroblogForwarded($microblog));
        }elseif($microblog->at_user !=null){
            //dd('1');
            $atUserString="";
            preg_match_all("/@([\s\S]*?);/", $microblog->at_user, $matchUserNames);
            //dd($matches[1]);
            $userArray=User::whereIn('name',$matchUserNames[1])->get();
            //dd($userArray);
            if($userArray){
                 foreach($userArray as $user){
                    //dd($user);                    
                    $atUserString.='<a href="'.getenv('APP_URL')."/users/".$user->id.'">@'.$user->name."</a>"."&nbsp;";
                    $user->notify(new MicroblogAted($microblog));
                }
                //dd($atUserString);
                $microblog->content.= $atUserString;
                Microblog::where('id',$microblog->id)->update(['content'=>$microblog->content]);
            }
         }else{
               return ;
         }
    }

    public function saving(Microblog $microblog)
    {
        //
        if($microblog->is_forward == 0){
            $microblog->content = clean(htmlspecialchars_decode($microblog->content),'microblog_content');
            //dd($microblog->content);
        }else{
            $microblog->content = preg_replace('/<\/?(html|head|meta|link|base|body|title|style|script|form|iframe|frame|frameset)[^><]*>/i','',$microblog->content);
        }       
        //$microblog->excerpt = make_excerpt($microblog->content);     
    }

   public function deleting(Microblog $microblog)
    {
        //当后台删除微博时，将该微博下回复一并删除
        $parentComments=$microblog->comments;
        foreach ($parentComments as $parentComment) {

            $parentComment->delete();
        }
        
        // 当微博下有转发微博时，将转发微博一并删除,同时触发微博删除观察器将转发微博下的回复也一并删除
        // if($microblog->forward_count > 0){
        //     $forwardMicroblogs=$microblog->forwardMicroblogs;
        //         foreach ($forwardMicroblogs as $forwardMicroblog) {
        //             $forwardMicroblog->delete();
        //     }
        // }
    }

    //如果转发的微博被删除，将被转微博下的转发次数减一
    public function deleted(Microblog $microblog){
        if($microblog->is_forward == 1){
            $initialMicroblog = $microblog->initialMicroblog;
            $initialMicroblog->forward_count--;
            $initialMicroblog->save();
        }
    }

}