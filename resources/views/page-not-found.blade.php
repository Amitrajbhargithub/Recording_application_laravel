<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>page not found</title>
    <style>
    .page_404{ padding:40px 0; background:#fff; font-family: 'Arvo', serif;}

    .page_404  img{ width:100%;}

    .four_zero_four_bg{
 
        height: 400px;
        background-repeat: no-repeat;
    }
    .page-not-found {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }
 
    .four_zero_four_bg h1{
        font-size:80px;
    }
 
    .four_zero_four_bg h3{
        font-size:80px;
    }
    
    .link_404{			 
        color: #fff!important;
        padding: 10px 20px;
        background: #39ac31;
        margin: 20px 0;
        display: inline-block;}
    .contant_box_404{ margin-top:-50px;}
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <section class="page_404">
                <div class="container">
                    <div class="row">	
                        <div class="col-sm-12 ">
                            <div class="col-sm-10 col-sm-offset-1  text-center page-not-found">
                                <div class="four_zero_four_bg">
                                    <h1 class="text-center ">404</h1>
                                    <img src="{{asset('images/page-not.gif')}}" alt="page not found">
                                </div>
                                <div class="contant_box_404">
                                    <h3 class="h2">Look like you're lost</h3>
                                    <p>The page you are looking for not avaible!</p>
                                    <a href="/" class="link_404">Go to Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>