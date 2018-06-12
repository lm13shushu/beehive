<div id="bodyPage">
    <img src="{{ asset('uploads/bodyPage/bg1.jpg') }}" class="bg">
    <img src="{{ asset('uploads/bodyPage/bg2.jpg') }}" class="bg">
    <img src="{{ asset('uploads/bodyPage/bg3.jpg') }}" class="bg">
    <img src="{{ asset('uploads/bodyPage/bg4.jpg') }}" class="bg">
</div>

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(e) {
            
           $("#bodyPage").fullImages({
               ImgWidth: 1920,
               ImgHeight: 980,
               autoplay :  3500,
               fadeTime : 1500
           });          
        });
    </script>
@stop
