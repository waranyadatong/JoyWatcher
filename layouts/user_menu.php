<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>

<style>
    nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    nav ul li {
        /*Sub Menu*/
    }

    nav ul li a {
        display: block;
        padding: 3px 2px;
        color: #FFFFFF;
        text-decoration: none;
        -webkit-transition: 0.2s linear;
        -moz-transition: 0.2s linear;
        -ms-transition: 0.2s linear;
        -o-transition: 0.2s linear;
        transition: 0.2s linear;
    }

    nav ul li a:hover {
        background: #8B3F3F;
        color: #FFFFFF;
    }

    nav ul li a .fa {
        width: 56px;
        text-align: center;
        margin-right: 5px;
        /*float: right;*/
    }

    nav ul ul {
        background: rgb(0, 0, 0, 0.2);
    }

    nav ul li ul li a {
        border-left: 4px solid transparent;
        padding: 15px 25px;
        font-size: 12px;
    }

    nav ul li ul li a:hover {
        border-left: 4px solid #A10909;

    }
</style>

<body>
    <nav class="animated bounceInDown">
        <ul>
            <li>
                <a href="overallb.php">
                    <i class="glyphicon glyphicon-home"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="#">
                    <i class="glyphicon glyphicon-cog"></i>
                    <span>Production</span>
                    <div class="fa fa-caret-down right"></div>
                </a>
                <ul>
                    <li class="sub-menu">
                        <a href="#">MOT B<div class="fa fa-caret-down right"></div></a>
                        <ul>
                            <li>
                                <a href="A1.php">A1</a>
                            </li>
                            <li>
                                <a href="A2.php">A2</a>
                            </li>
                            <li>
                                <a href="production.php">A3</a>
                            </li>
                            <li>
                                <a href="A4.php">A4</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="#">MOT A<div class="fa fa-caret-down right"></div></a>
                        <ul>
                            <li>
                                <a href="A5.php">A5</a>
                            </li>
                            <li>
                                <a href="A6.php">A6</a>
                            </li>
                            <li>
                                <a href="A7.php">A7</a>
                            </li>
                            <li>
                                <a href="A8.php">A8</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>


            <li class="sub-menu">
                <a href="#">
                    <i class="glyphicon glyphicon-blackboard"></i>
                    <span>Dashboard</span>
                    <div class="fa fa-caret-down right"></div>
                </a>
                <ul>
                    <li class="sub-menu">
                        <a href="#">MOT B<div class="fa fa-caret-down right"></div></a>
                        <ul>
                            <li>
                                <a href="admin_a1.php">A1</a>
                            </li>
                            <li>
                                <a href="admin_a2.php">A2</a>
                            </li>
                            <li>
                                <a href="admin.php">A3</a>
                            </li>
                            <li>
                                <a href="admin_a4.php">A4</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="#">MOT A<div class="fa fa-caret-down right"></div></a>
                        <ul>
                            <li>
                                <a href="admin_a5.php">A5</a>
                            </li>
                            <li>
                                <a href="admin_a6.php">A6</a>
                            </li>
                            <li>
                                <a href="admin_a7.php">A7</a>
                            </li>
                            <li>
                                <a href="admin_a8.php">A8</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="#">
                    <i class="glyphicon glyphicon-list-alt"></i>
                    <span>Database</span>
                    <div class="fa fa-caret-down right"></div>
                </a>
                <ul>
                    <li class="sub-menu">
                        <a href="#">MOT B<div class="fa fa-caret-down right"></div></a>
                        <ul>
                            <li>
                                <a href="database_a1.php">A1</a>
                            </li>
                            <li>
                                <a href="database_a2.php">A2</a>
                            </li>
                            <li>
                                <a href="Filterdatabase.php">A3</a>
                            </li>
                            <li>
                                <a href="database_a4.php">A4</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="#">MOT A<div class="fa fa-caret-down right"></div></a>
                        <ul>
                            <li>
                                <a href="database_a5.php">A5</a>
                            </li>
                            <li>
                                <a href="database_a6.php">A6</a>
                            </li>
                            <li>
                                <a href="database_a7.php">A7</a>
                            </li>
                            <li>
                                <a href="database_a8.php">A8</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!--<li>
                <a href="Filterdatabase.php">
                    <i class="glyphicon glyphicon-list-alt"></i>
                    <span>Database</span>
                </a>
            </li>-->

            <li class="sub-menu">
                <a href="#">
                    <i class="glyphicon glyphicon-stats"></i>
                    <span>Analysis</span>
                    <div class="fa fa-caret-down right"></div>
                </a>
                <ul>
                    <li class="sub-menu">
                        <a href="#">MOT B<div class="fa fa-caret-down right"></div></a>
                        <ul>
                            <li>
                                <a href="analysis_a1.php">A1</a>
                            </li>
                            <li>
                                <a href="analysis_a2.php">A2</a>
                            </li>
                            <li>
                                <a href="c.php">A3</a>
                            </li>
                            <li>
                                <a href="analysis_a4.php">A4</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="#">MOT A<div class="fa fa-caret-down right"></div></a>
                        <ul>
                            <li>
                                <a href="analysis_a5.php">A5</a>
                            </li>
                            <li>
                                <a href="analysis_a6.php">A6</a>
                            </li>
                            <li>
                                <a href="analysis_a7.php">A7</a>
                            </li>
                            <li>
                                <a href="analysis_a8.php">A8</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!--<li>
                <a href="c.php">
                    <i class="glyphicon glyphicon-stats"></i>
                    <span>Analysis</span>
                </a>
            </li>-->
        </ul>
    </nav>
</body>

<script>
    $(".sub-menu ul").hide();
    $(".sub-menu a").click(function() {
        $(this).parent(".sub-menu").children("ul").slideToggle("100");
        $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
    });
</script>