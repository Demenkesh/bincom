@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <h1>Summed Total Result</h1>
    <form id="lgaForm">
        <label for="lga">Select Local Government Area:</label>
        <select id="lga" name="lga">
            <option label="Select LGA"></option>
            @foreach ($lga as $item)
                <option value="{{ $item->lga_id }}">{{ $item->lga_name }}</option>
            @endforeach
        </select>
        <button type="submit">Get Summed Total Result</button>
    </form>

    <div id="totalResult"></div>

    <script>
        document.getElementById('lgaForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const lga = formData.get('lga');

            fetch(`/summed-total-result?lga=${lga}`)
                .then(response => response.json())
                .then(data => {
                    const summedTotal = data.summed_total; // Access the 'summed_total' key
                    document.getElementById('totalResult').textContent =
                        `Summed Total: ${summedTotal}`;
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

@endsection
