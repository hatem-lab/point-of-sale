        @if ($errors->any())
       <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif


      

      

        @if(session('success'))
        
        <script>
         
          new  Noty({
           
            type: 'success',
            layout:'topRight',
            text: "{{session('success')}}",
            timeout:2000,
            killer: true
            }).show();
           
            </script>   
            @endif

        
        
            
    
     
        
        