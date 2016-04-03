<!DOCTYPE html>
<html ng-app="app">
<head>
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="/lib/angular-material/angular-material.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet"  href="/css/style.css">

</head>
<body>
<md-toolbar>
    <h2>
        <span>Marvel Laravel</span>
    </h2>
</md-toolbar>


<a ui-sref="latestcomics">Latest comics</a>

<ui-view>

</ui-view>
<script src="/lib/angular/angular.js"></script>
<script src="/lib/angular-resource/angular-resource.js"></script>
<script src="/lib/angular-ui-router/release/angular-ui-router.js"></script>
<script src="/lib/angular-material/angular-material.js"></script>
<script src="/lib/angular-animate/angular-animate.js"></script>
<script src="/lib/angular-aria/angular-aria.js"></script>
<script src="/app/app.js"></script>
</body>
</html>
