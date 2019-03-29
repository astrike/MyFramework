<!DOCTYPE html>
<html class="no-js">

<head>
    <title>Панель администратора Блога Светланы</title>
    <!-- Bootstrap -->
    <link href="bootstrap_admin_files/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap_admin_files/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap_admin_files/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
    <link href="bootstrap_admin_files/assets/styles.css" rel="stylesheet" media="screen">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="bootstrap_admin_files/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>

<body>
@include('admin.header')
<div class="container-fluid">
    <div class="row-fluid">

        @yield('leftPanel')
        @include('admin.leftPanel')

        <!--/span-->
        @yield('content')
    </div>
    <hr>
    <footer>
        <p>&copy; Дмитрий Сафонов</p>
    </footer>
</div>
<!--/.fluid-container-->
<script src="bootstrap_admin_files/vendors/jquery-1.9.1.min.js"></script>
<script src="bootstrap_admin_files/bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap_admin_files/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
<script src="bootstrap_admin_files/assets/scripts.js"></script>
<script>
    $(function() {
        // Easy pie charts
        $('.chart').easyPieChart({animate: 1000});
    });
</script>
</body>

</html>