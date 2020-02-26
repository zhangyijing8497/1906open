<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>注册</title>
</head>
<body>
    <center><h2><b>用户注册</b></h2></center>
    <form class="form-horizontal" role="form" action="{{url('login/doReg')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">公司名称</label>
            <div class="col-sm-10">
                <input type="text" name="cname" class="form-control" id="firstname" placeholder="请输入公司名称">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">法人</label>
            <div class="col-sm-10">
                <input type="text" name="people" class="form-control" id="lastname" placeholder="请输入法人">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
                <input type="text" name="username" class="form-control" id="firstname" placeholder="请输入用户名">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="lastname" placeholder="请输入密码">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">确认密码</label>
            <div class="col-sm-10">
                <input type="password" name="password1" class="form-control" id="lastname" placeholder="确认密码">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">公司地址</label>
            <div class="col-sm-10">
                <input type="text" name="address" class="form-control" id="firstname" placeholder="请输入公司地址">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">营业执照</label>
            <div class="col-sm-10">
                <input type="file" name="logo" id="inputfile">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">联系人电话</label>
            <div class="col-sm-10">
                <input type="tel" name="tel" class="form-control" id="lastname" placeholder="请输入法电话">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">email</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="firstname" placeholder="请输入公司邮箱">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-default" value="注册">
            </div>
        </div>
    </form>
</body>
</html>