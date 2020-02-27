<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>登陆</title>
</head>
<body>
    <center><h2><b>登陆页面</b></h2></center>
    <form class="form-horizontal" role="form" action="{{url('login/doLogin')}}" method="post">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" name="u" class="form-control" id="firstname" placeholder="tel/username/email">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="firstname" placeholder="请输入密码..">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-default" value="登陆">
            </div>
        </div>
    </form>
</body>
</html>