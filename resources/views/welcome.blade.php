@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <h1>Polling Unit Results</h1>
    <form id="pollingUnitForm">
        <label for="pollingUnitId">Polling Unit ID:</label>
        <input type="text" id="pollingUnitId" name="polling_unit_id">
        <button type="submit">Get Results</button>
    </form>
    <div id="resultsContainer"></div>
    <hr />
    <a href="{{ url('summed-total') }}" target="_blank">The summed total result of all polling units </a>
    <br/>
    <a href="{{ url('new-polling-unit') }}" target="_blank">New-polling-units </a>

    <script>
        document.getElementById('pollingUnitForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const urlParams = new URLSearchParams(formData).toString();
            fetch('/polling-unit-results?' + urlParams)
                .then(response => response.json())
                .then(data => {
                    // Display results in the #resultsContainer element
                    const str = JSON.stringify(data.results, null, 2);
                    const obj = JSON.parse(str);
                    document.getElementById('resultsContainer').textContent = (JSON.stringify(obj, null, 2));;
                    console.log(JSON.stringify(obj, null, 2));
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
