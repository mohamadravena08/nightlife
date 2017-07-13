@extends('layouts.master')

@section('Admin Liburanku', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="/admin/packet/new"><button class="btn btn-success">Tambah Paket Liburan</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <td>Nama Paket Liburan</td>
                    <td>Harga</td>
                    <td>File Brosur</td>
                    <td></td>
                    </thead>
                    <tbody>
                    @foreach ($packets as $packet)
                        <tr>
                            <td>{{$packet->name}}</td>
                            <td>{{$packet->price}}$</td>
                            <td>{{$packet->file->original_filename}}</td>
                            <td><a href="/admin/packet/destroy/{{$packet->id}}"><button class="btn btn-danger">Hapus</button></a> </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection