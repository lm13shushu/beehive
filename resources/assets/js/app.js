
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

//加入防止跨域攻击
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//打开回复框
$(document).ready(function(e){
    $('.show-reply').click(function() {
        var replyId= $(this).attr("value");
        // 显示回复框
        $("#replyForm-" + replyId).toggle();
    });

    $("#bodyPage").fullImages({
        ImgWidth: 1920, 
        ImgHeight: 980,
        autoplay :  3500,
        fadeTime : 1500
    }); 

    // var menuYloc = $("#scrollDiv1").offset().top;  
    $(window).scroll(function () {  
        var offsetTop = $(window).scrollTop() + "px";  
        // jquery提供的animate动画
        $("#scrollDiv1").animate({ top: offsetTop }, { duration: 500, queue: false }); 
        $("#scrollDiv2").animate({ top: offsetTop }, { duration: 500, queue: false });   
    });

});

//打开创建微博界面
$('.createForm').click( function() {
    $('#show-person-info').load('/microblogs/create',function(responseTxt,statusTxt,xhr){
        if(statusTxt=="success"){
            $("#post_body").qeditor({});
             // $('#filer_input').filer(); 
             //console.log('value changed!');  
             //focus();
        }
    });
});

//查看用户微博
$('.show-person-microblogs').click( function() {
    $('#show-person-info').load('/users/' +　$('.userId').attr("value")  +　'/microblogs');
});

//点赞
$('.like').click( function() {
        var like = $(this);
        var id = like.attr("id");//获取对应微博id
        like.fadeOut(300); //渐隐效果   
        $('#like-count-'+id).load('/microblogs/'+id+'/like',function(responseTxt,statusTxt,xhr){
            if(statusTxt=="success"){
                 like.fadeIn(300);
            }else{
                 like.fadeIn(300);
                 alert("你已经点赞过！");
            }
        });
});

//转发
$('.forward').click( function(){
    var microblogId = $(this).attr("value");
    $('#forwardBody').load('/microblogs/' + microblogId + '/showForwardMicroblog');
});

// //关注用户
// $('.follow').click( function(){
//     var userId = $('.userId').attr("value");
//         $.ajax({
//         type:   'POST',
//         url:    '/users/followers/' +  userId,
//         data:   {_method: 'post' },
//         success: function(data){
//            $('#user-follow-form').html(data);
//         }
//     });  

// });

// //取消关注
// $('.followers-destroy').click( function(){
//     var userId = $('.userId').attr("value");
//         $.ajax({
//         type:   'DELETE',
//         url:    '/users/followers/' +  userId,
//         data:   {_method: 'delete' },
//         success: function(data){
//             $('#user-follow-form').html(data);
//         }
//     });  
// });
// function focus(){
//     console.log('1');
//     $("document").on(  
//         'keyup',  '#post_body',
//         function() {  
//             console.log('2');
//         });  
// }
//  $(function(){ 
//     setInterval (focus, 2000);
//     function focus()
//     {
//         console.log('2');
//         $('#post_body').focus(function(){
//              alert('1');
//         });
//     }
// });