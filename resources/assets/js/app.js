
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

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    $('.show-reply').click(function() {
        var replyId= $(this).attr("value");
        $("#replyForm-" + replyId).toggle();
    });
});

$('.createForm').click( function() {
    $('#show-person-info').load('/microblogs/create',function(responseTxt,statusTxt,xhr){
        if(statusTxt=="success"){
            $("#post_body").qeditor({});
        }
    });
});

$('.show-person-microblogs').click( function() {
    $('#show-person-info').load('/users/' +　$('.glyphicon-user').attr("value") 　+　'/microblogs');
});
