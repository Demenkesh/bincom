<!-- resources/views/new_polling_unit.blade.php -->

@extends('layouts.app')

@section('title', 'New Polling Unit')

@section('content')
    <h1>New Polling Unit</h1>

    <form action="{{ route('store-new-polling-unit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">	result_id </label>
            <input type="number" class="form-control" name="result_id" id="exampleFormControlInput1" placeholder="12345....">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">polling_unit_uniqueid</label>
            <input type="number" class="form-control" name="polling_unit_uniqueid" id="exampleFormControlInput1" placeholder="546">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">party_abbreviation</label>
            <input type="text" class="form-control" name="party_abbreviation" id="exampleFormControlInput1" placeholder="abc">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">party_score</label>
            <input type="number" class="form-control" name="party_score" id="exampleFormControlInput1" placeholder="433">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">entered_by_user</label>
            <input type="text" class="form-control" name="entered_by_user" id="exampleFormControlInput1" placeholder="john">
        </div>

        <button type="submit">Save</button>
    </form>
@endsection
