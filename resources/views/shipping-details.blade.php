@extends('layouts.app')

@section('content')
<div class="container w-50">
    <div class="card-body">
        <h1>Shipping Detail</h1>
        <form action="detailorder" method="post">
            @csrf
            <div class="form-group">
                <label for="penerima">Nama Penerima</label>
                <input type="text" name="penerima" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Penerima" required>
            </div>
            <div class="form-group">
                <label for="telepon">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" id="telepon" placeholder="Masukan nomor telepon " required>
            </div>
            <div class="form-group">
                <label for="service">Service</label>
                <select class="form-control" name="service" required>
                    <option value="">Pilih Service</option>
                    @foreach ($services as $service)
                        <option value="{{ $service['service_name'] }}">{{ $service['service_name'] }}</option>
                    @endforeach
                  </select>
              </div>
            <div class="form-group">
                <label for="kota">City</label>
                <select class="form-control" name="kota" required>
                    <option value="">Pilih Kota</option>
                    @foreach ($kota as $city)
                        <option value="{{ $city['kota'] }}">{{ $city['kota'] }}</option>
                    @endforeach
                  </select>
            </div>
            <div class="form-group">
                <label for="kecamatan">Kecamatan</label>
                <select class="form-control" name="kecamatan" required>
                    <option value="">Pilih Kecamatan</option>
                    @foreach ($kota as $city)
                        <option value="{{ $city['kecamatan'] }}">{{ $city['kecamatan'] }}</option>
                    @endforeach
                  </select>
            </div>
            <div class="form-group">
                <label for="kelurahan">Kelurahan</label>
                <select class="form-control" name="kelurahan" required>
                    <option value="">Pilih Kelurahan</option>
                    @foreach ($kota as $city)
                        <option value="{{ $city['kelurahan'] }}">{{ $city['kelurahan'] }}</option>
                    @endforeach
                  </select>
            </div>
            <div class="form-group">
                <label for="kode_pos">Kode Pos</label>
                <select class="form-control" name="kode_pos" required>
                    <option value="">Pilih Kode Pos</option>
                    @foreach ($kota as $city)
                        <option value="{{ $city['kode_pos'] }}">{{ $city['kode_pos'] }}</option>
                    @endforeach
                  </select>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" rows="3" placeholder="Masukan Alamat" value=""></textarea>
            </div>
            <input class="btn btn-primary" type="submit" name="submit" value="Next">
        </form>
    </div>
</div>
@endsection
