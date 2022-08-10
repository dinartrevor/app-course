<div class="row">
    <div class="col-md-12">
        <link rel="stylesheet" href="https://reg.kadinindonesia.or.id/js/jqvmap/jqvmap.min.css">
        <style>
            .jqvmap-label {
            z-index: 999;
            }
            .jqvmap-zoomin,
            .jqvmap-zoomout {
            padding: 3px 12px 8px 5px;
            height: 15px;
            }
            .customTdPanel {
            vertical-align: middle;
            text-align: center;
            }
            .panelCustomDashboard :hover {
            background-color: #934145;
            transform: scale(1.02);
            transition: 0.2s all cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }
            .text-white{
            color: white;
            }
        </style>
        <div class="row">
            <div class="col-md-6">
                <a href="{{url('admin/course')}}" class="panelCustomDashboard">
                    <div class="panel panelCustomDashboard" style="background-color: #3c8dbc;border-radius:25px;">
                        <div class="panel-body panelCustomDashboard" style="padding:40px;color:white;border-radius:13px;">
                            <table style="width:100%;">
                                <tbody>
                                    <tr>
                                        <td class="customTdPanel" style="width:50%;">
                                            <i class="fa fa-video-camera" aria-hidden="true" style="font-size:70px;"></i>
                                        </td>
                                        <th class="customTdPanel">
                                            <span style="font-size: 15;">Total Course</span>
                                            <br>
                                            <b style="font-size: 40px;">{{$total_course}}</b>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{url('admin/article')}}" class="panelCustomDashboard">
                    <div class="panel panelCustomDashboard" style="background-color: #3c8dbc;border-radius:25px;">
                        <div class="panel-body panelCustomDashboard" style="padding:40px;color:white;border-radius:13px;">
                            <table style="width:100%;">
                                <tbody>
                                    <tr>
                                        <td class="customTdPanel" style="width:50%;"><i class="fa fa-book" aria-hidden="true" style="font-size:70px;"></i></td>
                                        <th class="customTdPanel">
                                            <span style="font-size: 15;">Total Artikel</span><br>
                                            <b style="font-size: 40px;">{{$total_artikel}}</b>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row" style="font-family: 'Hindi';">
            <div class="col-md-12">
                <div class="box box-info box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">10 Course Terbaru
                        </h3>
                        <div class="box-tools pull-right">                   
                            <a href="{{url('/admin')}}" class="btn btn-warning"><i class="fa fa-undo"></i></a>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="display: block;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="70%">Judul Courses</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $value)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td width="70%">{{$value->namaCourse}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <!-- </div> body -->       
    </div>
</div>