@extends('layoutadmin')

@section('konten')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
<style>
    h4{
        font-family: 'Montserrat', sans-serif;
    }
    button{
        background: none;
        border: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        outline: inherit;
    }
</style>

<div class="body-wrapper">
    <?php
        date_default_timezone_set('Asia/Jakarta'); // Atur zona waktu sesuai dengan lokasi Anda

        // Dapatkan waktu saat ini
        $current_time = date('H');

        // Tentukan pesan selamat pagi, siang, atau malam berdasarkan waktu saat ini
        if ($current_time < 12) {
            $greeting = 'Good Morning';
        } elseif ($current_time < 18) {
            $greeting = 'Good Afternoon';
        } else {
            $greeting = 'Good Night';
        }
    ?>

    <!-- Tampilkan pesan selamat pagi, siang, atau malam -->
    <center>
        <h1 style="color: rgb(0, 77, 0); font-family: 'Montserrat', sans-serif;"> <?= $greeting ?> {{ Auth::user()->name }}</h1><br>
    </center>

        <div class="tomorrow"
            data-location-id="056196"
            data-language="ID"
            data-unit-system="METRIC"
            data-skin="light"
            data-widget-type="upcoming"
            style="padding-bottom:22px;position:relative;">
            <a href="https://www.tomorrow.io/weather-api/" rel="nofollow noopener noreferrer" target="_blank" style="position: absolute; bottom: 0; transform: translateX(-50%); left: 50%;"></a>
        </div>
    </div>
    <!-- Content Wrapper -->
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <!-- Tampilkan widget cuaca -->
                <div style="margin-top: 10px;">
                    <script>
                        (function(d, s, id) {
                            if (d.getElementById(id)) {
                                if (window.__TOMORROW__) {
                                    window.__TOMORROW__.renderWidget();
                                }
                                return;
                            }
                            const fjs = d.getElementsByTagName(s)[0];
                            const js = d.createElement(s);
                            js.id = id;
                            js.src = "https://www.tomorrow.io/v1/widget/sdk/sdk.bundle.min.js";
                
                            fjs.parentNode.insertBefore(js, fjs);
                        })(document, 'script', 'tomorrow-sdk');
                    </script>
                </div>
                <div class="card-body" style="margin-top: 10px">
                
                </div>  
            </div>
        </div>
    </div>
</div>

@endsection
