
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Product 8</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <style type="text/css">

            @font-face {
              font-family: myFirstFont;
              src: url(/userimages/horizonn.ttf);
            }

                .lds-ellipsis {
                  display: inline-block;
                  position: relative;
                  width: 80px;
                  height: 80px;
                }
                .lds-ellipsis div {
                  position: absolute;
                  top: 33px;
                  width: 13px;
                  height: 13px;
                  border-radius: 50%;
                  background: black;
                  animation-timing-function: cubic-bezier(0, 1, 1, 0);
                }
                .lds-ellipsis div:nth-child(1) {
                  left: 8px;
                  animation: lds-ellipsis1 0.6s infinite;
                }
                .lds-ellipsis div:nth-child(2) {
                  left: 8px;
                  animation: lds-ellipsis2 0.6s infinite;
                }
                .lds-ellipsis div:nth-child(3) {
                  left: 32px;
                  animation: lds-ellipsis2 0.6s infinite;
                }
                .lds-ellipsis div:nth-child(4) {
                  left: 56px;
                  animation: lds-ellipsis3 0.6s infinite;
                }
                @keyframes lds-ellipsis1 {
                  0% {
                    transform: scale(0);
                  }
                  100% {
                    transform: scale(1);
                  }
                }
                @keyframes lds-ellipsis3 {
                  0% {
                    transform: scale(1);
                  }
                  100% {
                    transform: scale(0);
                  }
                }
                @keyframes lds-ellipsis2 {
                  0% {
                    transform: translate(0, 0);
                  }
                  100% {
                    transform: translate(24px, 0);
                  }
                }



    </style>


</head>


<body>
        
          <div id="app">

              <router-view></router-view>

          </div>

</body>


<script type="text/javascript">
    
     function myFunction(){
        let elem = document.getElementById("elem");
            elem.requestFullscreen().catch(() => {});
            // document.exitFullscreen();
     }

</script>

<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/jquery.min.js') }}" defer></script>
