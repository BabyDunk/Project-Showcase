<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 27/05/2018
	 * Time: 13:13
	 */

$sess = new \Classes\Core\Session();

	?>

@extends('extends.admin-base')


@section('title', 'Dashboard')

@section('page-id', 'dashboard')

@section('content')

<div id="page-wrapper">

        <!-- Page Heading -->
        <div class="grid-x expanded">
            <div class="large-12 cell">
                <h1 class="page-header">
                    Admin
                    <small>Dashboard</small>
                </h1>

                <div class="grid-x grid-padding-x">
                        <div class="large-3 medium-6 cell success">
                            <div class="callout success">
                                <div class="card success">
                                    <div class="card-section">
                                        <div class="small-3 cell">
                                            <i class="fa fa-5x fa-bar-chart-o"></i>
                                        </div>
                                        <div class="small-9 cell text-right">
                                            <div class="stat"><?php echo $sess->count; ?></div>
                                            <div>New Views</div>
                                        </div>
                                    </div>
                                    <div class="card-section">
                                        <a href="/admin/statistics">
                                            <div class="panel-footer">
                                                <span class="pull-left">View Details</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="large-3 medium-6 cell">
                            <div class="callout warning">
                                <div class="card ">
                                    <div class="card-section">
                                        <div class="small-3 cell">
                                            <i class="fa fa-table fa-5x"></i>
                                        </div>
                                        <div class="small-9 cell text-right">
                                            <div class="stat"><?php  echo \Classes\Core\Showcase::count_all(); ?></div>
                                            <div>Showcases</div>
                                        </div>
                                    </div>
                                    <div class="card-section">
                                    <a href="/admin/showcase">
                                        <div class="panel-footer">
                                            <span class="pull-left">Total Showcases</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="large-3 medium-6 cell success">
                            <div class="callout alert">
                                <div class="card">
                                    <div class="card-section">
                                        <div class="small-3 cell">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="small-9 cell text-right">
                                            <div class="stat"><?php echo \Classes\Core\User::count_all(); ?></div>
                                            <div>Users</div>
                                        </div>
                                    </div>
                                    <div class="card-section">
                                        <a href="/admin/users">
                                            <div class="panel-footer">
                                                <span class="pull-left">Total Users</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="large-3 medium-6 cell success">
                            <div class="callout primary">
                                <div class="card">
                                    <div class="card-section">
                                        <div class="small-3 cell">
                                            <i class="fa fa-comments-o fa-5x"></i>
                                        </div>
                                        <div class="small-9 cell text-right">
                                            <div class="stat"><?php echo \Classes\Core\Comment::count_all(); ?></div>
                                            <div>Comments</div>
                                        </div>
                                    </div>
                                    <div class="card-section">
                                        <a href="/admin/comments">
                                            <div class="panel-footer">
                                                <span class="pull-left">Total Comments</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>



                </div> <!--First Row-->

                <div class="row">

                    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>


                </div>


            </div>
        </div>
        <!-- /.row -->


</div>
<!-- /#page-wrapper -->

@endsection

