<?php include('./header.php');  ?>
<section class="dashboard">
    <!-- Start Dashboard Content -->
    <div class="content container-fluid">
        <div class="heading">
            <h4>
                <span class="icon"><i class="fas fa-th-large"></i></span>
                DASHBOARD
            </h4>
        </div>
        <div class="report-type">
            <div class="row">
                <div class="col-3 report text-center">
                    <span class="icon"><i class="fas fa-check"></i></span>
                    <p>CHART</p>
                </div>
                <div class="col-3 report text-center">
                    <span class="icon"><i class="fas fa-check"></i></span>
                    <p>STATS</p>
                </div>
                <div class="col-3 report text-center">
                    <span class="icon"><i class="fas fa-check"></i></span>
                    <p>TOP</p>
                </div>
            </div>
        </div>
        <div class="reports-container">
            <div class="row no-gutters">
                <div class="col-7 reports-chart">
                    <div class="chart-content">
                        <div class="report1">
                            <div class="title">
                                <div class="left-title">
                                    <p>All Courses</p>
                                </div>
                                <div class="right-title">
                                    <p>Last 7 days <span class="icon"><i class="fas fa-angle-down"></i></span></p>
                                </div>
                            </div>
                            <div class="heading">
                                <div class="row">
                                    <div class="col-3 text-center">
                                        <p>Views</p>
                                    </div>
                                    <div class="col-2 text-center">
                                        <p>Likes</p>
                                    </div>
                                    <div class="col-2 text-center">
                                        <p>Comments</p>
                                    </div>
                                    <div class="col-2 text-center">
                                        <p>Shares</p>
                                    </div>
                                </div>
                            </div>
                            <div class="details">
                                <div class="row">
                                    <div class="col-3 text-center">
                                        <p>11707</p>
                                    </div>
                                    <div class="col-2 text-center">
                                        <p>7429</p>
                                    </div>
                                    <div class="col-2 text-center">
                                        <p>2434</p>
                                    </div>
                                    <div class="col-2 text-center">
                                        <p>1135</p>
                                    </div>
                                </div>
                            </div>
                            <div class="percentage">
                                <div class="row">
                                    <div class="col-3 up text-center">
                                        <div class="icon">
                                            <span><i class="fas fa-sort-up"></i></span>
                                        </div>
                                        <p>10.95%</p>
                                    </div>
                                    <div class="col-2 up text-center">
                                        <div class="icon">
                                            <span><i class="fas fa-sort-up"></i></span>
                                        </div>
                                        <p>4.95%</p>
                                    </div>
                                    <div class="col-2 up text-center">
                                        <div class="icon">
                                            <span><i class="fas fa-sort-up"></i></span>
                                        </div>
                                        <p>7.2%</p>
                                    </div>
                                    <div class="col-2 down text-center">
                                        <div class="icon">
                                            <span><i class="fas fa-sort-down"></i></span>
                                        </div>
                                        <p>-2.40%</p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="draw-canvas">
                                <canvas id="report1-canvas"></canvas>
                            </div>
                        </div>
                        <div class="report2">
                            <div class="title">
                                <p>SUCCESS RATE</p>
                                <div class="icon">
                                    <span><i class="fas fa-sort-up"></i></span>
                                </div>
                                <p class="rate">12%</p>
                            </div>
                            <div class="draw-canvas">
                                <canvas id="report2-canvas"></canvas>
                            </div>
                        </div>
                        <div class="report3">
                            <div class="row">
                                <div class="col-12 title">
                                    <p>TOP COURSES FOR THE PAST 
                                        <span class="tag">7 days
                                            <span class="icon"><i class="fas fa-sort-down"></i></span>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-12 course">
                                    <div class="row no-gutters">
                                        <div class="col-6 cname">
                                            <div class="cimg">
                                                <img class="img-fluid" src="../images/course1.jpg">
                                            </div>
                                            <div class="ctext">
                                                <p>English Speaking</p>
                                                <span class="date">5 Mars, 2018</span>
                                            </div>
                                        </div>
                                        <div class="col-4 csocial">
                                            <div class="row">
                                                <div class="col-4 likes text-center">
                                                    <span class="icon"><i class="far fa-heart"></i></span>
                                                    <span class="num">2670</span>
                                                </div>
                                                <div class="col-4 comments text-center">
                                                    <span class="icon"><i class="far fa-comment"></i></span>
                                                    <span class="num">945</span>
                                                </div>
                                                <div class="col-4 shares text-center">
                                                    <span class="icon"><i class="far fa-share-square"></i></span>
                                                    <span class="num">412</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 views text-right">
                                            <p>VIEWS</p>
                                            <span class="num">4540</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 course">
                                    <div class="row no-gutters">
                                        <div class="col-6 cname">
                                            <div class="cimg">
                                                <img class="img-fluid" src="../images/course2.jpg">
                                            </div>
                                            <div class="ctext">
                                                <p>English Writing</p>
                                                <span class="date">25 Feburary, 2018</span>
                                            </div>
                                        </div>
                                        <div class="col-4 csocial">
                                            <div class="row">
                                                <div class="col-4 likes text-center">
                                                    <span class="icon"><i class="far fa-heart"></i></span>
                                                    <span class="num">2087</span>
                                                </div>
                                                <div class="col-4 comments text-center">
                                                    <span class="icon"><i class="far fa-comment"></i></span>
                                                    <span class="num">652</span>
                                                </div>
                                                <div class="col-4 shares text-center">
                                                    <span class="icon"><i class="far fa-share-square"></i></span>
                                                    <span class="num">314</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 views text-right">
                                            <p>VIEWS</p>
                                            <span class="num">3245</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 course">
                                    <div class="row no-gutters">
                                        <div class="col-6 cname">
                                            <div class="cimg">
                                                <img class="img-fluid" src="../images/course3.jpg">
                                            </div>
                                            <div class="ctext">
                                                <p>English Spelling</p>
                                                <span class="date">17 October, 2017</span>
                                            </div>
                                        </div>
                                        <div class="col-4 csocial">
                                            <div class="row">
                                                <div class="col-4 likes text-center">
                                                    <span class="icon"><i class="far fa-heart"></i></span>
                                                    <span class="num">1640</span>
                                                </div>
                                                <div class="col-4 comments text-center">
                                                    <span class="icon"><i class="far fa-comment"></i></span>
                                                    <span class="num">510</span>
                                                </div>
                                                <div class="col-4 shares text-center">
                                                    <span class="icon"><i class="far fa-share-square"></i></span>
                                                    <span class="num">245</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 views text-right">
                                            <p>VIEWS</p>
                                            <span class="num">2457</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 course">
                                    <div class="row no-gutters">
                                        <div class="col-6 cname">
                                            <div class="cimg">
                                                <img class="img-fluid" src="../images/course4.jpg">
                                            </div>
                                            <div class="ctext">
                                                <p>English</p>
                                                <span class="date">8 April, 2017</span>
                                            </div>
                                        </div>
                                        <div class="col-4 csocial">
                                            <div class="row">
                                                <div class="col-4 likes text-center">
                                                    <span class="icon"><i class="far fa-heart"></i></span>
                                                    <span class="num">1032</span>
                                                </div>
                                                <div class="col-4 comments text-center">
                                                    <span class="icon"><i class="far fa-comment"></i></span>
                                                    <span class="num">327</span>
                                                </div>
                                                <div class="col-4 shares text-center">
                                                    <span class="icon"><i class="far fa-share-square"></i></span>
                                                    <span class="num">164</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 views text-right">
                                            <p>VIEWS</p>
                                            <span class="num">1465</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 space"></div>
                <div class="col-4 reports-num">
                    <div class="row no-gutters">
                        <div class="col-12 heading">
                            <p>TOTAL RESULT</p>
                        </div>
                        <div class="col-5 total result1 text-center">
                            <p class="num">67</p>
                            <p class="title">TOTAL STUDENTS</p>
                            <em>in the past 7 days</em>
                        </div>
                        <div class="col-5 total result2 text-center">
                            <p class="num">4</p>
                            <p class="title">TOTAL COURSES</p>
                            <em>in the past 7 days</em>
                        </div>
                        <div class="col-5 total result3 text-center">
                            <p class="num">42</p>
                            <p class="title">STUDENTS SUCCEED</p>
                            <em>in the past 7 days</em>
                        </div>
                        <div class="col-5 total result4 text-center">
                            <p class="num">25</p>
                            <p class="title">STUDENTS FAILED</p>
                            <em>in the past 7 days</em>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('./footer.php');  ?>