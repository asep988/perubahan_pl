@extends('template.master')

@section('content')
<div class="title" style="text-align: center; color: white;">PREVIEW DATA</div>
    <div class="card" style="background-color: white;">
        <div class="card-header">
           <marquee behavior="" direction=""><h3 class="card-title">Surat Keluar 2022</h3></marquee>
        </div>
        <div class="card-body">
            <table id="surat-keluar" class="table table-bordered table-striped" style="table-layout: fixed;">
                <thead>
                    <th>No.</th>
                    <th>Perusahaan</th>
                    <th>Nomor Surat Masuk</th>
                    <th>Tanggal Surat Masuk</th>
                    <th>Nomor Surat Keluar</th>
                    <th>Tanggal Surat Keluar</th>
                </thead>
                <?php
                include('SK.php');
                $no = 1;
                ?>
                <!-- $newArray adalah variabel yang didapatkan dari SK.php  -->
                <?php foreach ($newArray as $value) { ?>
                    <tr>
                        <td><?php echo $value["No."]; ?></td>
                        <td><?php echo $value["Perusahaan"]; ?></td>
                        <td><?php echo $value["Nomor Surat Masuk"]; ?></td>
                        <td><?php echo $value["Tanggal Surat Masuk"]; ?></td>
                        <td><?php echo $value["Nomor Surat Keluar"]; ?></td>
                        <td><?php echo $value["Tanggal Surat Keluar"]; ?></td>
                    </tr>

                <?php } ?>
            </table>
        </div>
    </div>
@endsection
